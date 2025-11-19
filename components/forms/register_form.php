<form action="register.php" method="post">
    <div class="input-container">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $username ?? "" ?>">

        <ul>
            <?php if (isset($errors["username"])): ?>
                <?php foreach ($errors["username"] as $error): ?>
                    <li class="error-message">
                        <?= $error; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="input-container">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= $email ?? "" ?>">

        <ul>
            <?php if (isset($errors["email"])): ?>
                <?php foreach ($errors["email"] as $error): ?>
                    <li class="error-message">
                        <?= $error; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="input-container">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="<?= $password ?? "" ?>">

        <ul>
            <?php if (isset($errors["password"])): ?>
                <?php foreach ($errors["password"] as $error): ?>
                    <li class="error-message">
                        <?= $error; ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="input-container">
        <label for="konfirmasi-password">Konfirmasi Password</label>
        <input type="password" name="konfirmasi-password" id="konfirmasi-password" value="<?= $konfirmasiPassword ?? "" ?>">

        <ul>
            <?php if (isset($errors["konfirmasi-password"])): ?>
                <?php foreach ($errors["konfirmasi-password"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            <?php endif; ?>
        </ul>
    </div>

    <button type="submit" name="submit">Register</button>

    <p class="description">
        Sudah memiliki akun? <a href="login.php">Login</a>
    </p>
</form>