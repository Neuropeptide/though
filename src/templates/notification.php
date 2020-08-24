<?php if (!empty($_SESSION['notification'])): ?>
    <div class="alert alert-<?php echo $_SESSION['notification']['level'] ?>">
        <?php
        echo $_SESSION['notification']['message'];
        unset($_SESSION['notification']);
        ?>
    </div>
<?php endif ?>