-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Nov-2020 às 22:52
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto_mvc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso`
--

CREATE TABLE `acesso` (
  `idacesso` int(10) UNSIGNED NOT NULL,
  `data_hora` datetime NOT NULL,
  `ip` varchar(45) NOT NULL,
  `n1_desafio` int(11) NOT NULL,
  `n2_desafio` int(11) NOT NULL,
  `resposta_desafio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

CREATE TABLE `banner` (
  `idbanner` int(10) UNSIGNED NOT NULL,
  `data_cadastro` date DEFAULT NULL,
  `data_alteracao` date DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `link` varchar(400) DEFAULT NULL,
  `opt_titulos` char(1) DEFAULT NULL,
  `opt_externo` char(1) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `ordem` int(10) UNSIGNED DEFAULT NULL,
  `img_principal` varchar(120) DEFAULT NULL,
  `img_tablet` varchar(120) DEFAULT NULL,
  `img_mobile` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banner`
--

INSERT INTO `banner` (`idbanner`, `data_cadastro`, `data_alteracao`, `titulo`, `subtitulo`, `link`, `opt_titulos`, `opt_externo`, `ativo`, `ordem`, `img_principal`, `img_tablet`, `img_mobile`) VALUES
(56, '2019-08-01', '2019-08-01', 'Projetos inovadores passam pela segunda noite de banca do edital de fomento', 'CONHEÇA OS SEUS DIREITOS', 'https://www.google.com.br', '1', '1', '0', 1, 'projetos-inovadores-passam-pela-segunda-noite-banca-do-edital-fomento-56.jpg', 'projetos-inovadores-passam-pela-segunda-noite-banca-do-edital-fomento-56.png', 'projetos-inovadores-passam-pela-segunda-noite-banca-do-edital-fomento-56.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao`
--

CREATE TABLE `configuracao` (
  `nome_site` varchar(100) NOT NULL,
  `resumo_site` varchar(100) NOT NULL,
  `logo_site` varchar(120) DEFAULT NULL,
  `favicon_site` varchar(120) DEFAULT NULL,
  `data_alteracao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `configuracao`
--

INSERT INTO `configuracao` (`nome_site`, `resumo_site`, `logo_site`, `favicon_site`, `data_alteracao`) VALUES
('teste site', 'teste siteteste siteteste siteteste siteteste siteteste siteteste siteteste siteteste siteteste site', 'teste-site.jpg', 'teste-site.png', '2019-12-09 13:30:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(60) NOT NULL,
  `url` varchar(60) DEFAULT NULL,
  `ordem` int(10) UNSIGNED DEFAULT NULL,
  `icone` varchar(45) DEFAULT NULL,
  `menu_pai` int(10) UNSIGNED DEFAULT NULL,
  `idsecao_menu` int(10) UNSIGNED DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `menu`
--

INSERT INTO `menu` (`id`, `nome`, `url`, `ordem`, `icone`, `menu_pai`, `idsecao_menu`, `ativo`) VALUES
(26, 'Usuários', '', 1, 'fas fa-user', NULL, 21, '1'),
(27, 'Permissões', '', 2, 'fas fa-user-lock', NULL, 21, '1'),
(28, 'Meu Perfil', '', 3, 'fas fa-user-edit', NULL, 21, '1'),
(30, 'Gerenciar usuários', 'usuarios/gerenciar-usuarios', 2, '', 26, NULL, '1'),
(31, 'Seções de Menus', 'permissoes/gerenciar-secoes-menus', 3, '', 27, NULL, '1'),
(32, 'Gerenciar Menus', 'permissoes/gerenciar-menus', 4, '', 27, NULL, '1'),
(33, 'Gerenciar SubMenus', 'permissoes/gerenciar-submenus', 1, '', 27, NULL, '1'),
(40, 'Tipos de usuários', 'usuarios/gerenciar-tipos-usuarios', 1, '', 26, NULL, '1'),
(41, 'Alterar Perfil', 'alterar-perfil', 1, '', 28, NULL, '1'),
(42, 'Alterar Senha', 'alterar-senha', 2, '', 28, NULL, '1'),
(43, 'Sair', 'logout', 3, '', 28, NULL, '1'),
(46, 'conteúdos', '', NULL, 'fas fa-edit', NULL, NULL, '1'),
(47, 'Gerenciar Banners', 'cadastros/banners/gerenciar-banners', NULL, '', 46, NULL, '1'),
(48, 'Configurações', '', 4, 'fas fa-cogs', NULL, 21, '1'),
(51, 'SEO', 'configuracoes/seo', NULL, '', 48, NULL, '1'),
(52, 'Email', 'configuracoes/envios-emails', NULL, '', 48, NULL, '1'),
(53, 'Gerenciar Banners', 'cadastros/banners/gerenciar-banners', NULL, 'fas fa-edit', NULL, 22, '1'),
(54, 'Gerais', 'configuracoes/gerais', NULL, '', 48, NULL, '1'),
(55, 'Ordenar menus', 'permissoes/ordernar-menus', 2, '', 27, NULL, '1'),
(56, 'Notícias', '', NULL, 'fa-thumbtack', NULL, 22, '1'),
(57, 'Categorias de notícias', 'noticias/gerenciar-categorias', NULL, '', 56, NULL, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu_has_tipo_usuario`
--

CREATE TABLE `menu_has_tipo_usuario` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `tip_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `menu_has_tipo_usuario`
--

INSERT INTO `menu_has_tipo_usuario` (`menu_id`, `tip_id`) VALUES
(26, 1),
(26, 2),
(26, 8),
(27, 1),
(27, 2),
(27, 8),
(28, 1),
(28, 2),
(28, 8),
(30, 1),
(30, 2),
(30, 8),
(31, 1),
(31, 2),
(31, 8),
(32, 1),
(32, 2),
(32, 8),
(33, 1),
(33, 2),
(33, 8),
(40, 1),
(40, 2),
(40, 8),
(41, 1),
(41, 2),
(41, 8),
(42, 1),
(42, 2),
(42, 8),
(43, 1),
(43, 2),
(43, 8),
(46, 1),
(47, 1),
(48, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `secao_menu`
--

CREATE TABLE `secao_menu` (
  `idsecao_menu` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `ativo` char(1) NOT NULL,
  `ordem` int(10) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `secao_menu`
--

INSERT INTO `secao_menu` (`idsecao_menu`, `nome`, `ativo`, `ordem`) VALUES
(20, 'Cadastros Básicos', '1', 1),
(21, 'Configurações', '1', 2),
(22, 'Conteúdos', '1', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `tip_id` int(10) UNSIGNED NOT NULL,
  `tip_dtcad` date NOT NULL,
  `tip_nome` varchar(60) NOT NULL,
  `tip_ativo` char(1) NOT NULL,
  `tip_administrador` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`tip_id`, `tip_dtcad`, `tip_nome`, `tip_ativo`, `tip_administrador`) VALUES
(1, '2019-01-20', 'Administrador', '1', '1'),
(2, '2019-01-20', 'Básico', '1', '0'),
(8, '2019-07-05', 'Professores - 123456', '1', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(10) UNSIGNED NOT NULL,
  `usu_dtCad` date NOT NULL,
  `usu_nome` varchar(60) NOT NULL,
  `usu_login` varchar(30) NOT NULL,
  `usu_senha` varchar(60) NOT NULL,
  `usu_email` varchar(60) DEFAULT NULL,
  `usu_ativo` char(1) NOT NULL,
  `usu_apelido` varchar(40) DEFAULT NULL,
  `usu_ultimoAcesso` datetime DEFAULT NULL,
  `usu_avatar` varchar(45) DEFAULT NULL,
  `usu_avatar_dados` varchar(255) DEFAULT NULL,
  `tip_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_dtCad`, `usu_nome`, `usu_login`, `usu_senha`, `usu_email`, `usu_ativo`, `usu_apelido`, `usu_ultimoAcesso`, `usu_avatar`, `usu_avatar_dados`, `tip_id`) VALUES
(1, '2018-12-21', 'Administrador do Sistema', 'admin', '$2y$10$r0I3oKZak.nrmJUlOQtSFOC5e1HOIylJxdsUMxlGr5EdKSkd2fZ/m', 'admin@admin.com', '1', 'Admin', '2020-11-08 15:36:00', '1.jpeg', '{\"x\":118.4,\"y\":0,\"width\":480,\"height\":480,\"rotate\":0,\"scaleX\":1,\"scaleY\":1}', 1),
(2, '2019-01-25', 'Lucas', 'lucas', '$2y$10$jrLwRx2kqSdm3pug9NHVuONyuSVzzjE5MSHYxg5E0eiK5mckYELZi', 'lucas.tarta@hotmail.com', '1', NULL, '2019-10-17 12:32:00', NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acesso`
--
ALTER TABLE `acesso`
  ADD PRIMARY KEY (`idacesso`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`idbanner`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_adminitrativo_menu_adminitrativo1_idx` (`menu_pai`),
  ADD KEY `fk_menu_adminitrativo_secao_menu1_idx` (`idsecao_menu`);

--
-- Indexes for table `menu_has_tipo_usuario`
--
ALTER TABLE `menu_has_tipo_usuario`
  ADD PRIMARY KEY (`menu_id`,`tip_id`),
  ADD KEY `fk_menu_has_tipo_usuario_tipo_usuario1_idx` (`tip_id`),
  ADD KEY `fk_menu_has_tipo_usuario_menu1_idx` (`menu_id`);

--
-- Indexes for table `secao_menu`
--
ALTER TABLE `secao_menu`
  ADD PRIMARY KEY (`idsecao_menu`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`tip_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `fk_usuario_tipo_usuario1_idx` (`tip_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acesso`
--
ALTER TABLE `acesso`
  MODIFY `idacesso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `idbanner` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `secao_menu`
--
ALTER TABLE `secao_menu`
  MODIFY `idsecao_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `tip_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_adminitrativo_menu_adminitrativo1` FOREIGN KEY (`menu_pai`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_menu_adminitrativo_secao_menu1` FOREIGN KEY (`idsecao_menu`) REFERENCES `secao_menu` (`idsecao_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `menu_has_tipo_usuario`
--
ALTER TABLE `menu_has_tipo_usuario`
  ADD CONSTRAINT `fk_menu_has_tipo_usuario_menu1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menu_has_tipo_usuario_tipo_usuario1` FOREIGN KEY (`tip_id`) REFERENCES `tipo_usuario` (`tip_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_tipo_usuario1` FOREIGN KEY (`tip_id`) REFERENCES `tipo_usuario` (`tip_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
