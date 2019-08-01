<?php
	if (! defined('ABSPATH'))
		die;
?>
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav" id="nav-opcoes">
            <li class="nav-item">
                <a class="nav-link" href="<?= URL ?>dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>

            <?php

                if (!empty($todos_menus)) {

                    foreach ($todos_menus as $secao) {
                        if (!empty($secao['nome'])) {
                            ?>
                            <li class="nav-title"><?= $secao['nome'] ?></li>
                            <?php
                        }

                        foreach ($secao['menus'] as $menus) {

                            if (!empty($menus['submenus'])) {
                                ?>

                                <li class="nav-item nav-dropdown <?= (!empty($this->dados->menu) && strcasecmp($this->dados->menu, $menus['nome']) === 0) ? 'open' : '' ?>">
                                    <a class="nav-link nav-dropdown-toggle" href="<?= URL . $menus['url'] ?>">
                                        <i class="<?= $menus['icone'] ?>"></i> <?= $menus['nome'] ?></a>
                                    <ul class="nav-dropdown-items">

                                        <?php

                                            foreach ($menus['submenus'] as $submenus) {
                                                ?>

                                                <li class="nav-item">
                                                    <a class="nav-link <?= (!empty($this->dados->submenu) && strcasecmp($this->dados->submenu, $submenus['nome']) === 0) ? 'active' : '' ?>" href="<?= URL . $submenus['url'] ?>" target="_top">
                                                        <?= $submenus['nome'] ?>
                                                    </a>
                                                </li>

                                                <?php
                                            }

                                        ?>

                                    </ul>
                                </li>

                                <?php
                            } else { //menu sem submenus
                                ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?= URL . $menus['url'] ?>" target="_top">
                                        <i class="<?= $menus['icone'] ?>"></i> <?= $menus['nome'] ?>
                                    </a>
                                </li>

                                <?php
                            }

                        } //foreach menus
                    } //foreache seções
                } //if todos menus

            ?>

        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>