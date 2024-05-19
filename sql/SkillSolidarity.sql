-- Table Utilisateur
CREATE TABLE IF NOT EXISTS "Utilisateur" (
    IDUtilisateur VARCHAR(50) PRIMARY KEY,
    UserU VARCHAR(50) NOT NULL,
    EmailU VARCHAR(50) NOT NULL UNIQUE CHECK (EmailU SIMILAR TO '[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}'),
    MotDePasseU VARCHAR(50) NOT NULL CHECK (MotDePasseU ~ '[a-zA-Z0-9]+'),
    DateInscriptionU DATE NOT NULL,
    RoleU VARCHAR(50) NOT NULL
);

-- Table Service
CREATE TABLE IF NOT EXISTS "Service" (
    IDService VARCHAR(50) PRIMARY KEY,
    NomService VARCHAR(50) NOT NULL CHECK (NomService ~ '^[A-Za-z ]+$'),
    NiveauService VARCHAR(50) NOT NULL CHECK (upper(Categorie) IN ('DEBUTANT','INTERMEDIARE','EXPERT')),
    Description_optionnel_ VARCHAR(150),
    Categorie VARCHAR(50) NOT NULL CHECK (upper(Categorie) IN ('JARDINAGE', 'PLOMBERIE', 'MENAGE', 'PEINTURE', 'MECANIQUE', 'DEMENAGEMENT')),
    DateService TIMESTAMP NOT NULL,
    DureeService TIME NOT NULL
);

-- Table Avis
CREATE TABLE IF NOT EXISTS "Avis" (
    IDAvis VARCHAR(50) PRIMARY KEY,
    Note INT NOT NULL CHECK (Note BETWEEN 1 AND 5),
    Commentaire VARCHAR(255),
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
    Niveau VARCHAR(50) CHECK (Niveau IN ('Debutant', 'Intermediaire', 'Expert')),
    CategorieCompetence VARCHAR(50)
);

-- Table Contact
CREATE TABLE contact_form (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    messageContact TEXT
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
INSERT INTO "Utilisateur" (IDUtilisateur, UserU, EmailU, MotDePasseU, DateInscriptionU, RoleU) VALUES
('U1', 'DupontJean', 'jean.dupont@example.com', 'password123', '2023-01-15', 'user'),
('U2', 'MartinLucie', 'lucie.martin@example.com', 'securepassword', '2023-02-20', 'user'),
('U3', 'BernardAlice', 'alice.bernard@example.com', 'mypassword', '2023-03-10', 'user');

-- Insertion de données dans la table Competence
INSERT INTO "Competence" (IDCompetence, NomCompetence, Niveau) VALUES
('C1', 'Jardinage', 'Intermediaire'),
('C2', 'Nettoyage', 'Debutant'),
('C3', 'Programmation', 'Expert');

-- Insertion de données dans la table Service
INSERT INTO "Service" (IDService, NomService, Description_optionnel_, Categorie, DateService, DureeService) VALUES
('S1', 'Tondre la pelouse', 'Tondre la pelouse du jardin', 'JARDINAGE', '2023-05-15 09:00:00', '02:30:00'),
('S2', 'Nettoyer la maison', 'Nettoyage complet de la maison', 'MENAGE', '2023-05-20 10:00:00', '01:00:00'),
('S3', 'Peinture', 'Réalisation de peintures intérieures de tout type', 'PEINTURE', '2023-06-01 09:00:00', '04:00:00');

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

-- Insertion de données dans la table Demander
INSERT INTO "Demander" (IDService, IDUtilisateur, DateService) VALUES
('S1', 'U2', '2023-05-15 09:00:00'),
('S2', 'U1', '2023-05-20 10:00:00'),
('S3', 'U3', '2023-06-01 09:00:00');
