DROP DATABASE IF EXISTS `controle_atividade`;
CREATE SCHEMA IF NOT EXISTS `controle_atividade` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `controle_atividade` ;
-- -----------------------------------------------------
-- Table `controle_atividade`.`atividade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `controle_atividade`.`atividade` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(45) NOT NULL ,
  `descricao` TEXT NOT NULL,
  `indice` INT(11) NOT NULL,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;

insert into atividade ( `titulo`, `descricao`, `indice` ) values
('Tomar café', 'Todos os dias às 8:00Hs', 1),
('Corrida', 'Todos os dias na avenida 15 de novembro às 18:00Hs após o servico', 3),
('Almoço', 'Almoçar com os amigos todos dias às 12:00Hs', 2);
