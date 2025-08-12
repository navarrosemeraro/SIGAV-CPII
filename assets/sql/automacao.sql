-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Ago-2025 às 16:51
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `automacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

CREATE TABLE `adm` (
  `id_matricula` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nivel_acesso` enum('admin','corretor') DEFAULT 'corretor',
  `ativo` tinyint(1) DEFAULT 1,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_matricula` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `turno` enum('Manhã','Tarde','Noite') NOT NULL,
  `turma` varchar(10) NOT NULL,
  `idioma` enum('Francês','Inglês','Espanhol') NOT NULL,
  `nivel_acesso` enum('aluno') NOT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_matricula`, `nome`, `email`, `senha_hash`, `cpf`, `telefone`, `turno`, `turma`, `idioma`, `nivel_acesso`, `ativo`, `data_cadastro`, `ultimo_acesso`) VALUES
('2025001', 'João Silva', 'joao.silva@email.com', 'hash1', '12345678901', '21999990000', 'Manhã', '1A', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025002', 'Maria Oliveira', 'maria.oliveira@email.com', 'hash2', '12345678902', '21999990001', 'Tarde', '2B', 'Espanhol', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025003', 'Lucas Rocha', 'lucas.rocha@email.com', 'hash5', '12345678903', '21999990002', 'Noite', '3C', 'Francês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025004', 'Carla Nunes', 'carla.nunes@email.com', 'hash6', '12345678904', '21999990003', 'Manhã', '1B', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025005', 'Felipe Gomes', 'felipe.gomes@email.com', 'hash7', '12345678905', '21999990004', 'Tarde', '2A', 'Espanhol', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025006', 'Beatriz Ramos', 'beatriz.ramos@email.com', 'hash8', '12345678906', '21999990005', 'Manhã', '1C', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025007', 'Renata Martins', 'renata.martins@email.com', 'hash11', '12345678907', '21999990006', 'Tarde', '2C', 'Francês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025008', 'Tiago Souza', 'tiago.souza@email.com', 'hash12', '12345678908', '21999990007', 'Noite', '3A', 'Espanhol', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025009', 'Juliana Costa', 'juliana.costa@email.com', 'hash13', '12345678909', '21999990008', 'Manhã', '1C', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025010', 'André Barros', 'andre.barros@email.com', 'hash14', '12345678910', '21999990009', 'Tarde', '2B', 'Espanhol', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025011', 'Lívia Ferreira', 'livia.ferreira@email.com', 'hash15', '12345678911', '21999990010', 'Noite', '3B', 'Francês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025012', 'Gabriel Pires', 'gabriel.pires@email.com', 'hash16', '12345678912', '21999990011', 'Manhã', '1A', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('M15501238', 'Otto Emanuel Barbosa Mafra', 'ottomafr@gmail.com', 'Oebm0204', '064.099.073-89', '(21) 990142304', 'Tarde', 'DS306', 'Inglês', 'aluno', 1, '2025-08-02 16:10:58', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `corretores`
--

CREATE TABLE `corretores` (
  `id_matricula` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nivel_acesso` enum('admin','corretor') DEFAULT 'corretor',
  `ativo` tinyint(1) DEFAULT 1,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `ultimo_acesso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `corretores`
--

INSERT INTO `corretores` (`id_matricula`, `nome`, `email`, `senha_hash`, `cpf`, `telefone`, `nivel_acesso`, `ativo`, `data_cadastro`, `ultimo_acesso`) VALUES
('1234567', 'Lúcia Déborah Araújo', 'luciadeborah@gmail.com', '050507', '000.000.000-00', '(21) 99999-9999', 'corretor', 1, '2025-08-02 16:40:14', NULL),
('A1001', 'Ana Lima', 'ana.lima@email.com', 'hash4', '98765432102', '21988880001', 'admin', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1001', 'Carlos Mendes', 'carlos.mendes@email.com', 'hash3', '98765432101', '21988880000', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1002', 'Fernanda Dias', 'fernanda.dias@email.com', 'hash9', '98765432103', '21988880002', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1003', 'Ricardo Alves', 'ricardo.alves@email.com', 'hash10', '98765432104', '21988880003', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1004', 'Paula Antunes', 'paula.antunes@email.com', 'hash17', '98765432105', '21988880004', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1005', 'Eduardo Faria', 'eduardo.faria@email.com', 'hash18', '98765432106', '21988880005', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `redacao`
--

CREATE TABLE `redacao` (
  `id` int(11) NOT NULL,
  `aluno_id` varchar(20) NOT NULL,
  `corretor_id` varchar(20) DEFAULT NULL,
  `tema` varchar(255) NOT NULL,
  `caminho_arquivo` varchar(255) NOT NULL,
  `nota_total` smallint(6) DEFAULT NULL,
  `nota_comp1` smallint(6) DEFAULT NULL,
  `nota_comp2` smallint(6) DEFAULT NULL,
  `nota_comp3` smallint(6) DEFAULT NULL,
  `nota_comp4` smallint(6) DEFAULT NULL,
  `nota_comp5` smallint(6) DEFAULT NULL,
  `status_red` enum('pendente','corrigida','revisao') DEFAULT 'pendente',
  `data_envio` datetime DEFAULT current_timestamp(),
  `data_correcao` datetime DEFAULT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `redacao`
--

INSERT INTO `redacao` (`id`, `aluno_id`, `corretor_id`, `tema`, `caminho_arquivo`, `nota_total`, `nota_comp1`, `nota_comp2`, `nota_comp3`, `nota_comp4`, `nota_comp5`, `status_red`, `data_envio`, `data_correcao`, `observacoes`) VALUES
(3, 'M15501238', '1234567', 'Desafios para combater os vícios em jogos de aposta online', '../../../assets/arquivos_redacoes/2025/3_ano/redacao3.jpeg', 1000, 200, 200, 200, 200, 200, 'corrigida', '2025-08-02 16:35:33', '2025-08-02 18:15:47', NULL),
(5, 'M15501238', '1234567', 'Desafios para combater o câncer de próstata', '../../../assets/arquivos_redacoes/2025/3_ano/redacao5.jpeg', 600, 120, 120, 120, 120, 120, 'corrigida', '2025-08-02 18:57:35', '2025-08-03 18:55:56', NULL),
(7, '2025001', 'C1001', 'Os desafios da educação no Brasil', '../../../assets/arquivos_redacoes/2025/3_ano/redacao7.jpeg', 840, 160, 180, 170, 165, 165, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Bom desenvolvimento de ideias.'),
(8, '2025002', 'C1001', 'A importância da empatia nas relações sociais', '../../../assets/arquivos_redacoes/2025/3_ano/redacao8.jpeg', 900, 180, 180, 180, 180, 180, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Muito boa coesão e argumentação.'),
(9, '2025003', 'C1002', 'O papel da tecnologia na sociedade moderna', '../../../assets/arquivos_redacoes/2025/3_ano/redacao9.jpeg', 860, 170, 170, 175, 170, 175, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Bom uso de dados e argumentação sólida.'),
(10, '2025004', 'C1001', 'Caminhos para combater a desigualdade social', '../../../assets/arquivos_redacoes/2025/3_ano/redacao10.jpeg', 875, 175, 175, 175, 175, 175, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Texto bem estruturado, com ótimos exemplos.'),
(11, '2025005', 'C1003', 'A influência das redes sociais na vida cotidiana', '../../../assets/arquivos_redacoes/2025/3_ano/redacao11.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-08-03 21:46:56', NULL, NULL),
(12, '2025006', 'C1002', 'O desafio da mobilidade urbana', '../../../assets/arquivos_redacoes/2025/3_ano/redacao12.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-08-03 21:46:56', NULL, NULL),
(13, '2025007', 'C1004', 'A importância da preservação ambiental', '../../../assets/arquivos_redacoes/2025/3_ano/redacao13.jpeg', 870, 175, 170, 175, 170, 180, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Boa organização textual.'),
(14, '2025008', 'C1005', 'Desafios da mobilidade urbana nas capitais', '../../../assets/arquivos_redacoes/2025/3_ano/redacao14.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-08-03 21:46:56', NULL, NULL),
(15, '2025009', 'C1004', 'A crise hídrica e suas consequências', '../../../assets/arquivos_redacoes/2025/3_ano/redacao15.jpeg', 890, 180, 180, 175, 180, 175, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Excelente domínio do tema.'),
(16, '2025010', 'C1002', 'Fake news e o impacto na democracia', '../../../assets/arquivos_redacoes/2025/3_ano/redacao16.jpeg', 845, 165, 170, 170, 170, 170, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Revisar coesão em alguns trechos.'),
(17, '2025011', 'C1003', 'A juventude e o mercado de trabalho', '../../../assets/arquivos_redacoes/2025/3_ano/redacao17.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-08-03 21:46:56', NULL, NULL),
(18, '2025012', 'C1001', 'Racismo estrutural na sociedade brasileira', '../../../assets/arquivos_redacoes/2025/3_ano/redacao18.jpeg', 900, 180, 180, 180, 180, 180, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Excelente em todos os critérios.');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `corretores`
--
ALTER TABLE `corretores`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices para tabela `redacao`
--
ALTER TABLE `redacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `corretor_id` (`corretor_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `redacao`
--
ALTER TABLE `redacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `redacao`
--
ALTER TABLE `redacao`
  ADD CONSTRAINT `redacao_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id_matricula`),
  ADD CONSTRAINT `redacao_ibfk_2` FOREIGN KEY (`corretor_id`) REFERENCES `corretores` (`id_matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
