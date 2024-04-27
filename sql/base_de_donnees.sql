-- Table Service
CREATE TABLE Service (
    IDService VARCHAR(50) PRIMARY KEY,
    NomService VARCHAR(50) NOT NULL,
    Description_optionnel_ VARCHAR(50),
    Categorie VARCHAR(50),
    CategorieSecondaire VARCHAR(50),
    DateService TIMESTAMP,
    DependenceMeteo BOOLEAN,
    CreditRequis INT,
    CompétenceRequise VARCHAR(50) NOT NULL
);

-- Table Utilisateur
CREATE TABLE Utilisateur (
    IDUtilisateur VARCHAR(50) PRIMARY KEY,
    NomU VARCHAR(50) NOT NULL,
    PrénomU VARCHAR(50),
    EmailU VARCHAR(50),
    MotDePasseU VARCHAR(50),
    Adresse VARCHAR(50),
    Code_Postal DECIMAL(9,2),
    Ville VARCHAR(50),
    DateInscriptionU TIMESTAMP NOT NULL,
    NoteU INT,
    CreditU INT,
    RoleU BOOLEAN NOT NULL
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
CREATE TABLE Offrir (
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur),
    FOREIGN KEY (IDService) REFERENCES Service(IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES Utilisateur(IDUtilisateur)
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
