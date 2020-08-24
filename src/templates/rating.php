<?php


if (!isset($minRating)) {
    $minRating = 0;
}

if (!isset($maxRating)) {
    $maxRating = 10;
}

?>

<div class="rating">
    <?php for($i = $minRating; $i < $maxRating; $i++):?>
        <div class="star">
            <?= isset($rating) && $i < $rating ? '★' : '☆' ?>
        </div>
    <?php endfor ?>
</div>





