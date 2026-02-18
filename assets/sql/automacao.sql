-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2026 at 07:46 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automacao`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm`
--

CREATE TABLE `adm` (
  `id_matricula` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nivel_acesso` enum('admin','corretor') COLLATE utf8mb4_general_ci DEFAULT 'corretor',
  `ativo` tinyint(1) DEFAULT '1',
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alunos`
--

CREATE TABLE `alunos` (
  `id_matricula` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `turno` enum('Manhã','Tarde','Noite') COLLATE utf8mb4_general_ci NOT NULL,
  `turma` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `idioma` enum('Francês','Inglês','Espanhol') COLLATE utf8mb4_general_ci NOT NULL,
  `nivel_acesso` enum('aluno') COLLATE utf8mb4_general_ci NOT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corretores`
--

CREATE TABLE `corretores` (
  `id_matricula` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nivel_acesso` enum('admin','corretor') COLLATE utf8mb4_general_ci DEFAULT 'corretor',
  `ativo` tinyint(1) DEFAULT '1',
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redacao`
--

CREATE TABLE `redacao` (
  `id` int NOT NULL,
  `aluno_id` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `corretor_id` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tema` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nota_total` smallint DEFAULT NULL,
  `nota_comp1` smallint DEFAULT NULL,
  `nota_comp2` smallint DEFAULT NULL,
  `nota_comp3` smallint DEFAULT NULL,
  `nota_comp4` smallint DEFAULT NULL,
  `nota_comp5` smallint DEFAULT NULL,
  `status_red` enum('pendente','corrigida','revisao') COLLATE utf8mb4_general_ci DEFAULT 'pendente',
  `data_envio` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_correcao` datetime DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_general_ci,
  `caminho_arquivo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suporte`
--

CREATE TABLE `suporte` (
  `id` int NOT NULL,
  `tipo_usuario` enum('aluno','professor','outro') COLLATE utf8mb4_general_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `matricula` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `motivo` enum('problema técnico','nota','conta','sugestão','outro') COLLATE utf8mb4_general_ci NOT NULL,
  `tema` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mensagem` text COLLATE utf8mb4_general_ci NOT NULL,
  `prioridade` enum('baixa','média','alta') COLLATE utf8mb4_general_ci DEFAULT 'baixa',
  `caminho_anexo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_envio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pendente','em andamento','respondido') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pendente',
  `resposta` varchar(5000) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `corretores`
--
ALTER TABLE `corretores`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `redacao`
--
ALTER TABLE `redacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `corretor_id` (`corretor_id`);

--
-- Indexes for table `suporte`
--
ALTER TABLE `suporte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `redacao`
--
ALTER TABLE `redacao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suporte`
--
ALTER TABLE `suporte`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `redacao`
--
ALTER TABLE `redacao`
  ADD CONSTRAINT `redacao_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id_matricula`),
  ADD CONSTRAINT `redacao_ibfk_2` FOREIGN KEY (`corretor_id`) REFERENCES `corretores` (`id_matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
