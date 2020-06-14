<h2>New User Registration</h2>
<form action="/user/register" method="post">
    Your name: <input type="text" name="name" value=""><br><br>
    e-mail: <input type="text" name="email" value=""><br><br>
    Password: <input type="text" name="password" value=""><br><br>
    Password again: <input type="text" name="password_again" value=""><br><br>
    <input type="submit" value="Register">
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
    <p style="color: green;">Registration completed successfully!</p>
<?php } ?>
