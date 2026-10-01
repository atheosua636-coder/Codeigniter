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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= esc($task['title']) ?></td>
                            <td><?= esc($task['task_date']) ?></td>
                            <td><span class="task-status"><?= esc(ucfirst($task['status'])) ?></span></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>

<?= view('templates/footer') ?>
