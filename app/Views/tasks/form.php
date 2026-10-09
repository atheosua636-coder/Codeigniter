<?= view('templates/header', ['title' => $title]) ?>
<?= view('tasks/nav') ?>

<section class="form-card">
    <p class="task-eyebrow">TASKS FOR TODAY</p>
    <h2><?= esc($heading) ?></h2>
    <?= validation_list_errors() ?>

    <form action="<?= esc($action) ?>" method="post">
        <?= csrf_field() ?>
        <label for="title">Title</label>
        <input id="title" name="title" type="text" maxlength="150" required
               value="<?= esc(old('title', $task['title'])) ?>">
        <?= validation_show_error('title') ?>

        <label for="task_date">Task date</label>
        <input id="task_date" name="task_date" type="date" required
               value="<?= esc(old('task_date', $task['task_date'])) ?>">
        <?= validation_show_error('task_date') ?>

        <label for="status">Status</label>
        <?php $status = old('status', $task['status']); ?>
        <select id="status" name="status">
            <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
        </select>
        <?= validation_show_error('status') ?>

        <div class="form-actions">
            <button class="button" type="submit">Save Task</button>
            <a href="<?= site_url('tasks') ?>">Cancel</a>
        </div>
    </form>
</section>

<?= view('templates/footer') ?>
