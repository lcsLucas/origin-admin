<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav" id="nav-opcoes">
            <li class="nav-item">
                <a class="nav-link" href="<?= URL ?>dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="nav-title">Cadastros Básicos</li>

            <li class="nav-title">Configurações</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fas fa-user-cog"></i> Usuários</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>usuarios/gerenciar-tipos-usuarios" target="_top">
                            Tipos de usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>usuarios/gerenciar-usuarios" target="_top">
                            Gerenciar usuários
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fas fa-user-lock"></i> Permissões</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>permissoes/gerenciar-secoes-menus" target="_top">
                            Gerenciar Seções
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>permissoes/gerenciar-menus" target="_top">
                            Gerenciar Menus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>" target="_top">
                            Gerenciar SubMenus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>" target="_top">
                            Controle de Acessos
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fas fa-user-edit"></i> Meu Perfil</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>alterar-perfil" target="_top">
                            Alterar Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>alterar-senha" target="_top">
                            Alterar Senha
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>logout" target="_top">
                            Sair
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>