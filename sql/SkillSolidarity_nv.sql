-- Table Utilisateur
CREATE TABLE IF NOT EXISTS "Utilisateur" (
    IDUtilisateur VARCHAR(50) PRIMARY KEY,
    NomU VARCHAR(50) NOT NULL CHECK (NomU ~ '^[A-Za-z]+$'),
    PrénomU VARCHAR(50) NOT NULL CHECK (PrénomU ~ '^[A-Za-z]+$'),
    EmailU VARCHAR(50) NOT NULL UNIQUE CHECK (EmailU SIMILAR TO '[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}'),
    MotDePasseU VARCHAR(50) NOT NULL CHECK (MotDePasseU ~ '[a-zA-Z0-9]+'),
    Adresse VARCHAR(100) NOT NULL,
    Code_Postal VARCHAR(10) NOT NULL,
    Ville VARCHAR(50) NOT NULL,
    DateInscriptionU DATE NOT NULL,
    NoteU INT NOT NULL CHECK (NoteU BETWEEN 0 AND 5),
    CreditU INT NOT NULL,
    RoleU VARCHAR(50) NOT NULL
);

-- Table Service
CREATE TABLE IF NOT EXISTS "Service" (
    IDService VARCHAR(50) PRIMARY KEY,
    NomService VARCHAR(50) NOT NULL,
    Description_optionnel_ VARCHAR(150),
    Categorie VARCHAR(50) NOT NULL CHECK (upper(Categorie)='TRAVAUX' OR upper(Categorie)='ENTRETIEN' OR upper(Categorie)='ANIMAUX' OR upper(Categorie)='BRICOLAGE' OR upper(Categorie)='AUTOMOBILE' OR upper(Categorie)='SERVICES INFORMATIQUES' OR upper(Categorie)='COURS PARTICULIERS/ÉDUCATION' OR upper(Categorie)='AIDE À DOMICILE' OR upper(Categorie)='ASSISTANCE ADMINISTRATIVE' OR upper(Categorie)='COACHING/CONSEILS'),
    CategorieSecondaire VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    DependenceMeteo BOOLEAN NOT NULL,
    CreditRequis INT NOT NULL,
    CompétenceRequise VARCHAR(50) NOT NULL
);

-- Update NomService constraint
ALTER TABLE "Service" DROP CONSTRAINT IF EXISTS "Service_nomservice_check";
ALTER TABLE "Service" ADD CONSTRAINT "Service_nomservice_check" CHECK (NomService ~ '^[A-Za-z ]+$');

-- Table Avis
CREATE TABLE IF NOT EXISTS "Avis" (
    IDAvis VARCHAR(50) PRIMARY KEY,
    Note INT NOT NULL,
    Commentaire VARCHAR(50),
    DateAvis TIMESTAMP NOT NULL,
    IDUtilisateur VARCHAR(50),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur),
    IDService VARCHAR(50),
    FOREIGN KEY (IDService) REFERENCES "Service" (IDService)
);

-- Table Competence
CREATE TABLE IF NOT EXISTS "Competence" (
    IDCompetence VARCHAR(50) PRIMARY KEY,
    NomCompetence VARCHAR(50) NOT NULL,
    Niveau_Debutant_Intermédiaire_Expert_ VARCHAR(50),
    _CatégorieCompetence_ VARCHAR(50)
);

-- Table Offrir
CREATE TABLE IF NOT EXISTS "Offrir" (
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur, DateService),
    FOREIGN KEY (IDService) REFERENCES "Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur)
);

-- Table Planifier
CREATE TABLE IF NOT EXISTS "Planifier" (
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur),
    FOREIGN KEY (IDService) REFERENCES "Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur)
);

-- Table Posséder
CREATE TABLE IF NOT EXISTS "Posséder" (
    IDUtilisateur VARCHAR(50),
    IDCompetence VARCHAR(50),
    PRIMARY KEY (IDUtilisateur, IDCompetence),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur),
    FOREIGN KEY (IDCompetence) REFERENCES "Competence" (IDCompetence)
);

-- Table Recevoir
CREATE TABLE IF NOT EXISTS "Recevoir" (
    IDUtilisateur VARCHAR(50),
    IDAvis VARCHAR(50),
    PRIMARY KEY (IDUtilisateur, IDAvis),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur),
    FOREIGN KEY (IDAvis) REFERENCES "Avis" (IDAvis)
);

-- Table Nécéssiter
CREATE TABLE IF NOT EXISTS "Nécéssiter" (
    IDService VARCHAR(50),
    IDCompetence VARCHAR(50),
    PRIMARY KEY (IDService, IDCompetence),
    FOREIGN KEY (IDService) REFERENCES "Service" (IDService),
    FOREIGN KEY (IDCompetence) REFERENCES "Competence" (IDCompetence)
);

-- Table Demander
CREATE TABLE IF NOT EXISTS "Demander" (
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur),
    FOREIGN KEY (IDService) REFERENCES "Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur)
);

-- Insertion de données dans la table Utilisateur
INSERT INTO "Utilisateur" (IDUtilisateur, NomU, PrénomU, EmailU, MotDePasseU, Adresse, Code_Postal, Ville, DateInscriptionU, NoteU, CreditU, RoleU) VALUES
('U1', 'Dupont', 'Jean', 'jean.dupont@example.com', 'password123', '123 Rue de Paris', '75001', 'Paris', '2023-01-15', 5, 100, 'user'),
('U2', 'Martin', 'Lucie', 'lucie.martin@example.com', 'securepassword', '456 Avenue de Lyon', '69001', 'Lyon', '2023-02-20', 4, 150, 'user'),
('U3', 'Bernard', 'Alice', 'alice.bernard@example.com', 'mypassword', '789 Boulevard de Lille', '59000', 'Lille', '2023-03-10', 3, 200, 'user');

-- Insertion de données dans la table Competence
INSERT INTO "Competence" (IDCompetence, NomCompetence, Niveau_Debutant_Intermédiaire_Expert_, _CatégorieCompetence_) VALUES
('C1', 'Jardinage', 'Intermédiaire', 'Travaux'),
('C2', 'Nettoyage', 'Débutant', 'Entretien'),
('C3', 'Programmation', 'Expert', 'Services informatiques');

-- Insertion de données dans la table Service
INSERT INTO "Service" (IDService, NomService, Description_optionnel_, Categorie, CategorieSecondaire, DateService, DependenceMeteo, CreditRequis, CompétenceRequise) VALUES
('S1', 'Tondre la pelouse', 'Tondre la pelouse du jardin', 'Travaux', NULL, '2023-05-15 09:00:00', true, 50, 'Jardinage'),
('S2', 'Nettoyer la maison', 'Nettoyage complet de la maison', 'Entretien', NULL, '2023-05-20 10:00:00', false, 30, 'Nettoyage'),
('S3', 'Peinture', 'Réalisation de peintures intérieures de tout type', 'Travaux', NULL, '2023-06-01 09:00:00', false, 100, 'Bricolage');

-- Insertion de données dans la table Avis
INSERT INTO "Avis" (IDAvis, Note, Commentaire, DateAvis, IDUtilisateur, IDService) VALUES
('A1', 5, 'Excellent service !', '2023-05-16 12:00:00', 'U2', 'S1'),
('A2', 4, 'Très bon travail', '2023-05-21 15:00:00', 'U1', 'S2');

-- Insertion de données dans la table Offrir
INSERT INTO "Offrir" (IDService, IDUtilisateur, DateService) VALUES
('S1', 'U1', '2023-05-15 09:00:00'),
('S2', 'U2', '2023-05-20 10:00:00');

-- Insertion de données dans la table Planifier
INSERT INTO "Planifier" (IDService, IDUtilisateur, DateService) VALUES
('S3', 'U3', '2023-06-01 09:00:00');

-- Insertion de données dans la table Posséder
INSERT INTO "Posséder" (IDUtilisateur, IDCompetence) VALUES
('U1', 'C1'),
('U2', 'C2'),
('U3', 'C3');

-- Insertion de données dans la table Nécéssiter
INSERT INTO "Nécéssiter" (IDService, IDCompetence) VALUES
('S1', 'C1'),
('S2', 'C2'),
('S3', 'C3');

-- Insertion de données dans la table Demander
INSERT INTO "Demander" (IDService, IDUtilisateur, DateService) VALUES
('S1', 'U2', '2023-05-15 09:00:00'),
('S2', 'U1', '2023-05-20 10:00:00'),
('S3', 'U3', '2023-06-01 09:00:00');
