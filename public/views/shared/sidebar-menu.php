<?php
	if (! defined('ABSPATH'))
		die;
?>

<ul class="c-sidebar-nav">

    <?php
    if (!empty($todos_menus)) {
        foreach ($todos_menus as $secao) {
            if (!empty($secao['nome'])) {
            ?>
                <li class="c-sidebar-nav-title"><?= $secao['nome'] ?></li>
            <?php
            }
            foreach ($secao['menus'] as $menus) {
                ?>

                <li class="c-sidebar-nav-item <?= (!empty($menus['submenus'])) ? 'c-sidebar-nav-dropdown' : '' ?>">
                    <a class="c-sidebar-nav-link <?= (!empty($menus['submenus'])) ? 'c-sidebar-nav-dropdown-toggle' : '' ?>" href="<?= (!empty($menus['submenus'])) ? '#' : URL . $menus['url'] ?>">
                        <i class="<?= $menus['icone'] ?>"></i>
                        <?= $menus['nome'] ?>
                    </a>

                    <?php
                        if (!empty($menus['submenus'])) {
                            ?>

                            <ul class="c-sidebar-nav-dropdown-items">
                                <?php
                                    foreach ($menus['submenus'] as $submenus) {
                                        ?>
                                        <li class="c-sidebar-nav-item">
                                            <a class="c-sidebar-nav-link" href="<?= URL . $submenus['url'] ?>">
                                                <span class="c-sidebar-nav-icon"></span>
                                                <?= $submenus['nome'] ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                ?>

                                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="notifications/badge.html"><span
                                            class="c-sidebar-nav-icon"></span> Badge</a></li>
                                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="notifications/modals.html"><span
                                            class="c-sidebar-nav-icon"></span> Modals</a></li>
                            </ul>

                            <?php
                        }
                    ?>

                </li>

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="widgets.html">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-calculator"></use>
                        </svg> Widgets<span class="badge badge-info">NEW</span>
                    </a>
                </li>

                <?php
            }
        }
    }
    ?>

    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="index.html">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
            </svg> Dashboard<span class="badge badge-info">NEW</span></a></li>
    <li class="c-sidebar-nav-title">Theme</li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="colors.html">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-drop1"></use>
            </svg> Colors</a></li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="typography.html">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-pencil"></use>
            </svg> Typography</a></li>
    <li class="c-sidebar-nav-title">Components</li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a
            class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-puzzle"></use>
            </svg> Base</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><span
                        class="c-sidebar-nav-icon"></span> Breadcrumb</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/cards.html"><span
                        class="c-sidebar-nav-icon"></span> Cards</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/carousel.html"><span
                        class="c-sidebar-nav-icon"></span> Carousel</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/collapse.html"><span
                        class="c-sidebar-nav-icon"></span> Collapse</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/forms.html"><span
                        class="c-sidebar-nav-icon"></span> Forms</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/jumbotron.html"><span
                        class="c-sidebar-nav-icon"></span> Jumbotron</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/list-group.html"><span
                        class="c-sidebar-nav-icon"></span> List group</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/navs.html"><span
                        class="c-sidebar-nav-icon"></span> Navs</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/pagination.html"><span
                        class="c-sidebar-nav-icon"></span> Pagination</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/popovers.html"><span
                        class="c-sidebar-nav-icon"></span> Popovers</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/progress.html"><span
                        class="c-sidebar-nav-icon"></span> Progress</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/scrollspy.html"><span
                        class="c-sidebar-nav-icon"></span> Scrollspy</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/switches.html"><span
                        class="c-sidebar-nav-icon"></span> Switches</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tables.html"><span
                        class="c-sidebar-nav-icon"></span> Tables</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tabs.html"><span
                        class="c-sidebar-nav-icon"></span> Tabs</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/tooltips.html"><span
                        class="c-sidebar-nav-icon"></span> Tooltips</a></li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a
            class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-cursor"></use>
            </svg> Buttons</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/buttons.html"><span
                        class="c-sidebar-nav-icon"></span> Buttons</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/button-group.html"><span
                        class="c-sidebar-nav-icon"></span> Buttons Group</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/dropdowns.html"><span
                        class="c-sidebar-nav-icon"></span> Dropdowns</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="buttons/brand-buttons.html"><span
                        class="c-sidebar-nav-icon"></span> Brand Buttons</a></li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="charts.html">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-chart-pie"></use>
            </svg> Charts</a></li>
    <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-star"></use>
            </svg> Icons</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="icons/coreui-icons-free.html">
                    CoreUI Icons<span class="badge badge-success">Free</span></a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="icons/coreui-icons-brand.html">
                    CoreUI Icons - Brand</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="icons/coreui-icons-flag.html">
                    CoreUI Icons - Flag</a></li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a
            class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-bell"></use>
            </svg> Notifications</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="notifications/alerts.html"><span
                        class="c-sidebar-nav-icon"></span> Alerts</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="notifications/badge.html"><span
                        class="c-sidebar-nav-icon"></span> Badge</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="notifications/modals.html"><span
                        class="c-sidebar-nav-icon"></span> Modals</a></li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="widgets.html">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-calculator"></use>
            </svg> Widgets<span class="badge badge-info">NEW</span></a></li>
    <li class="c-sidebar-nav-divider"></li>
    <li class="c-sidebar-nav-title">Extras</li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown"><a
            class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-star"></use>
            </svg> Pages</a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="login.html" target="_top">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-account-logout"></use>
                    </svg> Login</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="register.html" target="_top">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-account-logout"></use>
                    </svg> Register</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="404.html" target="_top">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-bug"></use>
                    </svg> Error 404</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="500.html" target="_top">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-bug"></use>
                    </svg> Error 500</a></li>
        </ul>
    </li>
</ul>