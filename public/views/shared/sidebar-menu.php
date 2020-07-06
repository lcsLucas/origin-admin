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
                            </ul>

                            <?php
                        }
                    ?>

                </li>

                <?php
            }
        }
    }
    ?>

</ul>