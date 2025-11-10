-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/11/2025 às 22:42
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
-- Banco de dados: `automacao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id_matricula`, `nome`, `email`, `senha_hash`, `cpf`, `telefone`, `turno`, `turma`, `idioma`, `nivel_acesso`, `ativo`, `data_cadastro`, `ultimo_acesso`) VALUES
('2025001', 'João Silva', 'joao.silva@email.com', 'hash1', '12345678901', '21999990000', 'Tarde', '2302', 'Espanhol', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025002', 'Maria Oliveira', 'maria.oliveira@email.com', 'hash2', '12345678902', '21999990001', 'Tarde', 'DS304', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025003', 'Lucas Rocha', 'lucas.rocha@email.com', 'hash5', '12345678903', '21999990002', 'Tarde', 'DS306', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025004', 'Carla Nunes', 'carla.nunes@email.com', 'hash6', '12345678904', '21999990003', 'Manhã', 'ADM305', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025005', 'Felipe Gomes', 'felipe.gomes@email.com', 'hash7', '12345678905', '21999990004', 'Manhã', '1303', 'Espanhol', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025006', 'Beatriz Ramos', 'beatriz.ramos@email.com', 'hash8', '12345678906', '21999990005', 'Manhã', '1301', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025007', 'Renata Martins', 'renata.martins@email.com', 'hash11', '12345678907', '21999990006', 'Tarde', 'DS304', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025008', 'Tiago Souza', 'tiago.souza@email.com', 'hash12', '12345678908', '21999990007', 'Tarde', 'DS306', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025009', 'Juliana Costa', 'juliana.costa@email.com', 'hash13', '12345678909', '21999990008', 'Manhã', 'ADM305', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025010', 'André Barros', 'andre.barros@email.com', 'hash14', '12345678910', '21999990009', 'Tarde', '2302', 'Espanhol', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025011', 'Lívia Ferreira', 'livia.ferreira@email.com', 'hash15', '12345678911', '21999990010', 'Manhã', '1303', 'Francês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('2025012', 'Gabriel Pires', 'gabriel.pires@email.com', 'hash16', '12345678912', '21999990011', 'Manhã', '1301', 'Inglês', 'aluno', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('4234209', 'Maria Clara Oliveira', 'maria.oliveira423@dominio.com', 'hash_senha_placeholder', '222.222.222-22', '21999990012', 'Tarde', 'DS306', 'Inglês', 'aluno', 1, '2025-10-28 19:23:49', NULL),
('836893729', 'Ana Beatriz Costa', 'ana.costa836@dominio.com', 'hash_senha_placeholder', '444.444.444-44', '21999990013', 'Tarde', 'DS306', 'Inglês', 'aluno', 1, '2025-10-28 19:23:49', NULL),
('84993492', 'João Pedro Silva', 'joao.silva849@dominio.com', 'hash_senha_placeholder', '111.111.111-11', '21999990014', 'Tarde', 'DS304', 'Inglês', 'aluno', 1, '2025-10-28 19:23:49', NULL),
('91103414', 'Giovanni Navarro Semeraro', 'semerarogiovanni05@gmail.com', '050507', '031.845.622-57', '(21) 96712-1840', 'Tarde', 'DS306', 'Inglês', 'aluno', 1, '2025-11-10 15:53:14', NULL),
('9172827', 'Lucas Souza', 'lucas.souza917@dominio.com', 'hash_senha_placeholder', '333.333.333-33', '21999990015', 'Manhã', 'ADM305', 'Inglês', 'aluno', 1, '2025-10-28 19:23:49', NULL),
('M15501238', 'Otto Emanuel Barbosa Mafra', 'ottomafr@gmail.com', 'Oebm0204', '064.099.073-89', '(21) 990142304', 'Tarde', 'DS306', 'Inglês', 'aluno', 1, '2025-08-02 16:10:58', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `corretores`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `corretores`
--

INSERT INTO `corretores` (`id_matricula`, `nome`, `email`, `senha_hash`, `cpf`, `telefone`, `nivel_acesso`, `ativo`, `data_cadastro`, `ultimo_acesso`) VALUES
('1234567', 'Lúcia Déborah Araújo', 'luciadeborah@gmail.com', '050507', '000.000.000-00', '(21) 99999-9999', 'corretor', 1, '2025-08-02 16:40:14', NULL),
('929292', 'Ana Luísa Duboc', 'analuisaduboc@gmail.com', '050507', '187.362.207-93', '21997953015', 'corretor', 1, '2025-10-15 10:42:17', NULL),
('9999', 'Giovanni Navarro Semeraro', 'semerarogiovanni05@gmail.com', '050507', '184.562.257-03', '21997953015', 'corretor', 1, '2025-10-15 12:37:08', NULL),
('999999', 'Luis Augusto Pereira', 'luisaugusto@gmail.com', '050507', '162.708.097-03', '21997953015', 'corretor', 1, '2025-10-15 11:13:38', NULL),
('A1001', 'Ana Lima', 'ana.lima@email.com', 'hash4', '98765432102', '21988880001', 'admin', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1001', 'Carlos Mendes', 'carlos.mendes@email.com', 'hash3', '98765432101', '21988880000', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1002', 'Fernanda Dias', 'fernanda.dias@email.com', 'hash9', '98765432103', '21988880002', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1003', 'Ricardo Alves', 'ricardo.alves@email.com', 'hash10', '98765432104', '21988880003', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1004', 'Paula Antunes', 'paula.antunes@email.com', 'hash17', '98765432105', '21988880004', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56'),
('C1005', 'Eduardo Faria', 'eduardo.faria@email.com', 'hash18', '98765432106', '21988880005', 'corretor', 1, '2025-08-03 21:46:56', '2025-08-03 21:46:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `redacao`
--

CREATE TABLE `redacao` (
  `id` int(11) NOT NULL,
  `aluno_id` varchar(20) NOT NULL,
  `corretor_id` varchar(20) DEFAULT NULL,
  `tema` varchar(255) NOT NULL,
  `nota_total` smallint(6) DEFAULT NULL,
  `nota_comp1` smallint(6) DEFAULT NULL,
  `nota_comp2` smallint(6) DEFAULT NULL,
  `nota_comp3` smallint(6) DEFAULT NULL,
  `nota_comp4` smallint(6) DEFAULT NULL,
  `nota_comp5` smallint(6) DEFAULT NULL,
  `status_red` enum('pendente','corrigida','revisao') DEFAULT 'pendente',
  `data_envio` datetime DEFAULT current_timestamp(),
  `data_correcao` datetime DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `caminho_arquivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `redacao`
--

INSERT INTO `redacao` (`id`, `aluno_id`, `corretor_id`, `tema`, `nota_total`, `nota_comp1`, `nota_comp2`, `nota_comp3`, `nota_comp4`, `nota_comp5`, `status_red`, `data_envio`, `data_correcao`, `observacoes`, `caminho_arquivo`) VALUES
(3, 'M15501238', '1234567', 'Desafios para combater os vícios em jogos de aposta online', 1000, 200, 200, 200, 200, 200, 'corrigida', '2025-08-02 16:35:33', '2025-08-02 18:15:47', NULL, 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao3.pdf'),
(5, 'M15501238', '1234567', 'Desafios para combater o câncer de próstata', 600, 120, 120, 120, 120, 120, 'corrigida', '2025-08-02 18:57:35', '2025-08-03 18:55:56', NULL, 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao5.pdf'),
(7, '2025001', 'C1001', 'Os desafios da educação no Brasil', 840, 160, 180, 170, 165, 165, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Bom desenvolvimento de ideias.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao7.pdf'),
(8, '2025002', 'C1001', 'A importância da empatia nas relações sociais', 900, 180, 180, 180, 180, 180, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Muito boa coesão e argumentação.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao8.pdf'),
(9, '2025003', 'C1002', 'O papel da tecnologia na sociedade moderna', 860, 170, 170, 175, 170, 175, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Bom uso de dados e argumentação sólida.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao9.pdf'),
(10, '2025004', 'C1001', 'Caminhos para combater a desigualdade social', 875, 175, 175, 175, 175, 175, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Texto bem estruturado, com ótimos exemplos.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao10.pdf'),
(11, '2025005', 'C1003', 'A influência das redes sociais na vida cotidiana', 920, 200, 160, 200, 160, 200, 'corrigida', '2025-08-03 21:46:56', NULL, 'Faltou Pouco!', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao11.pdf'),
(12, '2025006', '1234567', 'O desafio da mobilidade urbana', 920, 200, 160, 200, 160, 200, 'corrigida', '2025-08-03 21:46:56', '2025-08-20 19:46:26', 'Faltou Pouco!', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao12.pdf'),
(13, '2025007', 'C1004', 'A importância da preservação ambiental', 870, 175, 170, 175, 170, 180, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Boa organização textual.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao13.pdf'),
(14, '2025008', 'C1005', 'Desafios da mobilidade urbana nas capitais', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-08-03 21:46:56', NULL, NULL, 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao14.pdf'),
(15, '2025009', 'C1004', 'A crise hídrica e suas consequências', 890, 180, 180, 175, 180, 175, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Excelente domínio do tema.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao15.pdf'),
(16, '2025010', 'C1002', 'Fake news e o impacto na democracia', 845, 165, 170, 170, 170, 170, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Revisar coesão em alguns trechos.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao16.pdf'),
(17, '2025011', 'C1003', 'A juventude e o mercado de trabalho', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-08-03 21:46:56', NULL, NULL, 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao17.pdf'),
(18, '2025012', 'C1001', 'Racismo estrutural na sociedade brasileira', 900, 180, 180, 180, 180, 180, 'corrigida', '2025-08-03 21:46:56', '2025-08-03 21:46:56', 'Excelente em todos os critérios.', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao18.pdf'),
(19, 'M15501238', '1234567', 'Desafios para o desenvolvimento do esporte profissional além do futebol no Brasil', 720, 160, 120, 160, 120, 160, 'corrigida', '2025-08-23 09:43:58', '2025-10-31 21:42:18', 'Precisa melhorar urgente', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao19.pdf'),
(49, '836893729', NULL, 'A importância da sociedadade civil na preservação do meio-ambiente', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-11-07 21:53:12', NULL, NULL, 'assets/uploads/arquivos_redacoes/2025/3_ano/red3_Pag0_836893729.pdf'),
(50, 'M15501238', '1234567', 'As manifestações civis como ferramenta de pressão sobre o Estado e de garantia da democracia', 880, 200, 160, 160, 200, 160, 'corrigida', '2025-11-10 16:32:18', '2025-11-10 18:38:56', '', 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao_otto.pdf'),
(60, '91103414', NULL, 'As manifestações civis como ferramenta de pressão sobre o Estado e de garantia da democracia', NULL, NULL, NULL, NULL, NULL, NULL, 'pendente', '2025-11-10 16:26:24', NULL, NULL, 'assets/uploads/arquivos_redacoes/2025/3_ano/redacao_giovanni.pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `suporte`
--

CREATE TABLE `suporte` (
  `id` int(11) NOT NULL,
  `tipo_usuario` enum('aluno','professor','outro') NOT NULL,
  `nome` varchar(100) NOT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `motivo` enum('problema técnico','nota','conta','sugestão','outro') NOT NULL,
  `tema` varchar(200) DEFAULT NULL,
  `mensagem` text NOT NULL,
  `prioridade` enum('baixa','média','alta') DEFAULT 'baixa',
  `caminho_anexo` varchar(255) DEFAULT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pendente','em andamento','respondido') NOT NULL DEFAULT 'pendente',
  `resposta` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `suporte`
--

INSERT INTO `suporte` (`id`, `tipo_usuario`, `nome`, `matricula`, `email`, `motivo`, `tema`, `mensagem`, `prioridade`, `caminho_anexo`, `data_envio`, `status`, `resposta`) VALUES
(1, 'aluno', 'Otto Emanuel Barbosa Mafra', 'M15501238', 'ottomafr@gmail.com', 'problema técnico', 'Falha no acesso às minhas redações', 'Não consigo visualizar uma redacao', 'alta', NULL, '2025-09-09 11:59:28', 'pendente', NULL),
(10, 'aluno', 'Otto Emanuel Barbosa Mafra', 'M15501238', 'ottomafr@gmail.com', 'problema técnico', 'Socorro', 'SOCORRO', 'alta', 'C:\\xampp\\htdocs\\SIGAV-CPII\\php\\global\\suporte/../../../assets/uploads/anexos_suporte/alunos/anexo68c01c655de3b.jpeg', '2025-09-09 12:24:05', 'pendente', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

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
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `redacao`
--
ALTER TABLE `redacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `corretor_id` (`corretor_id`);

--
-- Índices de tabela `suporte`
--
ALTER TABLE `suporte`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `redacao`
--
ALTER TABLE `redacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `suporte`
--
ALTER TABLE `suporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `redacao`
--
ALTER TABLE `redacao`
  ADD CONSTRAINT `redacao_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id_matricula`),
  ADD CONSTRAINT `redacao_ibfk_2` FOREIGN KEY (`corretor_id`) REFERENCES `corretores` (`id_matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
