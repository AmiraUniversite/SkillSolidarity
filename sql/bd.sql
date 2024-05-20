-- Table Utilisateur
CREATE TABLE IF NOT EXISTS "Utilisateur" (
    IDUtilisateur VARCHAR(50) PRIMARY KEY,
    UserU VARCHAR(50) NOT NULL,
    EmailU VARCHAR(50) NOT NULL UNIQUE CHECK (EmailU SIMILAR TO '[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}'),
    MotDePasseU VARCHAR(50) NOT NULL CHECK (MotDePasseU ~ '[a-zA-Z0-9]+'),
    DateInscriptionU DATE NOT NULL,
    RoleU VARCHAR(50) NOT NULL
);
CREATE SEQUENCE utilisateur_id_seq;
ALTER TABLE public."Utilisateur"
ALTER COLUMN "idutilisateur" SET DEFAULT nextval('utilisateur_id_seq');

-- Table Service
CREATE TABLE IF NOT EXISTS "Service" (
    IDService SERIAL PRIMARY KEY,
    NomService VARCHAR(50) NOT NULL CHECK (NomService ~ '^[A-Za-z ]+$'),
    NiveauService VARCHAR(50) NOT NULL CHECK (NiveauService IN ('DEBUTANT', 'INTERMEDIARE', 'EXPERT')),
    Description_optionnel_ VARCHAR(150),
    Categorie VARCHAR(50) NOT NULL CHECK (Categorie IN ('JARDINAGE', 'PLOMBERIE', 'MENAGE', 'PEINTURE', 'MECANIQUE', 'DEMENAGEMENT')),
    DateService TIMESTAMP NOT NULL,
    DureeService TIME NOT NULL
);
CREATE SEQUENCE service_id_seq;
ALTER TABLE public."Service"
ALTER COLUMN "idservice" SET DEFAULT nextval('service_id_seq');

-- Table Avis
CREATE TABLE IF NOT EXISTS "Avis" (
    IDAvis SERIAL PRIMARY KEY,
    Note INT NOT NULL CHECK (Note BETWEEN 1 AND 5),
    Commentaire VARCHAR(255),
    DateAvis TIMESTAMP NOT NULL DEFAULT NOW(),
    IDUtilisateur VARCHAR(50),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur),
    IDService SERIAL,
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
    IDService SERIAL,
    IDUtilisateur VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur, DateService),
    FOREIGN KEY (IDService) REFERENCES "Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur)
);

-- Table Planifier
CREATE TABLE IF NOT EXISTS "Planifier" (
    IDService SERIAL,
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
    IDAvis INT,
    PRIMARY KEY (IDUtilisateur, IDAvis),
    FOREIGN KEY (IDUtilisateur) REFERENCES "Utilisateur" (IDUtilisateur),
    FOREIGN KEY (IDAvis) REFERENCES "Avis" (IDAvis)
);

-- Table Demander
CREATE TABLE IF NOT EXISTS "Demander" (
    IDService SERIAL,
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
INSERT INTO "Service" (IDService, NomService, NiveauService, Description_optionnel_, Categorie, DateService, DureeService) VALUES
('1', 'Tondre la pelouse','DEBUTANT','Tondre la pelouse du jardin', 'JARDINAGE', '2023-05-15 09:00:00', '02:30:00'),
('2', 'Nettoyer la maison','INTERMEDIARE', 'Nettoyage complet de la maison', 'MENAGE', '2023-05-20 10:00:00', '01:00:00'),
('3', 'Peinture', 'EXPERT', 'Réalisation de peintures intérieures de tout type', 'PEINTURE', '2023-06-01 09:00:00', '04:00:00');

-- Insertion de données dans la table Avis
INSERT INTO "Avis" (Note, Commentaire, DateAvis, IDUtilisateur, IDService) VALUES
(5, 'Excellent service !', '2023-05-16 12:00:00', 'U2', '1'),
(4, 'Très bon travail', '2023-05-21 15:00:00', 'U1', '2');

-- Insertion de données dans la table Offrir
INSERT INTO "Offrir" (IDService, IDUtilisateur, DateService) VALUES
('1', 'U1', '2023-05-15 09:00:00'),
('2', 'U2', '2023-05-20 10:00:00');

-- Insertion de données dans la table Planifier
INSERT INTO "Planifier" (IDService, IDUtilisateur, DateService) VALUES
('3', 'U3', '2023-06-01 09:00:00');

-- Insertion de données dans la table Posséder
INSERT INTO "Posséder" (IDUtilisateur, IDCompetence) VALUES
('U1', 'C1'),
('U2', 'C2'),
('U3', 'C3');

-- Insertion de données dans la table Demander
INSERT INTO "Demander" (IDService, IDUtilisateur, DateService) VALUES
('1', 'U2', '2023-05-15 09:00:00'),
('2', 'U1', '2023-05-20 10:00:00'),
('3', 'U3', '2023-06-01 09:00:00');




-- Récupérer l'identifiant de l'utilisateur jean.dupont@example.com
SELECT IDUtilisateur FROM "Utilisateur" WHERE EmailU = 'jean.dupont@example.com';

-- Pour l'exemple, disons que l'identifiant est 'U1'

-- Mise à jour de la contrainte pour accepter les caractères accentués (au cas où elle n'est pas encore mise à jour)
ALTER TABLE "Service" DROP CONSTRAINT IF EXISTS "Service_nomservice_check";
ALTER TABLE "Service" ADD CONSTRAINT "Service_nomservice_check" CHECK (NomService ~ '^[A-Za-zÀ-ÿ ]+$');

-- Ajouter un service supplémentaire
INSERT INTO "Service" (IDService, NomService, NiveauService, Description_optionnel_, Categorie, DateService, DureeService) VALUES
('8', 'Remplacement de toiture','EXPERT', 'Remplacement complet de la toiture', 'MECANIQUE', '2024-05-01 08:00:00', '08:00:00');

-- Ajouter les services existants
-- Services terminés
INSERT INTO "Service" (IDService, NomService, NiveauService, Description_optionnel_, Categorie, DateService, DureeService) VALUES
('10', 'Reparation de la cloture' ,'DEBUTANT', 'Réparation complète de la clôture du jardin', 'JARDINAGE', '2023-01-10 10:00:00', '03:00:00'),
('11', 'Installation de la plomberie', 'DEBUTANT', 'Installation de nouveaux tuyaux dans la cuisine', 'PLOMBERIE', '2023-02-15 08:00:00', '05:00:00');

-- Services à venir
INSERT INTO "Service" (IDService, NomService, NiveauService, Description_optionnel_, Categorie, DateService, DureeService) VALUES
('12', 'Peinture extérieure', 'DEBUTANT', 'Peinture des murs extérieurs ade la maison', 'PEINTURE', '2024-06-15 09:00:00', '06:00:00'),
('13', 'Nettoyage de printemps', 'DEBUTANT', 'Nettoyage complet de la maison pour le printemps', 'MENAGE', '2024-07-01 10:00:00', '04:00:00');

-- Services terminés offerts par jean.dupont@example.com
INSERT INTO "Offrir" (IDService, IDUtilisateur, DateService) VALUES
('10', 'U1', '2023-01-10 10:00:00'),
('11', 'U1', '2023-02-15 08:00:00');

-- Services à venir offerts par jean.dupont@example.com
INSERT INTO "Offrir" (IDService, IDUtilisateur, DateService) VALUES
('12', 'U1', '2024-06-15 09:00:00'),
('13', 'U1', '2024-07-01 10:00:00');

-- Ajouter le nouveau service à venir pour jean.dupont@example.com
INSERT INTO "Offrir" (IDService, IDUtilisateur, DateService) VALUES
('10', 'U1', '2024-05-01 08:00:00');
