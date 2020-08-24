<header id="site-navbar">
    <div>
        <!-- dummy element, do not delete ! -->
    </div>
    <a href="" id="logo">
        [ Tough ]
    </a>

    <input type="checkbox" id="menu-toggle-checkbox" />

    <div>
        <!-- <button class="hamburger" id="menu-toggle">
          <div></div>
          <div></div>
          <div></div>
        </button> -->

        <label class="hamburger" id="menu-toggle" for="menu-toggle-checkbox">
            <div></div>
            <div></div>
            <div></div>
        </label>
    </div>

    <nav id="menu">
        <?php require_once __DIR__ . '/menu.php'; ?>
    </nav>
</header>