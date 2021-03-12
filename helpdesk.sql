-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 12-Mar-2021 às 08:40
-- Versão do servidor: 8.0.23-0ubuntu0.20.04.1
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `helpdesk`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamado`
--

CREATE TABLE `chamado` (
  `id` int NOT NULL,
  `numchamado` varchar(20) NOT NULL,
  `situacao` varchar(1) NOT NULL,
  `idservico` int NOT NULL,
  `idsolicitante` int NOT NULL,
  `idsecao` int NOT NULL,
  `dataabertura` varchar(10) NOT NULL,
  `datafechamento` varchar(10) NOT NULL,
  `horaabertura` varchar(8) NOT NULL,
  `horafechamento` varchar(8) NOT NULL,
  `tecnico` int NOT NULL,
  `assunto` varchar(100) NOT NULL,
  `idetiqueta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `etiqueta`
--

CREATE TABLE `etiqueta` (
  `id` int NOT NULL,
  `numero` varchar(3) NOT NULL,
  `disponivel` varchar(1) NOT NULL,
  `totalchamados` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `etiqueta`
--

INSERT INTO `etiqueta` (`id`, `numero`, `disponivel`, `totalchamados`) VALUES
(1, '001', 'N', 2),
(2, '002', 'N', 0),
(3, '003', 'N', 1),
(4, '004', 'N', 0),
(5, '005', 'N', 0),
(6, '006', 'N', 0),
(7, '007', 'N', 4),
(8, '008', 'N', 0),
(9, '009', 'N', 0),
(10, '010', 'N', 0),
(11, '011', 'N', 0),
(12, '012', 'N', 0),
(13, '013', 'N', 0),
(14, '014', 'N', 0),
(15, '015', 'N', 0),
(16, '016', 'N', 0),
(17, '017', 'N', 0),
(18, '018', 'N', 0),
(19, '019', 'N', 0),
(20, '020', 'N', 0),
(21, '021', 'N', 0),
(22, '022', 'N', 0),
(23, '023', 'N', 0),
(24, '024', 'N', 0),
(25, '025', 'N', 0),
(26, '026', 'N', 0),
(27, '027', 'N', 0),
(28, '028', 'N', 0),
(29, '029', 'N', 0),
(30, '030', 'N', 0),
(31, '031', 'N', 0),
(32, '032', 'N', 1),
(33, '033', 'N', 1),
(34, '034', 'N', 0),
(35, '035', 'N', 9),
(36, '036', 'N', 1),
(37, '037', 'N', 2),
(38, '038', 'N', 4),
(39, '039', 'N', 6),
(40, '040', 'N', 0),
(41, '041', 'N', 0),
(42, '042', 'N', 0),
(43, '043', 'N', 1),
(44, '044', 'N', 0),
(45, '045', 'N', 1),
(46, '046', 'N', 4),
(47, '047', 'N', 0),
(48, '048', 'N', 1),
(49, '049', 'N', 1),
(50, '050', 'N', 0),
(51, '051', 'N', 0),
(52, '052', 'N', 1),
(53, '053', 'N', 1),
(54, '054', 'N', 0),
(55, '055', 'N', 1),
(56, '056', 'N', 1),
(57, '057', 'N', 1),
(58, '058', 'N', 0),
(59, '059', 'N', 2),
(60, '060', 'N', 0),
(61, '061', 'N', 0),
(62, '062', 'N', 2),
(63, '063', 'N', 4),
(64, '064', 'N', 3),
(65, '065', 'N', 1),
(66, '066', 'N', 0),
(67, '067', 'N', 2),
(68, '068', 'N', 1),
(69, '069', 'N', 3),
(70, '070', 'N', 0),
(71, '071', 'N', 0),
(72, '072', 'N', 9),
(73, '073', 'N', 1),
(74, '074', 'N', 2),
(75, '075', 'N', 6),
(76, '076', 'N', 5),
(77, '077', 'N', 1),
(78, '078', 'N', 0),
(79, '079', 'N', 0),
(80, '080', 'N', 3),
(81, '081', 'N', 3),
(82, '082', 'N', 5),
(83, '083', 'N', 3),
(84, '084', 'N', 5),
(85, '085', 'N', 2),
(86, '086', 'N', 0),
(87, '087', 'N', 0),
(88, '088', 'N', 4),
(89, '089', 'N', 2),
(90, '090', 'N', 0),
(91, '091', 'N', 1),
(92, '092', 'N', 3),
(93, '093', 'N', 0),
(94, '094', 'N', 1),
(95, '095', 'N', 3),
(96, '096', 'N', 1),
(97, '097', 'N', 0),
(98, '098', 'N', 1),
(99, '099', 'N', 1),
(100, '100', 'N', 1),
(101, '101', 'N', 2),
(102, '102', 'N', 2),
(103, '103', 'N', 1),
(104, '104', 'N', 1),
(105, '105', 'N', 1),
(106, '106', 'N', 0),
(107, '107', 'N', 1),
(108, '108', 'N', 2),
(109, '109', 'N', 2),
(110, '110', 'N', 4),
(111, '111', 'N', 1),
(112, '112', 'N', 2),
(113, '113', 'N', 1),
(114, '114', 'N', 4),
(115, '115', 'N', 3),
(116, '116', 'N', 6),
(117, '117', 'N', 5),
(118, '118', 'N', 4),
(119, '119', 'N', 1),
(120, '120', 'N', 0),
(121, '121', 'N', 1),
(122, '122', 'N', 2),
(123, '123', 'N', 4),
(124, '124', 'N', 2),
(125, '125', 'N', 2),
(126, '126', 'N', 5),
(127, '127', 'N', 0),
(128, '128', 'N', 5),
(129, '129', 'N', 1),
(130, '130', 'N', 1),
(131, '131', 'N', 0),
(132, '132', 'N', 3),
(133, '133', 'N', 1),
(134, '134', 'N', 3),
(135, '135', 'N', 0),
(136, '136', 'N', 1),
(137, '137', 'N', 4),
(138, '138', 'N', 6),
(139, '139', 'N', 3),
(140, '140', 'N', 2),
(141, '141', 'N', 0),
(142, '142', 'N', 0),
(143, '143', 'N', 0),
(144, '144', 'N', 0),
(145, '145', 'N', 3),
(146, '146', 'N', 0),
(147, '147', 'N', 5),
(148, '148', 'N', 0),
(149, '149', 'N', 2),
(150, '150', 'N', 4),
(151, '151', 'N', 0),
(152, '152', 'N', 3),
(153, '153', 'N', 1),
(154, '154', 'N', 2),
(155, '155', 'N', 0),
(156, '156', 'N', 0),
(157, '157', 'N', 0),
(158, '158', 'N', 0),
(159, '159', 'N', 2),
(160, '160', 'N', 1),
(161, '161', 'N', 0),
(162, '162', 'N', 2),
(163, '163', 'N', 2),
(164, '164', 'N', 4),
(165, '165', 'N', 2),
(166, '166', 'N', 0),
(167, '167', 'N', 0),
(168, '168', 'N', 2),
(169, '169', 'N', 0),
(170, '170', 'N', 0),
(171, '171', 'N', 0),
(172, '172', 'N', 1),
(173, '173', 'N', 2),
(174, '174', 'N', 0),
(175, '175', 'N', 3),
(176, '176', 'N', 0),
(177, '177', 'N', 1),
(178, '178', 'N', 2),
(179, '179', 'N', 0),
(180, '180', 'N', 0),
(181, '181', 'N', 0),
(182, '182', 'N', 0),
(183, '183', 'N', 0),
(184, '184', 'N', 2),
(185, '185', 'N', 0),
(186, '186', 'N', 2),
(187, '187', 'N', 0),
(188, '188', 'N', 0),
(189, '189', 'N', 0),
(190, '190', 'N', 0),
(191, '191', 'N', 0),
(192, '192', 'N', 1),
(193, '193', 'N', 1),
(194, '194', 'N', 0),
(195, '195', 'N', 0),
(196, '196', 'N', 0),
(197, '197', 'N', 0),
(198, '198', 'N', 1),
(199, '199', 'N', 0),
(200, '200', 'N', 0),
(201, '201', 'N', 0),
(202, '202', 'N', 0),
(203, '203', 'N', 0),
(204, '204', 'N', 0),
(205, '205', 'N', 0),
(206, '206', 'N', 1),
(207, '207', 'N', 1),
(208, '208', 'N', 0),
(209, '209', 'N', 1),
(210, '210', 'N', 2),
(211, '211', 'N', 0),
(212, '212', 'N', 2),
(213, '213', 'N', 1),
(214, '214', 'N', 0),
(215, '215', 'N', 0),
(216, '216', 'N', 0),
(217, '217', 'N', 2),
(218, '218', 'N', 7),
(219, '219', 'N', 0),
(220, '220', 'N', 1),
(221, '221', 'N', 0),
(222, '222', 'N', 1),
(223, '223', 'N', 3),
(224, '224', 'N', 0),
(225, '225', 'N', 0),
(226, '226', 'N', 2),
(227, '227', 'N', 0),
(228, '228', 'N', 0),
(229, '229', 'N', 0),
(230, '230', 'N', 2),
(231, '231', 'N', 4),
(232, '232', 'N', 1),
(233, '233', 'N', 0),
(234, '234', 'N', 0),
(235, '235', 'N', 1),
(236, '236', 'N', 0),
(237, '237', 'N', 0),
(238, '238', 'N', 0),
(239, '239', 'N', 0),
(240, '240', 'N', 0),
(241, '241', 'N', 0),
(242, '242', 'N', 0),
(243, '243', 'N', 0),
(244, '244', 'N', 0),
(245, '245', 'N', 0),
(246, '246', 'N', 0),
(247, '247', 'N', 0),
(248, '248', 'N', 0),
(249, '249', 'N', 0),
(250, '250', 'N', 0),
(251, '251', 'N', 0),
(252, '252', 'N', 0),
(253, '253', 'N', 0),
(254, '254', 'N', 0),
(255, '255', 'N', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int NOT NULL,
  `numchamado` varchar(20) NOT NULL,
  `texto` longtext NOT NULL,
  `anexo` varchar(200) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ip`
--

CREATE TABLE `ip` (
  `id` int NOT NULL,
  `ip` varchar(15) NOT NULL,
  `disponivel` varchar(1) NOT NULL,
  `quemusa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id` int NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `qtditem` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

CREATE TABLE `material` (
  `id` int NOT NULL,
  `iditem` int NOT NULL,
  `idetiqueta` int NOT NULL,
  `idso` int NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `secao`
--

CREATE TABLE `secao` (
  `id` int NOT NULL,
  `secao` varchar(100) NOT NULL,
  `qtdchamados` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `secao`
--

INSERT INTO `secao` (`id`, `secao`, `qtdchamados`) VALUES
(1, 'S1', 0),
(2, 'S2', 0),
(3, 'S3', 0),
(4, 'S4', 0),
(5, 'Seção de Tecnologia da Informação', 0),
(6, 'Comunicação Social', 0),
(7, 'Comandante', 0),
(8, 'Subcomandante', 0),
(9, 'Adjunto de Comando', 0),
(10, 'Fiscal Administrativo', 0),
(11, 'Fusex', 0),
(12, 'Gabinete Odontológico', 0),
(13, 'Farmácia', 0),
(14, 'Laboratório', 0),
(15, 'Seção de Saúde', 0),
(16, 'Seção de Inativos e Pensionistas', 0),
(17, 'Mobilizadora', 0),
(18, 'Identificação', 0),
(19, 'Tesouraria', 0),
(20, 'SALC', 0),
(21, 'Conformidade', 0),
(22, 'PelotÃ£o  de Transporte', 0),
(23, 'Seção Fluvial', 0),
(24, 'Rádio Operador', 0),
(25, 'Pelotão de Comunicações', 0),
(26, '1ª Cia Fuz', 0),
(27, '2ª Cia Fuz', 0),
(28, '3ª Cia Fuz', 0),
(29, 'SFPC', 0),
(30, 'CCAp', 0),
(31, 'Base Administrativa', 0),
(32, 'CED', 0),
(33, 'Pagamento de Pessoal', 0),
(34, 'Banda de Música', 0),
(35, 'Almoxarifado', 0),
(36, 'Estação Rádio', 0),
(37, 'Secretaria', 0),
(38, 'Aprovisionamento', 0),
(39, 'Sala de Impressão', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int NOT NULL,
  `servico` varchar(100) NOT NULL,
  `qtdservico` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id`, `servico`, `qtdservico`) VALUES
(1, 'Manutenção de Computador', 0),
(2, 'Impressora', 0),
(3, 'SPED', 0),
(4, 'Suporte Técnico', 0),
(5, 'Problemas de rede', 0),
(6, 'Sistemas Internos', 0),
(7, 'Zimbra', 0),
(8, 'Telefonia', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistoper`
--

CREATE TABLE `sistoper` (
  `id` int NOT NULL,
  `sistema` varchar(100) NOT NULL,
  `qtdsisop` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sistoper`
--

INSERT INTO `sistoper` (`id`, `sistema`, `qtdsisop`) VALUES
(1, 'Ubuntu 17.10 amd64', 0),
(2, 'Ubuntu 16.04.4 i386', 0),
(3, 'Ubuntu 16.04.4 amd64', 0),
(4, 'Windows 7 amd64', 0),
(5, 'Windows 7 i386', 0),
(6, 'Windows 10', 0),
(7, 'Debian 8.3 i386', 0),
(8, 'Debian 9.4.0 i386', 0),
(9, 'Debian 9.4.0 amd64', 0),
(10, 'Ubuntu 17.04 amd64', 0),
(11, 'Debian 8.3 amd64', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ip`
--
ALTER TABLE `ip`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `secao`
--
ALTER TABLE `secao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sistoper`
--
ALTER TABLE `sistoper`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamado`
--
ALTER TABLE `chamado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ip`
--
ALTER TABLE `ip`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `material`
--
ALTER TABLE `material`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `secao`
--
ALTER TABLE `secao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `sistoper`
--
ALTER TABLE `sistoper`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
