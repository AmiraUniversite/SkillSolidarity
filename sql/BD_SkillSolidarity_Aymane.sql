CREATE TABLE IF NOT EXISTS public."Service" --PB
(
    IDService VARCHAR(50) PRIMARY KEY,
    NomService VARCHAR(50) NOT NULL check (NomService ~ '^[A-Za-z]+$'),
    Description_optionnel VARCHAR(150),
    Categorie VARCHAR(50) NOT NULL check (upper (Categorie)='Travaux'  or upper (Categorie)='Entretien' or upper (Categorie)='Animaux' or upper (Categorie)='Bricolage' or upper (Categorie)='Automobile' or upper (Categorie)='Services informatiques' or upper (Categorie)='Cours Particuliers/Éducation' or upper (Categorie)='Aide à domocile' or upper (Categorie)='Assistance administrative' or upper (Categorie)='Coaching/Conseils'),
    CategorieSecondaire VARCHAR(50),
    DateService DATE NOT NULL,
    DependenceMeteo BOOLEAN NOT NULL,
    CreditRequis INT NOT NULL,
    CompetenceRequise VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS public."Utilisateur" --PB
(
    IDUtilisateur VARCHAR(50) PRIMARY KEY,
    NomU VARCHAR(50) NOT NULL check (NomU ~ '^[A-Za-z]+$'),
    PrénomU VARCHAR(50) NOT NULL check (PrénomU ~ '^[A-Za-z]+$'),
    EmailU VARCHAR(50) NOT NULL UNIQUE check (EmailU SIMILAR TO '[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}'),
    MotDePasseU VARCHAR(50) NOT NULL check (MotDePasseU ~ '[a-zA-Z0-9]+'),
    Adresse VARCHAR(100) NOT NULL,
    Code_Postal VARCHAR(10) NOT NULL,
    Ville VARCHAR(50) NOT NULL,
    DateInscriptionU DATE NOT NULL,
    NoteU INT NOT NULL CHECK (NoteU BETWEEN 0 AND 5),
    CreditU INT NOT NULL,
    RoleU VARCHAR(50) NOT NULL  --PB
);

CREATE TABLE IF NOT EXISTS public."Avis" --PB
(
    IDAvis VARCHAR(50) PRIMARY KEY,
    Note INT NOT NULL CHECK (Note BETWEEN 1 AND 5),
    Commentaire TEXT,
    DateAvis DATE NOT NULL,
    IDUtilisateur VARCHAR(50),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur)
);

CREATE TABLE IF NOT EXISTS public."Competence" --PB
(
    IDCompetence VARCHAR(50) PRIMARY KEY,
    NomCompetence VARCHAR(50) NOT NULL,
    Niveau VARCHAR(50) CHECK (Niveau IN ('Debutant', 'Intermediaire', 'Expert'))
);

CREATE TABLE IF NOT EXISTS public."Offrir" --PB
(
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService DATE NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur, DateService),
    FOREIGN KEY (IDService) REFERENCES public."Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur)
);

CREATE TABLE IF NOT EXISTS public."Planifier"
(
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService DATE NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur, DateService),
    FOREIGN KEY (IDService) REFERENCES public."Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur)
);

CREATE TABLE IF NOT EXISTS public."Posseder"
(
    IDUtilisateur VARCHAR(50),
    IDCompetence VARCHAR(50),
    PRIMARY KEY (IDUtilisateur, IDCompetence),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur),
    FOREIGN KEY (IDCompetence) REFERENCES public."Competence" (IDCompetence)
);

CREATE TABLE IF NOT EXISTS public."Demander"
(
    IDService VARCHAR(50),
    IDUtilisateur VARCHAR(50),
    DateService DATE NOT NULL,
    PRIMARY KEY (IDService, IDUtilisateur, DateService),
    FOREIGN KEY (IDService) REFERENCES public."Service" (IDService),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur)
);

CREATE TABLE IF NOT EXISTS public."Evaluer"
(
    IDService VARCHAR(50),
    IDAvis VARCHAR(50),
    DateService DATE NOT NULL,
    PRIMARY KEY (IDService, IDAvis, DateService),
    FOREIGN KEY (IDService) REFERENCES public."Service" (IDService),
    FOREIGN KEY (IDAvis) REFERENCES public."Avis" (IDAvis)
);

CREATE TABLE IF NOT EXISTS public."Recevoir"
(
    IDUtilisateur VARCHAR(50),
    IDAvis VARCHAR(50),
    PRIMARY KEY (IDUtilisateur, IDAvis),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur),
    FOREIGN KEY (IDAvis) REFERENCES public."Avis" (IDAvis)
);

CREATE TABLE IF NOT EXISTS public."Donner"
(
    IDUtilisateur VARCHAR(50),
    IDAvis VARCHAR(50),
    PRIMARY KEY (IDUtilisateur, IDAvis),
    FOREIGN KEY (IDUtilisateur) REFERENCES public."Utilisateur" (IDUtilisateur),
    FOREIGN KEY (IDAvis) REFERENCES public."Avis" (IDAvis)
);

CREATE TABLE IF NOT EXISTS public."Nécessiter"
(
    IDService VARCHAR(50),
    IDCompetence VARCHAR(50),
    PRIMARY KEY (IDService, IDCompetence),
    FOREIGN KEY (IDService) REFERENCES public."Service" (IDService),
    FOREIGN KEY (IDCompetence) REFERENCES public."Competence" (IDCompetence)
	
);