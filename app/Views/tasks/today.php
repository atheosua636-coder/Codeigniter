<?= view('templates/header', ['title' => $title]) ?>
<?= view('tasks/nav') ?>

<section class="task-page">
    <div class="task-heading">
        <div>
            <p class="task-eyebrow">TASKS FOR TODAY</p>
            <h2>Welcome</h2>
            <p class="task-muted"><?= esc(date('l, F j, Y')) ?></p>
        </div>
        <a class="button" href="<?= site_url('tasks-today/list') ?>">View all tasks</a>
    </div>

    <?php if ($tasks === []): ?>
        <div class="task-empty">
            <h3>No tasks scheduled for today</h3>
            <p>There are no records with today’s date. Check the task dates in your database.</p>
        </div>
    <?php else: ?>
        <p class="task-count"><?= count($tasks) ?> task<?= count($tasks) === 1 ? '' : 's' ?> for today</p>
        <div class="task-list">
            <?php foreach ($tasks as $task): ?>
                <article class="task-card">
                    <div>
                        <h3><?= esc($task['title']) ?></h3>
                        <p class="task-muted">Due <?= esc($task['task_date']) ?></p>
                    </div>
                    <span class="task-status"><?= esc(ucfirst($task['status'])) ?></span>
                </article>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</section>

<?= view('templates/footer') ?>
