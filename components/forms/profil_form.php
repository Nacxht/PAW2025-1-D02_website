<div class="inputs">
    <div class="input-container">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $user["username"] ?>" <?= $isEdit ? "" : "disabled" ?>>

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

    <div class="input-container password">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" disabled>
    </div>

    <div class="input-container">
        <label for="role">Role</label>

        <select name="role" id="role" <?= $isEdit ? "" : "disabled" ?>>
            <option value="admin" <?= $user["role"] == "admin" ? "selected" : "" ?>>Admin</option>
            <option value="calon_siswa" <?= $user["role"] == "calon_siswa" ? "selected" : "" ?>>Calon Siswa</option>
        </select>
    </div>

    <?php if ($isEdit): ?>
        <button type="submit" name="profile-edit-submit" value="profile-edit-submit" class="btn btn-success">
            Simpan Suntingan
        </button>
    <?php endif ?>
</div>