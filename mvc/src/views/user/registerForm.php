<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <p class="h3 text-center px-5">New User Registration</p>
            <form class="form register-form" action="/register" method="post">
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input id="inputName" type="text" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input id="inputEmail" type="email" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword"
                           aria-describedby="passwordHelpBlock" placeholder="Password">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Your password must be at least 4 long
                    </small>
                </div>
                <div class="form-group">
                    <label for="inputPasswordAgain">Password again</label>
                    <input type="password" name="password_again" class="form-control" id="inputPasswordAgain"
                           placeholder="Password again">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <?php if (isset($data['errors'])) : ?>
                <div class="error">
                    <?php foreach ($data['errors'] as $value) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $value ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>