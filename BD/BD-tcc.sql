-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Jan-2022 às 19:59
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigma`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE `paciente` (
  `nr_paciente` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tipo_documento` varchar(25) NOT NULL,
  `nr_documento` varchar(15) NOT NULL,
  `nome_paciente` varchar(45) NOT NULL,
  `apelido_paciente` varchar(40) NOT NULL,
  `data_nascimento_paciente` date NOT NULL,
  `sexo_paciente` varchar(20) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `casa` smallint(6) NOT NULL,
  `rua_avenida` varchar(100) NOT NULL,
  `telefone` int(9) NOT NULL,
  `telefone_alternativo` int(9) DEFAULT NULL,
  `nome_do_pai` varchar(120) NOT NULL,
  `nome_da_mae` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url_foto` varchar(700) NOT NULL,
  `data_criado_paciente` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_modificado_paciente` datetime DEFAULT CURRENT_TIMESTAMP,
  `criado_por` int(11) DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL
);

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Estrutura da tabela `conf_mensalidades`
--

CREATE TABLE `conf_mensalidades` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nr_paciente` int(11) NOT NULL,
  `mes` varchar(12) COLLATE utf32_bin NOT NULL,
  `recibo` bigint(20) NOT NULL,
  `ano` year(4) NOT NULL,
  `data_deposito` date NOT NULL,
  `criado_por` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modificado_por` int(11) NOT NULL,
  `data_modificacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(nr_paciente) REFERENCES paciente (nr_paciente)
  
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao_detalhes`
--

CREATE TABLE `inscricao_detalhes` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `recibo` int(11) NOT NULL,
  `nr_paciente` int(11) NOT NULL,
  `valor_inscricao` int(11) NOT NULL DEFAULT '1200',
  `valor_mensalidade` int(11) NOT NULL DEFAULT '525',
  `data_deposito` date NOT NULL,
  `criado_por` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(nr_paciente) REFERENCES paciente (nr_paciente)
);

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `nr_matricula` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nr_paciente` int(11) NOT NULL,
  `nr_horario` int(11) NOT NULL,
  `nr_pagamento` int(11) NOT NULL,
  `data_criado_pagamento` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_modificado_pagamento` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `criado_por` int(11) DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `ano` year(4) DEFAULT NULL,
  FOREIGN KEY(nr_paciente) REFERENCES paciente (nr_paciente)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

  CREATE TABLE funcionalidade (
  id_funcao Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome Char(50) NOT NULL
  );

  CREATE TABLE Product (
    Id_Produto Int PRIMARY KEY AUTO_INCREMENT,
    url_foto char(255),
    texto_imagem char(100),
    titulo_imagem char(100) UNIQUE KEY,
    preco_produto decimal(5,2)
  );

  CREATE TABLE Medic (
  Nr_medic Int AUTO_INCREMENT PRIMARY KEY,
  tipo_documento varchar(25) NOT NULL,
  nr_documento char(50) NOT NULL,
  Nome_medic Char(50) NOT NULL,
  data_nascimento_medic date NOT NULL,
  Sexo_medic varchar(1) NOT NULL,
  bairro char(50) NOT NULL,
  casa char(50) NOT NULL,
  cidade char(100) NOT NULL,
  rua_avenida char(100) NOT NULL,
  telefone Int NOT NULL,
  telefone_alternativo Int NOT NULL,
  email char(50) NOT NULL,
  url_foto char(255) NOT NULL
  );

  CREATE TABLE Funcionario (
  Nr_funcionario Int AUTO_INCREMENT PRIMARY KEY,
  id_especialidade int(4),
  tipo_documento varchar(25) NOT NULL,
  nr_documento char(50) NOT NULL,
  Nome_funcionario Char(50) NOT NULL,
  data_nasciment_funcionario date NOT NULL,
  Sexo_funcionario varchar(1) NOT NULL,
  bairro char(50) NOT NULL,
  casa char(50) NOT NULL,
  cidade char(100) NOT NULL,
  rua_avenida char(100) NOT NULL,
  telefone Int NOT NULL,
  telefone_alternativo Int NOT NULL,
  email char(50) NOT NULL,
  id_funcao Int(11),
  url_foto char(255) NOT NULL,
  FOREIGN KEY(id_funcao) REFERENCES funcionalidade (id_funcao)
  );




-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidades`
--

CREATE TABLE `mensalidades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nr_paciente` int(11) NOT NULL,
  `Jan` char(1) DEFAULT NULL,
  `Fev` char(1) DEFAULT NULL,
  `Mar` char(1) DEFAULT NULL,
  `Abr` char(1) DEFAULT NULL,
  `Mai` char(1) DEFAULT NULL,
  `Jun` char(1) DEFAULT NULL,
  `Jul` char(1) DEFAULT NULL,
  `Ago` char(1) DEFAULT NULL,
  `Sete` char(1) DEFAULT NULL,
  `Outu` char(1) DEFAULT NULL,
  `Nov` char(1) DEFAULT NULL,
  `Dez` char(1) DEFAULT NULL,
  `Ano` year(4) NOT NULL,
  FOREIGN KEY(nr_paciente) REFERENCES paciente (nr_paciente)
 
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_nivel_acesso`
--

CREATE TABLE `tabela_nivel_acesso` (
  `id_nivel_acesso` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome_nivel_acesso` varchar(50) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Extraindo dados da tabela `tabela_nivel_acesso`
--

INSERT INTO `tabela_nivel_acesso` (`id_nivel_acesso`, `nome_nivel_acesso`, `data_criacao`) VALUES
(1, 'Administrador  full  ', '2017-08-24 00:00:00'),
(2, 'Medico', '2020-03-27 19:46:08'),
(3, 'Paciente', '2017-08-24 00:00:00');


-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_usuarios`
--

CREATE TABLE `tabela_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `f_key` bigint(20),
  `usuario` varchar(50) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'Activo',
  `id_nivel_acesso` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `criado_por` varchar(50) NOT NULL,
  `data_modificacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modificado_por` varchar(50) NOT NULL
);

-- --------------------------------------------------------

CREATE TABLE `horarios` (
  `nome_horario` varchar(200) NOT NULL,
  `horario` time NOT NULL PRIMARY KEY
);

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `dia` date NOT NULL,
  `horario` time NOT NULL,
  `nr_paciente` int(11) NOT NULL,
  `nr_medic` int(11) NOT NULL,
  Id_Produto Int,
  Qte_produto Int,
  FOREIGN KEY(nr_paciente) REFERENCES paciente (nr_paciente),
  FOREIGN KEY(nr_medic) REFERENCES medic (nr_medic),
  FOREIGN KEY(horario) REFERENCES horarios (horario)
);

CREATE TABLE Estoque (
id_estoque Int NOT NULL AUTO_INCREMENT PRIMARY KEY,
qte_produto Int,
Id_Produto Int,
FOREIGN KEY(Id_Produto) REFERENCES Product (Id_Produto)
);



--
-- Extraindo dados da tabela `tabela_usuarios`
--

INSERT INTO `tabela_usuarios` (`id_usuario`, `f_key`, `usuario`, `nome`, `senha`, `estado`, `id_nivel_acesso`, `data_criacao`, `criado_por`, `data_modificacao`, `modificado_por`) VALUES
(24, 1000000017, 'Admin', 'Administrador', '21232f297a57a5a743894a0e4a801fc3', 'Activo', 1, '2020-04-26 21:07:51', '1', '2020-08-07 11:37:06', '1');

-- --------------------------------------------------------
INSERT INTO `horarios` VALUES 
('8hrs','08:00:00'),
('9hrs','09:00:00'),
('10hrs','10:00:00'),
('11hrs','11:00:00'),
('12hrs','12:00:00'),
('13hrs','13:00:00'),
('14hrs','14:00:00'),
('15hrs','15:00:00'),
('16hrs','16:00:00'),
('17hrs','17:00:00'),
('18hrs','18:00:00'),
('19hrs','19:00:00');

--
-- 
--

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD UNIQUE KEY `nr_documento` (`nr_documento`);

--

--
-- Indexes for table `conf_mensalidades`
--
--
-- Indexes for table `inscricao_detalhes`
--


--
-- Indexes for table `matricula`
--


--
-- Indexes for table `mensalidades`
--

--
-- Indexes for table `tabela_usuarios`
--
ALTER TABLE `tabela_usuarios`
  ADD UNIQUE KEY `usuario` (`usuario`);

--

--

