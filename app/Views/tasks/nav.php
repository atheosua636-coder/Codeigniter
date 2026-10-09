<nav class="task-subnav" aria-label="Tasks for Today pages">
    <a href="<?= site_url('tasks-today') ?>">Today</a>
    <a href="<?= site_url('tasks-today/list') ?>">Task List</a>
    <a href="<?= site_url('tasks-today/profile') ?>">Profile</a>
    <a href="<?= site_url('tasks-today/about') ?>">About</a>
    <?php if (session()->get('task_logged_in')): ?>
        <a href="<?= site_url('tasks/new') ?>">New Task</a>
        <form action="<?= site_url('tasks/logout') ?>" method="post" class="nav-form">
            <?= csrf_field() ?>
            <button type="submit">Log out (<?= esc(session()->get('task_username')) ?>)</button>
        </form>
    <?php else: ?>
        <a href="<?= site_url('tasks/login') ?>">Tasks Login</a>
    <?php endif ?>
</nav>
