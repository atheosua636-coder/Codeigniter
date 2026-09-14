<?= view('templates/header', ['title' => $title]) ?>

<section>
    <h2>Customer Accounts</h2>

    <p>List of registered POS customers.</p>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

<?= view('templates/footer') ?>