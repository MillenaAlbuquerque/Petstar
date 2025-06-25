-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Jun-2024 às 19:32
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `petstar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `animais`
--

CREATE TABLE `animais` (
  `idanimal` int(11) NOT NULL,
  `nomeanimal` varchar(50) NOT NULL,
  `idadeanimal` varchar(50) NOT NULL,
  `detalheanimal` varchar(50) NOT NULL,
  `porteanimal` varchar(50) NOT NULL,
  `onganimal` varchar(50) NOT NULL,
  `imagemanimal` varchar(255) NOT NULL,
  `racaanimal` varchar(50) NOT NULL,
  `generoanimal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `animais`
--

INSERT INTO `animais` (`idanimal`, `nomeanimal`, `idadeanimal`, `detalheanimal`, `porteanimal`, `onganimal`, `imagemanimal`, `racaanimal`, `generoanimal`) VALUES
(4, 'branquinho zinho', '2', 'lindo de mamai', 'grande', 'millenamamae', 'images/branquinho.png', '', '0'),
(5, 'lobex', '5', 'bluvle', 'medio', 'bluble', 'images/lobinho.png', '', '0'),
(8, 'fasfes', 'gfdh', 'egsg', 'Pequeno', 'grg', 'images/barbie.png', '', ''),
(9, 'Maria Antonia', '1', 'Carinhosa', 'Pequeno', 'MiauDote', 'images/mariaantonia.png', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `datanasc` varchar(50) NOT NULL,
  `fone` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `datanasc`, `fone`, `cidade`, `endereco`, `senha`) VALUES
(9, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-04', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', '1234'),
(11, 'Millena Albuquerque de Almeida', 'katiadm_22@hotmail.co', '2024-06-09', '11948703187', 'Guarulhos', 'Avenida Paulistana', '1234'),
(18, 'Millena Albuquerque de Almeida', 'millenalb2015@gmail.com', '2024-05-30', '11948703187', 'Guarulhos', 'Avenida Paulistana', '444'),
(19, 'Millena Albuquerque de Almeida', 'millenalb2015@gmail.com', '2024-05-30', '11948703187', 'Guarulhos', 'Avenida Paulistana', '444'),
(20, 'Millena Albuquerque de Almeida', 'millenalb2015@gmail.com', '2024-06-12', '11948703187', 'Guarulhos', 'Avenida Paulistana', '123'),
(21, 'Millena Albuquerque de Almeida', 'millenalb2015@gmail.com', '2024-06-12', '11948703187', 'Guarulhos', 'Avenida Paulistana', '123'),
(22, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-12', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', '123'),
(23, 'Millena Albuquerque', 'katiadm_22@hotmail.com', '2024-05-28', '11948703187', 'Guarulhos', 'Avenida Paulistana, 61', '1235'),
(24, 'Millena Albuquerque', 'katiadm_22@hotmail.com', '2024-06-11', '11948703187', 'Guarulhos', 'Avenida Paulistana, 61', 'fht'),
(25, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-05', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', 'adxX'),
(26, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-05', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', 'adxX'),
(27, 'Millena Albuquerque', 'katiadm_22@hotmail.com', '2024-06-12', '11948703187', 'Guarulhos', 'Avenida Paulistana, 61', 'ewfew'),
(28, 'Millena Albuquerque de Almeida', 'millenalb2015@gmail.com', '2024-06-26', '5725757', 'Guarulhos', 'Avenida Paulistana', 'casdcac'),
(29, 'Millena Albuquerque de Almeida', 'millenalb2015@gmail.com', '2024-06-26', '5725757', 'Guarulhos', 'Avenida Paulistana', 'casdcac'),
(30, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-06', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', 'sqda'),
(31, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-06', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', 'sqda'),
(32, 'medley', 'teste@teste', '2024-05-29', '2453637537', 'jggighj', 'ghjgjgug', '1234'),
(33, 'medley', 'teste@teste', '2024-05-29', '2453637537', 'jggighj', 'ghjgjgug', '1234'),
(34, 'buceta criminosa', 'ergwgvw@hdashf', '2024-06-18', '7825827', 'fewfewf', 'fdfwefwe', 'ak'),
(35, 'buceta criminosa', 'ergwgvw@hdashf', '2024-06-18', '7825827', 'fewfewf', 'fdfwefwe', 'ak'),
(36, 'rafael', 'rafa@rafa', '2024-06-18', '11948703187', 'GUARULHOS', 'lindo', 'toarriada'),
(37, 'rafael', 'rafa@rafa', '2024-06-18', '11948703187', 'GUARULHOS', 'lindo', 'toarriada'),
(38, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-07', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', '1'),
(39, 'SONIA MARIA DE ALBUQUERQUE TRINDADE LIMA', 'katiadm_22@hotmail.com', '2024-06-07', '11948703187', 'GUARULHOS', 'AV: PAULISTANA, 61', '1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `animais`
--
ALTER TABLE `animais`
  ADD PRIMARY KEY (`idanimal`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animais`
--
ALTER TABLE `animais`
  MODIFY `idanimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
