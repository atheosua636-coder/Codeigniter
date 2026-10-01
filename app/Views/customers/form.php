<?= view('templates/header', ['title' => $title]) ?>

<section class="form-card">
    <h2><?= esc($heading) ?></h2>
    <?= validation_list_errors() ?>

    <form action="<?= esc($action) ?>" method="post">
        <?= csrf_field() ?>

        <label for="full_name">Full name <span aria-hidden="true">*</span></label>
        <input id="full_name" name="full_name" type="text" maxlength="150" required
               value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>">
        <?= validation_show_error('full_name') ?>

        <label for="email">Email address <span aria-hidden="true">*</span></label>
        <input id="email" name="email" type="email" maxlength="254" required
               value="<?= esc(old('email', $customer['email'] ?? '')) ?>">
        <?= validation_show_error('email') ?>

        <label for="phone">Phone number</label>
        <input id="phone" name="phone" type="text" maxlength="40"
               value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>">
        <?= validation_show_error('phone') ?>

        <div class="form-actions">
            <button class="button" type="submit">Save Customer</button>
            <a href="<?= site_url('customers') ?>">Cancel</a>
        </div>
    </form>
</section>

<?= view('templates/footer') ?>
