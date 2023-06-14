-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Jun-2023 às 00:00
-- Versão do servidor: 8.0.32
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `projeto.receita`
--
CREATE DATABASE IF NOT EXISTS `projeto.receita` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `projeto.receita`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `nome` varchar(50) NOT NULL,
  `id_receita` int DEFAULT NULL,
  `codigo` int NOT NULL,
  `id_ingrediente` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_ingrediente`),
  KEY `fk_ingredientes_receita` (`id_receita`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `ingredientes`
--

INSERT INTO `ingredientes` (`nome`, `id_receita`, `codigo`, `id_ingrediente`) VALUES
('Carne', NULL, 123141, 46),
('Ervilha', NULL, 1415, 47),
('Tomate', NULL, 315, 48),
('Cúrcuma', NULL, 5123, 49),
('Laranja', NULL, 5321, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

DROP TABLE IF EXISTS `receita`;
CREATE TABLE IF NOT EXISTS `receita` (
  `nome` varchar(50) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`nome`, `id`, `codigo`) VALUES
('Teste HW', 50, 123412),
('dasdsad', 57, 123),
('Teste Receita', 58, 1231234),
('Teste3', 59, 15),
('Teste33', 60, 3),
('Bife Mignon', 62, 1536);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita_ingredientes`
--

DROP TABLE IF EXISTS `receita_ingredientes`;
CREATE TABLE IF NOT EXISTS `receita_ingredientes` (
  `receita_id` int NOT NULL,
  `ingrediente_id` int NOT NULL,
  `ordem` int NOT NULL,
  `previsto_kg` decimal(10,2) NOT NULL,
  PRIMARY KEY (`receita_id`,`ingrediente_id`),
  KEY `ingrediente_id` (`ingrediente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `receita_ingredientes`
--

INSERT INTO `receita_ingredientes` (`receita_id`, `ingrediente_id`, `ordem`, `previsto_kg`) VALUES
(60, 47, 1, '111.00'),
(60, 48, 2, '321.00'),
(60, 50, 3, '144.00'),
(62, 46, 3, '222.00'),
(62, 47, 2, '600.00'),
(62, 49, 1, '111.00'),
(62, 50, 4, '551.00');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD CONSTRAINT `fk_ingredientes_receita` FOREIGN KEY (`id_receita`) REFERENCES `receita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `receita_ingredientes`
--
ALTER TABLE `receita_ingredientes`
  ADD CONSTRAINT `receita_ingredientes_ibfk_1` FOREIGN KEY (`receita_id`) REFERENCES `receita` (`id`),
  ADD CONSTRAINT `receita_ingredientes_ibfk_2` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id_ingrediente`);
COMMIT;