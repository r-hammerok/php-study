<style>
    .container {
        width: 800px;
        padding: 1rem 5rem;
    }
    .form {
        width: 75%;
        margin-bottom: 1.3rem;
        border-bottom: 1px solid gray;
    }
    .form textarea {
        width: 100%;
    }
    .post {
        border: 1px solid grey;
        margin-top: 10px;
        padding: 5px;
        width: 50%;
        overflow: auto;
    }
    .post img {
        display: block;
        max-width: 50px;
        float: right;
        margin-left: 10px;
    }
    .post .button-delete {
        display: inline-block;
        float: right;
        clear: both;
        font-size: 10px;
    }
    .post-title {
        margin-bottom: 7px;
    }
    .user {
        color: grey;
        font-size: 11px;
    }
    .message {
        margin-top: 5px;
        padding-left: 5px;
    }
</style>
<div class="container">
<h2>Main BLOG - for authorized users only</h2>
<form class="form" action="/" method="POST" enctype="multipart/form-data">
    <p><b>Enter your message:</b></p>
    <p><textarea name="post" rows="10" maxlength="255"></textarea></p>
    <p><input type="file" name="img-post" accept=".png, .gif, .jpg, .jpeg "></p>
    <p><input type="submit" value="Send"></p>
</form>

<?php
/** @var $data \App\Controllers\UserController []*/
if (isset($data['errors'])) { ?>
    <ul style="color: red;">
        <?php  foreach($data['errors'] as $value): ?>
            <li>
                <?= 'Error: ' . $value ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php } ?>

<? if (isset($data['messages'])): ?>
    <? foreach ($data['messages'] as $post): ?>
        <? $user = empty($post['name']) ? '&lt;DELETED USER&gt;' : $post['name']; ?>
        <? $image = $post['img_name'];?>
        <? $pathImage = IMG_HTML_DIR . $image;?>
        <div class="post">
            <div class="post-title">
                <span class="user">Сообщение от <b><?=$user;?></b> отправлено <?=$post['created_at'];?></span>
                <? if ($_SESSION['user_id'] == ADMIN_ID): ?>
                    <? $href = '/index/?delete=' . $post['id']; ?>
                    <a class="button-delete" href="<?=$href;?>">delete</a>
                <? endif; ?>
            </div>
            <? if ($image !== null && __DIR__ . file_exists($pathImage)): ?>
            <img src="<?=$pathImage;?>" alt="post image">
            <? endif; ?>
            <div class="message"><?=$post['text'];?></div>
        </div>
    <? endforeach;?>
<? endif; ?>

</div>