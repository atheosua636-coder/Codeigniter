<?= view('templates/header', ['title' => $title]) ?>
<?= view('tasks/nav') ?>

<section class="task-page">
    <div class="task-heading">
        <div>
            <p class="task-eyebrow">TASKS FOR TODAY</p>
            <h2>Task List</h2>
            <p class="task-muted">Every task, ordered by date.</p>
        </div>
        <a class="button" href="<?= site_url('tasks-today') ?>">Back to today</a>
    </div>

    <?php if ($message = session()->getFlashdata('message')): ?>
        <p class="notice" role="status"><?= esc($message) ?></p>
    <?php endif ?>
    <?php if (session()->get('task_logged_in')): ?>
        <p><a class="button" href="<?= site_url('tasks/new') ?>">Add a task</a></p>
    <?php endif ?>

    <?php if ($tasks === []): ?>
        <div class="task-empty">
            <h3>No tasks found</h3>
            <p>Add task records to the database to see them here.</p>
        </div>
    <?php else: ?>
        <div class="task-table-wrap">
            <table class="task-table">
                <thead>
                    <tr>
                        <th scope="col">Task</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <?php if (session()->get('task_logged_in')): ?><th scope="col">Actions</th><?php endif ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= esc($task['title']) ?></td>
                            <td><?= esc($task['task_date']) ?></td>
                            <td><span class="task-status"><?= esc(ucfirst($task['status'])) ?></span></td>
                            <?php if (session()->get('task_logged_in')): ?>
                                <td class="task-actions">
                                    <a href="<?= site_url('tasks/' . $task['id'] . '/edit') ?>">Edit</a>
                                    <form action="<?= site_url('tasks/' . $task['id'] . '/delete') ?>" method="post" onsubmit="return confirm('Archive this task?')">
                                        <?= csrf_field() ?>
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>

<?= view('templates/footer') ?>
