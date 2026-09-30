<?= view('templates/header', ['title' => $title]) ?>

<section>
    <h2>Customer Accounts</h2>

    <p>List of registered POS customers.</p>
    <p><a class="button" href="<?= site_url('customers/new') ?>">Add Customer</a></p>
    <?php if ($message = session()->getFlashdata('message')): ?>
        <p class="notice" role="status"><?= esc($message) ?></p>
    <?php endif ?>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone'] ?? '') ?></td>
                    <td><a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach ?>
            <?php if ($customers === []): ?>
                <tr><td colspan="4">No customers have been added yet.</td></tr>
            <?php endif ?>
        </tbody>
    </table>
</section>

<?= view('templates/footer') ?>
