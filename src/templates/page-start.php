<!doctype html>
<html lang="en">

    <?php require_once __DIR__ . "/head.php" ?>


    <?php if (isset($pageClassName)): ?>
        <body class="page <?php echo $pageClassName ?>">
    <?php else: ?>
        <body class="page">
    <?php endif ?>

        <?php require_once __DIR__ . "/notification.php" ?>
