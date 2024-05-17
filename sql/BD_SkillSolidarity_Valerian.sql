-- Table Service
CREATE TABLE IF NOT EXISTS public."Service" (
    IDService VARCHAR(50) PRIMARY KEY,
    NomService VARCHAR(50) NOT NULL CHECK (NomService ~ '^[A-Za-z]+$'),
    Description_optionnel_ VARCHAR(150),
    Categorie VARCHAR(50) NOT NULL CHECK (upper(Categorie)='TRAVAUX' OR upper(Categorie)='ENTRETIEN' OR upper(Categorie)='ANIMAUX' OR upper(Categorie)='BRICOLAGE' OR upper(Categorie)='AUTOMOBILE' OR upper(Categorie)='SERVICES INFORMATIQUES' OR upper(Categorie)='COURS PARTICULIERS/ÉDUCATION' OR upper(Categorie)='AIDE À DOMICILE' OR upper(Categorie)='ASSISTANCE ADMINISTRATIVE' OR upper(Categorie)='COACHING/CONSEILS'),
    CategorieSecondaire VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    DependenceMeteo BOOLEAN NOT NULL,
    CreditRequis INT NOT NULL,
    CompétenceRequise VARCHAR(50) NOT NULL
);

-- Table Utilisateur
CREATE TABLE IF NOT EXISTS public."Utilisateur" (
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


-- Table Avis
CREATE TABLE Avis (
    IDAvis VARCHAR(50) PRIMARY KEY,
    Note INT NOT NULL,
    Commentaire VARCHAR(50),
    DateAvis TIMESTAMP NOT NULL,
    IDUtilisateur VARCHAR(50),
    FOREIGN KEY (IDUtilisateur) REFERENCES Utilisateur(IDUtilisateur),
    IDService VARCHAR(50),
    FOREIGN KEY (IDService) REFERENCES Service(IDService)
);

-- Table Competence
CREATE TABLE Competence (
    IDCompetence VARCHAR(50) PRIMARY KEY,
    NomCompetence VARCHAR(50) NOT NULL,
    Niveau_Debutant_Intermédiaire_Expert_ VARCHAR(50),
    _CatégorieCompetence_ VARCHAR(50)
);

-- Table Offrir
CREATE TABLE IF NOT EXISTS public."Offrir" (
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur, DateService),
    FOREIGN KEY (IDService) REFERENCES public."Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur)
);


-- Table Planifier
CREATE TABLE Planifier (
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur),
    FOREIGN KEY (IDService) REFERENCES Service(IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES Utilisateur(IDUtilisateur)
);

-- Table Posséder
CREATE TABLE Posséder (
    IDUtilisateur VARCHAR(50),
    IDCompetence VARCHAR(50),
    PRIMARY KEY (IDUtilisateur, IDCompetence),
    FOREIGN KEY (IDUtilisateur) REFERENCES Utilisateur(IDUtilisateur),
    FOREIGN KEY (IDCompetence) REFERENCES Competence(IDCompetence)
);

-- Table Nécéssiter
CREATE TABLE Nécéssiter (
    IDService VARCHAR(50),
    IDCompetence VARCHAR(50),
    PRIMARY KEY (IDService, IDCompetence),
    FOREIGN KEY (IDService) REFERENCES Service(IDService),
    FOREIGN KEY (IDCompetence) REFERENCES Competence(IDCompetence)
);

-- Table Demander
CREATE TABLE Demander (
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService VARCHAR(50) NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur),
    FOREIGN KEY (IDService) REFERENCES Service(IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES Utilisateur(IDUtilisateur)
);
