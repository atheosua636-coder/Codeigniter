<?= view('templates/header', ['title' => $title]) ?>

<section>
    <h2>User Accounts</h2>

    <p>List of POS staff accounts.</p>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

<?= view('templates/footer') ?>