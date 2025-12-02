<!-- Form yang berisi input-input untuk profil / sunting profil (tergantung modenya) -->
<form method="post">
    <div class="inputs">
        <div class="input-container">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $user["username"] ?>" <?= $isEdit ? "" : "disabled" ?>>

            <!-- Menampilkan pesan-pesan error -->
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
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= $user["email"] ?>" <?= $isEdit ? "" : "disabled" ?>>

            <!-- Menampilkan pesan-pesan error -->
            <?php if (isset($errors["email"])): ?>
                <ul>
                    <?php foreach ($errors["email"] as $error): ?>
                        <li class="error-message">
                            <?= $error ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </div>

        <?php if ($isEdit): ?>
            <button type="submit" name="profile-edit-submit" class="btn btn-success">
                Simpan Suntingan
            </button>
        <?php endif ?>
    </div>
</form>