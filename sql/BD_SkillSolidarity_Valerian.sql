-- Table Service
CREATE TABLE Service (
    IDService VARCHAR(50) PRIMARY KEY,
    NomService VARCHAR(50) NOT NULL,
    Description_optionnel_ VARCHAR(50),
    Categorie VARCHAR(50) NOT NULL check (upper (Categorie)='Travaux'  or upper (Categorie)='Entretien' or upper (Categorie)='Animaux' or upper (Categorie)='Bricolage' or upper (Categorie)='Automobile' or upper (Categorie)='Services informatiques' or upper (Categorie)='Cours Particuliers/Éducation' or upper (Categorie)='Aide à domocile' or upper (Categorie)='Assistance administrative' or upper (Categorie)='Coaching/Conseils'),
    CategorieSecondaire VARCHAR(50),
    DateService TIMESTAMP NOT NULL,
    DependenceMeteo BOOLEAN NOT NULL,
    CreditRequis INT NOT NULL,
    CompétenceRequise VARCHAR(50) NOT NULL
);

-- Table Utilisateur
CREATE TABLE Utilisateur (
    IDUtilisateur VARCHAR(50) PRIMARY KEY,
    NomU VARCHAR(50) NOT NULL check (NomU ~ '^[A-Za-z]+$'),
    PrénomU VARCHAR(50) NOT NULL check (PrénomU ~ '^[A-Za-z]+$'),
    EmailU VARCHAR(50) NOT NULL UNIQUE check (EmailU SIMILAR TO '[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}'),
    MotDePasseU VARCHAR(50) NOT NULL check (MotDePasseU ~ '[a-zA-Z0-9]+'),
    Adresse VARCHAR(50) NOT NULL,
    Code_Postal DECIMAL(9,2) NOT NULL,
    Ville VARCHAR(50) NOT NULL,
    DateInscriptionU TIMESTAMP NOT NULL,
    NoteU INT NOT NULL,
    CreditU INT NOT NULL,
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
