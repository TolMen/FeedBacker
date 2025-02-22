-- Configuration BDD
SET NAMES utf8mb4;
CREATE DATABASE IF NOT EXISTS feedbacker;
USE feedbacker;

-- ---------------------------------------------

-- Désactive temporairement les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 0;

-- Suppression des tables dans le bon ordre
-- DROP TABLE IF EXISTS ?;

-- Réactive les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------

-- Création des tables :
-- Table `?`
-- CREATE TABLE IF NOT EXISTS ? (
--     id INT AUTO_INCREMENT PRIMARY KEY,
-- ) ENGINE=InnoDB;



-- ---------------------------------------------

-- Jeux de données

-- Insertion du contenu ...

-- INSERT INTO ? (?, ?, ?, ...)
-- VALUES()