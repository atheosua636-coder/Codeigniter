<?= view('templates/header', ['title' => $title]) ?>

<section class="hero">
    <h2>Welcome to the Simple POS System</h2>

    <p>
        This application provides basic customer and user account
        management for a point-of-sale system.
    </p>

    <div class="actions">
        <a class="button" href="<?= site_url('customers') ?>">
            View Customers
        </a>

        <a class="button" href="<?= site_url('users') ?>">
            View Users
        </a>
    </div>
</section>

<?= view('templates/footer') ?>