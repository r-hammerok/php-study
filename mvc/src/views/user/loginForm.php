<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <p class="h3 text-center px-5">Please enter your login and password</p>
            <form class="form form-login" action="/login" method="post">
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input id="inputEmail" type="email" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword"
                           placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
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
