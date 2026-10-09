<?= view('templates/header', ['title' => $title]) ?>
<?= view('tasks/nav') ?>

<section class="task-page task-about">
    <p class="task-eyebrow">TASKS FOR TODAY</p>
    <h2>About this activity</h2>
    <p>This Task Management Project is part of the Simple POS System Project to merge two projects into one instead of making another instance of codeigniter for a second project.</p>
    <p><strong>Developer:</strong> Atheo Carl C. Sua</p>
    <a class="button" href="<?= site_url('tasks-today') ?>">Back to today</a>
</section>

<?= view('templates/footer') ?>
