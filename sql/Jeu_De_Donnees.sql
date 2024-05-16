-- Insertion de données dans la table Utilisateur
INSERT INTO Utilisateur (IDUtilisateur, NomU, PrénomU, EmailU, MotDePasseU, Adresse, Code_Postal, Ville, DateInscriptionU, NoteU, CreditU, RoleU) VALUES
('U1', 'Dupont', 'Jean', 'jean.dupont@example.com', 'password123', '123 Rue de Paris', 75001, 'Paris', '2023-01-15 10:30:00', 5, 100, true);
('U2', 'Martin', 'Lucie', 'lucie.martin@example.com', 'securepassword', '456 Avenue de Lyon', 69001, 'Lyon', '2023-02-20 11:00:00', 4, 150, false);
('U3', 'Bernard', 'Alice', 'alice.bernard@example.com', 'mypassword', '789 Boulevard de Lille', 59000, 'Lille', '2023-03-10 14:20:00', 3, 200, true);

-- Insertion de données dans la table Competence
INSERT INTO Competence (IDCompetence, NomCompetence, Niveau_Debutant_Intermédiaire_Expert_, _CatégorieCompetence_) VALUES
('C1', 'Jardinage', 'Intermédiaire', 'Travaux');
('C2', 'Nettoyage', 'Débutant', 'Entretien');
('C3', 'Programmation', 'Expert', 'Services informatiques');

-- Insertion de données dans la table Service
INSERT INTO Service (IDService, NomService, Description_optionnel_, Categorie, CategorieSecondaire, DateService, DependenceMeteo, CreditRequis, CompétenceRequise) VALUES
('S1', 'Tondre la pelouse', 'Tondre la pelouse du jardin', 'Travaux', NULL, '2023-05-15 09:00:00', true, 50, 'Jardinage');
('S2', 'Nettoyer la maison', 'Nettoyage complet de la maison', 'Entretien', NULL, '2023-05-20 10:00:00', false, 30, 'Nettoyage');
('S3', 'Peinture', 'Réalisation de peintures intérieures de tout type', 'Tavaux', NULL, '2023-06-01 09:00:00', false, 100, 'Bricolage');

-- Insertion de données dans la table Avis
INSERT INTO Avis (IDAvis, Note, Commentaire, DateAvis, IDUtilisateur, IDService) VALUES
('A1', 5, 'Excellent service !', '2023-05-16 12:00:00', 'U2', 'S1');
('A2', 4, 'Très bon travail', '2023-05-21 15:00:00', 'U1', 'S2');

-- Insertion de données dans la table Offrir
INSERT INTO Offrir (IDService, IDUtilisateur, DateService) VALUES
('S1', 'U1', '2023-05-15 09:00:00');
('S2', 'U2', '2023-05-20 10:00:00');

-- Insertion de données dans la table Planifier
INSERT INTO Planifier (IDService, IDUtilisateur, DateService) VALUES
('S3', 'U3', '2023-06-01 09:00:00');

-- Insertion de données dans la table Posséder
INSERT INTO Posséder (IDUtilisateur, IDCompetence) VALUES
('U1', 'C1');
('U2', 'C2');
('U3', 'C3');

-- Insertion de données dans la table Nécéssiter
INSERT INTO Nécéssiter (IDService, IDCompetence) VALUES
('S1', 'C1');
('S2', 'C2');
('S3', 'C3');

-- Insertion de données dans la table Demander
INSERT INTO Demander (IDService, IDUtilisateur, DateService) VALUES
('S1', 'U2', '2023-05-15 09:00:00'),
('S2', 'U1', '2023-05-20 10:00:00'),
('S3', 'U3', '2023-06-01 09:00:00');