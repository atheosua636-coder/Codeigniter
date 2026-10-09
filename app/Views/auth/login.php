<?= view('templates/header', ['title' => $title]) ?>

<section class="form-card">
    <h2>Staff Login</h2>

    <?php if ($error = session()->getFlashdata('error')): ?>
        <p class="error-message" role="alert"><?= esc($error) ?></p>
    <?php endif ?>
    <?php if ($message = session()->getFlashdata('message')): ?>
        <p class="notice" role="status"><?= esc($message) ?></p>
    <?php endif ?>

    <?= validation_list_errors() ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input id="username" name="username" type="text" maxlength="80"
               autocomplete="username" required value="<?= esc(old('username', '')) ?>">
        <?= validation_show_error('username') ?>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" maxlength="255"
               autocomplete="current-password" required>
        <?= validation_show_error('password') ?>

        <div class="form-actions">
            <button class="button" type="submit">Log In</button>
        </div>
    </form>
</section>

<?= view('templates/footer') ?>
