CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
