<?= view('templates/header', ['title' => $title]) ?>

<section class="form-card">
    <h2><?= esc($heading) ?></h2>

    <?php if ($uploadError = session()->getFlashdata('uploadError')): ?>
        <p class="error-message" role="alert"><?= esc($uploadError) ?></p>
    <?php endif ?>
    <?= validation_list_errors() ?>

    <form action="<?= esc($action) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="username">Username <span aria-hidden="true">*</span></label>
        <input id="username" name="username" type="text" maxlength="80" required
               value="<?= esc(old('username', $user['username'] ?? '')) ?>">
        <?= validation_show_error('username') ?>

        <label for="full_name">Full name <span aria-hidden="true">*</span></label>
        <input id="full_name" name="full_name" type="text" maxlength="150" required
               value="<?= esc(old('full_name', $user['full_name'] ?? '')) ?>">
        <?= validation_show_error('full_name') ?>

        <?php if (! $isEdit): ?>
            <label for="password">Initial password <span aria-hidden="true">*</span></label>
            <input id="password" name="password" type="password" minlength="8" maxlength="255"
                   autocomplete="new-password" required>
            <?= validation_show_error('password') ?>
        <?php endif ?>

        <?php if ($isEdit): ?>
            <label for="avatar">Profile picture (JPG or PNG, up to 2 MB)</label>
            <div class="avatar-preview">
                <img class="avatar avatar-large" src="<?= esc($user['avatar_url']) ?>" alt="Current avatar for <?= esc($user['full_name']) ?>">
                <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
            </div>
            <p class="help-text">Leave this empty to keep the current picture. The saved image is cropped to a 160 × 160 thumbnail.</p>
            <?= validation_show_error('avatar') ?>
        <?php endif ?>

        <div class="form-actions">
            <button class="button" type="submit">Save User</button>
            <a href="<?= site_url('users') ?>">Cancel</a>
        </div>
    </form>
</section>

<?= view('templates/footer') ?>
