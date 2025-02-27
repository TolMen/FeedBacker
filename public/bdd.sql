-- Configuration BDD
SET NAMES utf8mb4;
CREATE DATABASE IF NOT EXISTS feedbacker;
USE feedbacker;

-- ---------------------------------------------

-- Désactive temporairement les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 0;

-- Suppression des tables dans le bon ordre
DROP TABLE IF EXISTS exercise;
DROP TABLE IF EXISTS control;
DROP TABLE IF EXISTS user;

-- Réactive les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------

-- Création des tables :

-- Table `user`
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    pseudo VARCHAR(255) NOT NULL,
    role ENUM('prof', 'eleve') NOT NULL
) ENGINE=InnoDB;

-- Table `controles`
CREATE TABLE IF NOT EXISTS control (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    total_score DECIMAL(4,2) NOT NULL,
    general_appreciation TEXT,
    prof_id INT,
    eleve_id INT,
    created_at DATE NOT NULL,
    FOREIGN KEY (prof_id) REFERENCES user(id),
    FOREIGN KEY (eleve_id) REFERENCES user(id)
) ENGINE=InnoDB;

-- Table `exercices`
CREATE TABLE IF NOT EXISTS exercise (
    id INT AUTO_INCREMENT PRIMARY KEY,
    control_id INT,
    titled VARCHAR(255) NOT NULL,
    score DECIMAL(4,2),
    feedback TEXT,
    FOREIGN KEY (control_id) REFERENCES control(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------

-- Jeux de données

-- Insertion des utilisateurs (professeur et élèves)
INSERT INTO user (name, first_name, password, pseudo, role) VALUES
('Dupont', 'Martin', SHA2('password1', 256), 'mdupont', 'prof'), 
('Durand', 'Sophie', SHA2('password2', 256), 'sdurand', 'eleve'), 
('Lemoine', 'Lucie', SHA2('password3', 256), 'llemoine', 'eleve'), 
('Martin', 'Pierre', SHA2('password4', 256), 'pmartin', 'eleve');

-- Insertion des contrôles
INSERT INTO control (title, total_score, general_appreciation, prof_id, eleve_id, created_at) VALUES
("Devoir de Mathématiques - Contrôle 1", 20.00, "Bien travaillé, mais attention aux calculs", 1, 2, "2025-02-25"),
("Devoir de Mathématiques - Contrôle 1", 20.00, "Quelques erreurs dans les exercices pratiques", 1, 3, "2025-02-25"),
("Devoir de Mathématiques - Contrôle 1", 20.00, "Très bon travail, continue comme ça", 1, 4, "2025-02-25"),
("Devoir de Mathématiques - Contrôle 2", 20.00, "Nécessite plus d'attention sur les applications", 1, 2, "2025-02-26"),
("Devoir de Mathématiques - Contrôle 2", 20.00, "Bon travail global, mais quelques erreurs à corriger", 1, 3, "2025-02-26");

-- Insertion des exercices pour le premier contrôle (3 exercices)
INSERT INTO exercise (control_id, titled, score, feedback) VALUES
(1, "Exercice 1 : Calcul mental", 6.00, "Bonne approche, mais quelques erreurs de calcul"),
(1, "Exercice 2 : Résolution d'équations", 7.00, "Excellente méthode, mais la réponse finale est incorrecte"),
(1, "Exercice 3 : Analyse de graphique", 7.00, "Très bien, mais un peu plus de détails sur l'interprétation auraient été utiles");

-- Insertion des exercices pour le deuxième contrôle (2 exercices)
INSERT INTO exercise (control_id, titled, score, feedback) VALUES
(2, "Exercice 1 : Résolution de problème", 10.00, "Très bonne gestion des calculs"),
(2, "Exercice 2 : Analyse de données", 10.00, "Manque d'approfondissement sur la partie graphique");
