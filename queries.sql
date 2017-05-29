CREATE DATABASE `agenda`;

CREATE TABLE `agenda`.`usuario` (
  `id` int(10) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `agenda`.`contato` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fone` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
