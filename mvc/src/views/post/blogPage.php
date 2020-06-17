<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <p class="h3 text-center">Main BLOG - for authorized users only</p>
            <form class="form form-addpost" action="/posts" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputPost">Enter your message:</label>
                    <textarea id="inputPost" class="form-control" name="post" rows="7" maxlength="255"></textarea>
                </div>
                <div class="form-group">
                    <p><input type="file" class="form-control-file" name="img-post" accept=".png, .gif, .jpg, .jpeg ">
                    </p>
                </div>
                <p><input type="submit" class="btn btn-primary" value="Send"></p>
                <?php if (isset($data['errors'])) : ?>
                    <div class="errors">
                        <?php foreach ($data['errors'] as $value) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $value ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <?php if (isset($data['messages'])) : ?>
        <?php foreach ($data['messages'] as $post) : ?>
            <?php $user = empty($post['name']) ? '&lt;DELETED USER&gt;' : $post['name']; ?>
            <?php $image = $post['img_name'] == null ? '' : $post['img_name']; ?>
            <?php $pathImage = IMG_HTML_DIR . $image; ?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="post">
                        <div class="post-title">
                        <span class="user">
                            Сообщение от <b><?= $user; ?></b> отправлено <?= $post['created_at']; ?>
                        </span>
                            <?php if (\Base\Session::getUserID() == ADMIN_ID) : ?>
                                <?php $href = '/posts/?delete=' . $post['id']; ?>
                                <a class="delete-post" href="<?= $href; ?>">delete</a>
                            <?php endif; ?>
                        </div>
                        <div class="post-content">
                            <?php if (!empty($image) && __DIR__ . file_exists($pathImage)) : ?>
                                <img src="<?= $pathImage; ?>" alt="post image">
                            <?php endif; ?>
                            <div class="message"><?= $post['text']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
