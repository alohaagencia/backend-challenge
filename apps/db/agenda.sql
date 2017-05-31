-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 31/05/2017 às 20:55
-- Versão do servidor: 5.7.18-0ubuntu0.16.04.1
-- Versão do PHP: 5.6.30-11+deb.sury.org~xenial+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agenda`
--
CREATE DATABASE IF NOT EXISTS `agenda` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `agenda`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Fazendo dump de dados para tabela `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 7, 'Joaquim', '2017-05-31 15:35:25', '2017-05-31 15:35:25'),
(4, 7, 'Vinicius Brites Sotti', '2017-05-31 17:06:25', '2017-05-31 17:06:25'),
(5, 8, 'Teste', '2017-05-31 17:07:48', '2017-05-31 17:16:31'),
(6, 8, 'Teste2', '2017-05-31 17:07:57', '2017-05-31 17:16:22');

-- --------------------------------------------------------

--
-- Estrutura para tabela `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Fazendo dump de dados para tabela `phones`
--

INSERT INTO `phones` (`id`, `contact_id`, `number`, `created_at`, `updated_at`) VALUES
(22, 4, '(44) 99905-2756', '2017-05-31 17:06:25', '2017-05-31 17:06:25'),
(23, 4, '(44) 99949-1009', '2017-05-31 17:06:25', '2017-05-31 17:06:25'),
(34, 6, '4433251819', '2017-05-31 17:16:22', '2017-05-31 17:16:22'),
(35, 6, '44999052756', '2017-05-31 17:16:22', '2017-05-31 17:16:22'),
(36, 5, '44999491009', '2017-05-31 17:16:31', '2017-05-31 17:16:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('active','waiting') NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Vinicius Brites Sotti', 'vinicius@sotti.com.br', '4f639bc811cffc4c5c30f2a1566e69ee', 'active', '2017-05-31 14:36:42', '2017-05-31 17:29:53'),
(8, 'Teste', 'teste@sotti.com.br', '2de1d010e8e55fe0ed0b831a14c1cd46', 'active', '2017-05-31 17:07:07', '2017-05-31 17:07:34');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `phones`
--
ALTER TABLE `phones`
  ADD CONSTRAINT `phones_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
