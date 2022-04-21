-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Abr-2022 às 00:50
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_apptarefas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_status`
--

INSERT INTO `tb_status` (`id`, `status`) VALUES
(1, 'pendente'),
(2, 'realizado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tarefas`
--

CREATE TABLE `tb_tarefas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `tarefa` text COLLATE utf8_unicode_ci NOT NULL,
  `data_cadastrado` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_tarefas`
--

INSERT INTO `tb_tarefas` (`id`, `id_usuario`, `id_status`, `tarefa`, `data_cadastrado`) VALUES
(5, 1, 1, 'Lavar a louça', '2022-04-11 17:26:30'),
(6, 1, 1, 'Correr', '2022-04-11 17:34:31'),
(7, 1, 1, 'Cortar o Cabelo', '2022-04-11 17:45:18'),
(8, 2, 1, 'Viajar para praia', '2022-04-11 17:54:22'),
(9, 2, 2, 'Lavar a roupa', '2022-04-11 17:54:22'),
(10, 1, 1, 'Jogar Bola a noite', '2022-04-11 18:00:18'),
(11, 2, 1, 'Malhar Cedo', '2022-04-11 18:02:13'),
(13, 2, 1, 'Jogar Bola', '2022-04-11 19:39:50'),
(14, 8, 1, 'Cortar o Cabelo', '2022-04-11 19:40:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `login`, `senha`) VALUES
(1, 'Claudio', 'claudio@teste.com.br', '123456'),
(2, 'Beatriz', 'beatriz@teste.com.br', '123456'),
(3, 'Vera', 'vera@teste.com.br', '123456'),
(4, 'Pedro', 'pedro@teste.com.br', '123456'),
(5, 'Thiago', 'thiago@teste.com.br', '123456'),
(6, 'Nathalia', 'nathalia@teste.com.br', '123456'),
(8, 'Rogerio Anjos', 'rogerio@teste.com.br', '123456');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tb_tarefas`
--
ALTER TABLE `tb_tarefas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_status` (`id_status`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_tarefas`
--
ALTER TABLE `tb_tarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_tarefas`
--
ALTER TABLE `tb_tarefas`
  ADD CONSTRAINT `tb_tarefas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id`),
  ADD CONSTRAINT `tb_tarefas_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
