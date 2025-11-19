<form action="login.php" method="post">
    <div class="input-container">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $username ?? "" ?>">

        <?php if (isset($errors["username"])): ?>
            <ul>
                <?php foreach ($errors["username"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>

    <div class="input-container">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="<?= $password ?? "" ?>">

        <?php if (isset($errors["password"])): ?>
            <ul>
                <?php foreach ($errors["password"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>

    <button type="submit" name="login-submit" value="login-submit">
        Login
    </button>

    <p>
        Belum memiliki akun? <a href="register.php">Register</a>
    </p>
</form>