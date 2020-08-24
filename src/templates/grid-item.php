<article>
    <?php require __DIR__ . '/work-picture.php' ?>

    <div>
        <a href="work-<?php echo $project['id'] ?>">
            <?php echo $project['title'] ?>
        </a>

        <?php if (!empty($project['serviceName'])): ?>
        <span class="projects-service">
            <?php echo $project['serviceName'] ?>
        </span>
        <?php endif; ?>
    </div>
</article>


