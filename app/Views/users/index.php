<?= view('templates/header', ['title' => $title]) ?>

<section>
    <h2>User Accounts</h2>

    <p>List of POS staff accounts.</p>
    <p><a class="button" href="<?= site_url('users/new') ?>">Add User</a></p>
    <?php if ($message = session()->getFlashdata('message')): ?>
        <p class="notice" role="status"><?= esc($message) ?></p>
    <?php endif ?>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><img class="avatar" src="<?= esc($user['avatar_url']) ?>" alt="Avatar for <?= esc($user['full_name']) ?>"></td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                    <td><a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
                </tr>
            <?php endforeach ?>
            <?php if ($users === []): ?>
                <tr><td colspan="5">No users have been added yet.</td></tr>
            <?php endif ?>
        </tbody>
    </table>
</section>

<?= view('templates/footer') ?>
