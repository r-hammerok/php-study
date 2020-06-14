<h2>Login page</h2>
<form action="login" method="post">
    E-mail: <input type="text" name="email" value="" ><br><br>
    Password: <input type="text" name="password" value="" ><br><br>
    <input type="submit" value="Login">
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
<?php } elseif ($data['success']) { ?>
    <p style="color: green;">Authorization completed successfully!</p>
<?php } ?>