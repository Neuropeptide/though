<article class="feedback">
    <div class="feedback-profile">
        <img
            src="./img/<?php echo $feedback['avatar'] ?>"
            alt="La photo de profil de <?php echo $feedback['avatar'] ?>"
        >
    </div>

    <p class="feedback-content">
        <?php echo htmlspecialchars($feedback['content']) ?>
    </p>


    <?php
        $rating = $feedback['rating'];
        $minRating = 0;
        $maxRating = 5;

        include __DIR__ . '/rating.php'
    ?>

    <h5 class="feedback-author">
        <?php echo $feedback['author'] ?>
    </h5>

    <p class="feedback-job">
        <?php echo $feedback['job'] ?>
    </p>

</article>
