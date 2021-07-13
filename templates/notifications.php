<?php if (isset($messages)): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($messages as $msg): ?>
            <p><?= $msg; ?></p>
        <?php endforeach; ?>
    </div>
<?php elseif (isset($success)): ?>
    <p class="alert alert-success"><?= $success; ?></p>
<?php endif; ?>

