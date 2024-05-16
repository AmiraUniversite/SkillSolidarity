-- Insertion de données dans la table Utilisateur
INSERT INTO Utilisateur (IDUtilisateur, NomU, PrénomU, EmailU, MotDePasseU, Adresse, Code_Postal, Ville, DateInscriptionU, NoteU, CreditU, RoleU) VALUES
('1', 'Dupont', 'Jean', 'jean.dupont@example.com', 'password123', '123 Rue de Paris', 75001, 'Paris', '2023-01-15 10:30:00', 5, 100, true);
('2', 'Martin', 'Lucie', 'lucie.martin@example.com', 'securepassword', '456 Avenue de Lyon', 69001, 'Lyon', '2023-02-20 11:00:00', 4, 150, false);
('3', 'Bernard', 'Alice', 'alice.bernard@example.com', 'mypassword', '789 Boulevard de Lille', 59000, 'Lille', '2023-03-10 14:20:00', 3, 200, true);

-- Insertion de données dans la table Competence
INSERT INTO Competence (IDCompetence, NomCompetence, Niveau_Debutant_Intermédiaire_Expert_, _CatégorieCompetence_) VALUES
('1', 'Jardinage', 'Intermédiaire', 'Travaux');
('2', 'Nettoyage', 'Débutant', 'Entretien');
('3', 'Programmation', 'Expert', 'Services informatiques');

-- Insertion de données dans la table Service
INSERT INTO Service (IDService, NomService, Description_optionnel_, Categorie, CategorieSecondaire, DateService, DependenceMeteo, CreditRequis, CompétenceRequise) VALUES
('1', 'Tondre la pelouse', 'Tondre la pelouse du jardin', 'Travaux', NULL, '2023-05-15 09:00:00', true, 50, 'Jardinage');
('2', 'Nettoyage maison', 'Nettoyage complet de la maison', 'Entretien', NULL, '2023-05-20 10:00:00', false, 30, 'Nettoyage');
('3', 'Peinture', 'Réalisation de peintures intérieures de tout type', 'Tavaux', NULL, '2023-06-01 09:00:00', false, 100, 'Bricolage');

-- Insertion de données dans la table Avis
INSERT INTO Avis (IDAvis, Note, Commentaire, DateAvis, IDUtilisateur, IDService) VALUES
('1', 5, 'Excellent service !', '2023-05-16 12:00:00', '2', '1');
('2', 4, 'Très bon travail', '2023-05-21 15:00:00', '1', '2');

-- Insertion de données dans la table Offrir
INSERT INTO Offrir (IDService, IDUtilisateur, DateService) VALUES
('1', '1', '2023-05-15 09:00:00');
('2', '2', '2023-05-20 10:00:00');

-- Insertion de données dans la table Planifier
INSERT INTO Planifier (IDService, IDUtilisateur, DateService) VALUES
('3', '3', '2023-06-01 09:00:00');

-- Insertion de données dans la table Posséder
INSERT INTO Posséder (IDUtilisateur, IDCompetence) VALUES
('1', '1');
('2', '2');
('3', '3');

-- Insertion de données dans la table Nécéssiter
INSERT INTO Nécéssiter (IDService, IDCompetence) VALUES
('1', '1');
('2', '2');
('3', '3');

-- Insertion de données dans la table Demander
INSERT INTO Demander (IDService, IDUtilisateur, DateService) VALUES
('1', '2', '2023-05-15 09:00:00'),
('2', '1', '2023-05-20 10:00:00'),
('3', '3', '2023-06-01 09:00:00');