-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/06/2025 às 03:27
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `automação - tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_matricula` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `turno` enum('Manhã','Tarde','Noite') NOT NULL,
  `turma` varchar(10) NOT NULL,
  `idioma` enum('Francês','Inglês','Espanhol') NOT NULL,
  `nivel_acesso` enum('aluno') DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `corretores`
--

CREATE TABLE `corretores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `area_atuacao` varchar(100) DEFAULT NULL,
  `nivel_acesso` enum('admin','corretor') DEFAULT 'corretor',
  `ativo` tinyint(1) DEFAULT 1,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `questoes`
--

CREATE TABLE `questoes` (
  `id` int(11) NOT NULL,
  `codigo_enem` varchar(20) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `area` enum('Linguagens','Humanas','Natureza','Matemática') NOT NULL,
  `enunciado` text NOT NULL,
  `alternativa_a` text NOT NULL,
  `alternativa_b` text NOT NULL,
  `alternativa_c` text NOT NULL,
  `alternativa_d` text NOT NULL,
  `alternativa_e` text NOT NULL,
  `gabarito` enum('A','B','C','D','E') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `redacao`
--

CREATE TABLE `redacao` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `corretor_id` int(11) DEFAULT NULL,
  `tema` varchar(255) NOT NULL,
  `texto_arquivo` blob NOT NULL,
  `nota_total` decimal(5,2) DEFAULT NULL,
  `nota_comp1` decimal(5,2) DEFAULT NULL,
  `nota_comp2` decimal(5,2) DEFAULT NULL,
  `nota_comp3` decimal(5,2) DEFAULT NULL,
  `nota_comp4` decimal(5,2) DEFAULT NULL,
  `nota_comp5` decimal(5,2) DEFAULT NULL,
  `status_red` enum('pendente','corrigida','revisao') DEFAULT 'pendente',
  `data_envio` datetime DEFAULT current_timestamp(),
  `data_correcao` datetime DEFAULT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_aluno`
--

CREATE TABLE `respostas_aluno` (
  `id` int(11) NOT NULL,
  `simulado_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `questao_id` int(11) NOT NULL,
  `resposta` enum('A','B','C','D','E') NOT NULL,
  `correta` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_simulado`
--

CREATE TABLE `respostas_simulado` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `simulado_id` int(11) NOT NULL,
  `nota_linguagens` decimal(5,2) DEFAULT NULL,
  `nota_humanas` decimal(5,2) DEFAULT NULL,
  `nota_natureza` decimal(5,2) DEFAULT NULL,
  `nota_matematica` decimal(5,2) DEFAULT NULL,
  `nota_total` decimal(5,2) DEFAULT NULL,
  `status` enum('pendente','concluido') DEFAULT 'pendente',
  `hora_inicio` datetime DEFAULT NULL,
  `hora_fim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `simulados`
--

CREATE TABLE `simulados` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_aplicacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `simulado_questoes`
--

CREATE TABLE `simulado_questoes` (
  `id` int(11) NOT NULL,
  `simulado_id` int(11) NOT NULL,
  `questao_id` int(11) NOT NULL,
  `ordem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `corretores`
--
ALTER TABLE `corretores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `redacao`
--
ALTER TABLE `redacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `corretor_id` (`corretor_id`);

--
-- Índices de tabela `respostas_aluno`
--
ALTER TABLE `respostas_aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `simulado_id` (`simulado_id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `questao_id` (`questao_id`);

--
-- Índices de tabela `respostas_simulado`
--
ALTER TABLE `respostas_simulado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `simulado_id` (`simulado_id`);

--
-- Índices de tabela `simulados`
--
ALTER TABLE `simulados`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `simulado_questoes`
--
ALTER TABLE `simulado_questoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `simulado_id` (`simulado_id`),
  ADD KEY `questao_id` (`questao_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `corretores`
--
ALTER TABLE `corretores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redacao`
--
ALTER TABLE `redacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `respostas_aluno`
--
ALTER TABLE `respostas_aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `respostas_simulado`
--
ALTER TABLE `respostas_simulado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `simulados`
--
ALTER TABLE `simulados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `simulado_questoes`
--
ALTER TABLE `simulado_questoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `redacao`
--
ALTER TABLE `redacao`
  ADD CONSTRAINT `redacao_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id_matricula`),
  ADD CONSTRAINT `redacao_ibfk_2` FOREIGN KEY (`corretor_id`) REFERENCES `corretores` (`id`);

--
-- Restrições para tabelas `respostas_aluno`
--
ALTER TABLE `respostas_aluno`
  ADD CONSTRAINT `respostas_aluno_ibfk_1` FOREIGN KEY (`simulado_id`) REFERENCES `simulados` (`id`),
  ADD CONSTRAINT `respostas_aluno_ibfk_2` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id_matricula`),
  ADD CONSTRAINT `respostas_aluno_ibfk_3` FOREIGN KEY (`questao_id`) REFERENCES `questoes` (`id`);

--
-- Restrições para tabelas `respostas_simulado`
--
ALTER TABLE `respostas_simulado`
  ADD CONSTRAINT `respostas_simulado_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id_matricula`),
  ADD CONSTRAINT `respostas_simulado_ibfk_2` FOREIGN KEY (`simulado_id`) REFERENCES `simulados` (`id`);

--
-- Restrições para tabelas `simulado_questoes`
--
ALTER TABLE `simulado_questoes`
  ADD CONSTRAINT `simulado_questoes_ibfk_1` FOREIGN KEY (`simulado_id`) REFERENCES `simulados` (`id`),
  ADD CONSTRAINT `simulado_questoes_ibfk_2` FOREIGN KEY (`questao_id`) REFERENCES `questoes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
