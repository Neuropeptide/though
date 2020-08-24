<?php

$currentUrl = getCurrentURL();

?>


<ul>
    <?php if ($currentUrl === ''): ?>
        <li><a href="" class="active">Home</a></li>
    <?php else: ?>
        <li><a href="">Home</a></li>
    <?php endif ?>


    <li><a href="about" class="<?= $currentUrl === 'about' ? 'active' : '' ?>">About</a></li>

    <li><a href="what-we-do" class="<?= $currentUrl === 'what-we-do' ? 'active' : '' ?>">Services</a></li>

    <li><a href="portfolio" class="<?= $currentUrl === 'portfolio' ? 'active' : '' ?>">Portfolio</a></li>

    <li><a href="contact" class="<?= $currentUrl === 'contact' ? 'active' : '' ?>">Contact</a></li>
</ul>