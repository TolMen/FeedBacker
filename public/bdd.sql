-- Configuration BDD
SET NAMES utf8mb4;
CREATE DATABASE IF NOT EXISTS feedbacker;
USE feedbacker;

-- Désactive temporairement les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 0;

-- Suppression des tables existantes dans le bon ordre
DROP TABLE IF EXISTS exercise;
DROP TABLE IF EXISTS control;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS class;

-- Réactive les contraintes de clé étrangère
SET FOREIGN_KEY_CHECKS = 1;

-- Création des tables :

-- Table `class`
CREATE TABLE IF NOT EXISTS class (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(255) NOT NULL,
    nb_student INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

-- Table `user`
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    pseudo VARCHAR(255) NOT NULL,
    role ENUM('prof', 'eleve') NOT NULL,
    class_id INT DEFAULT NULL,
    FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE
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
    FOREIGN KEY (eleve_id) REFERENCES user(id) ON DELETE CASCADE
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

-- Insertion des classes
INSERT INTO class (class_name, nb_student) VALUES
('Classe Alpha', 4),
('Classe Beta', 5),
('Classe Gamma', 3);

-- Insertion du professeur
INSERT INTO user (name, first_name, password, pseudo, role) VALUES
('Dupont', 'Martin', SHA2('password1', 256), 'mdupont', 'prof');

-- Insertion des élèves avec liaison à une seule classe
INSERT INTO user (name, first_name, password, pseudo, role, class_id) VALUES
('Durand', 'Sophie', SHA2('password2', 256), 'sdurand', 'eleve', 1),
('Lemoine', 'Lucie', SHA2('password3', 256), 'llemoine', 'eleve', 1),
('Martin', 'Pierre', SHA2('password4', 256), 'pmartin', 'eleve', 1),
('Bernard', 'Julie', SHA2('password5', 256), 'jbernard', 'eleve', 1),

('Rousseau', 'Alex', SHA2('password6', 256), 'arousseau', 'eleve', 2),
('Leclerc', 'Nina', SHA2('password7', 256), 'nleclerc', 'eleve', 2),
('Moreau', 'Yanis', SHA2('password8', 256), 'ymoreau', 'eleve', 2),
('Garcia', 'Emma', SHA2('password9', 256), 'egarcia', 'eleve', 2),
('Noel', 'Lucas', SHA2('password10', 256), 'lnoel', 'eleve', 2),

('Simon', 'Chloé', SHA2('password11', 256), 'csimon', 'eleve', 3),
('Dubois', 'Maxime', SHA2('password12', 256), 'mdubois', 'eleve', 3),
('Leroy', 'Elisa', SHA2('password13', 256), 'eleroy', 'eleve', 3);

-- Insertion des contrôles pour chaque élève
INSERT INTO control (title, total_score, general_appreciation, prof_id, eleve_id, created_at) VALUES
("Mathématiques - Contrôle 1", 20.00, "Bon travail", 1, 2, "2025-02-25"),
("Mathématiques - Contrôle 1", 20.00, "Quelques erreurs", 1, 3, "2025-02-25"),
("Mathématiques - Contrôle 1", 20.00, "Très bon niveau", 1, 4, "2025-02-25"),
("Mathématiques - Contrôle 2", 20.00, "Doit améliorer la logique", 1, 5, "2025-02-26"),
("Mathématiques - Contrôle 2", 20.00, "Excellent travail", 1, 6, "2025-02-26");

-- Insertion des exercices pour les contrôles
INSERT INTO exercise (control_id, titled, score, feedback) VALUES
(1, "Exercice 1 : Calcul mental", 6.00, "Quelques erreurs de calcul"),
(1, "Exercice 2 : Résolution d'équations", 7.00, "Bonne méthode"),
(1, "Exercice 3 : Analyse de graphique", 7.00, "Très bien détaillé"),

(2, "Exercice 1 : Problème de logique", 8.00, "Bon raisonnement"),
(2, "Exercice 2 : Probabilités", 6.00, "Manque d'approfondissement"),

(3, "Exercice 1 : Analyse de texte", 9.00, "Bonne compréhension"),
(3, "Exercice 2 : Interprétation graphique", 8.00, "Bien argumenté"),

(4, "Exercice 1 : Géométrie", 7.50, "Construction correcte"),
(4, "Exercice 2 : Calcul intégral", 7.50, "Quelques erreurs"),

(5, "Exercice 1 : Analyse fonctionnelle", 10.00, "Parfait"),
(5, "Exercice 2 : Algèbre", 10.00, "Rien à redire");
