<?= view('templates/header', ['title' => $title]) ?>
<?= view('tasks/nav') ?>

<section class="task-page">
    <div class="task-heading">
        <div>
            <p class="task-eyebrow">TASKS FOR TODAY</p>
            <h2>Demo User Profile</h2>
            <p class="task-muted">The demo user record for this activity.</p>
        </div>
        <a class="button" href="<?= site_url('tasks-today') ?>">Back to today</a>
    </div>

    <?php if (empty($user)): ?>
        <div class="task-empty">
            <h3>No user record found</h3>
            <p>Add the demo user to the database to show a profile here.</p>
        </div>
    <?php else: ?>
        <dl class="profile-card">
            <div>
                <dt>Full name</dt>
                <dd><?= esc($user['full_name'] ?? 'Not provided') ?></dd>
            </div>
            <div>
                <dt>Username</dt>
                <dd><?= esc($user['username'] ?? 'Not provided') ?></dd>
            </div>
            <div>
                <dt>Email</dt>
                <dd><?= esc($user['email'] ?? 'Not provided') ?></dd>
            </div>
        </dl>
    <?php endif ?>
</section>

<?= view('templates/footer') ?>
