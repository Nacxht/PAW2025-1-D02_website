<!-- Form yang berisi input-input untuk halaman registrasi -->
<form action="register.php" method="post">
    <div class="input-container">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $username ?? "" ?>">

        <ul>
            <!-- Menampilkan pesan-pesan error -->
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
            <!-- Menampilkan pesan-pesan error -->
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
        <input type="password" name="password" id="password">

        <ul>
            <!-- Menampilkan pesan-pesan error -->
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
        <input type="password" name="konfirmasi-password" id="konfirmasi-password">

        <ul>
            <!-- Menampilkan pesan-pesan error -->
            <?php if (isset($errors["konfirmasi-password"])): ?>
                <?php foreach ($errors["konfirmasi-password"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Menampilkan pesan-pesan error -->
    <?php if (isset($errors["register"])): ?>
        <div class="process-error">
            <p><?= $errors["register"] ?></p>
        </div>
    <?php endif ?>

    <button type="submit" name="submit" class="btn btn-primary">
        Register
    </button>
</form>