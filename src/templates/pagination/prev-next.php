<?php if ($page > 1): ?>
    <a href="<?= $prevPage ?>"> &lt; Page précédente</a>
<?php else: ?>
    <span class="disabled"> &lt; Page précédente</span>
<?php endif ?>

<?php if ($page < $nbPages): ?>
    <a href="<?= $nextPage ?>">Page suivante &gt; </a>
<?php else: ?>
    <span class="disabled"> Page suivante &gt;</span>
<?php endif ?>