-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Jul-2018 às 20:59
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrx`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `baned_mac`
--

CREATE TABLE `baned_mac` (
  `id` int(11) NOT NULL,
  `end_mac` varchar(40) NOT NULL,
  `hora_block` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `baned_mac`
--

INSERT INTO `baned_mac` (`id`, `end_mac`, `hora_block`) VALUES
(1, '0', '00:00:00'),
(2, '1', '00:00:00'),
(3, '0', '00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emierixix`
--

CREATE TABLE `emierixix` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(55) NOT NULL,
  `chave` varchar(40) NOT NULL,
  `end_ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `emierixix`
--

INSERT INTO `emierixix` (`id`, `nome`, `usuario`, `senha`, `chave`, `end_ip`) VALUES
(222, 'Emierixix', 'Emierixix', '9f08e0e14eb93c9cd05fdcae991d5f35', '9aad592bb0c4543e04b7', ' 24-0A-64-5E-B4-34\r\n');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `baned_mac`
--
ALTER TABLE `baned_mac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emierixix`
--
ALTER TABLE `emierixix`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baned_mac`
--
ALTER TABLE `baned_mac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `emierixix`
--
ALTER TABLE `emierixix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
