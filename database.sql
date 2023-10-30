CREATE TABLE cursus (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        diplome VARCHAR(255) NOT NULL,
                        ecole VARCHAR(255) NOT NULL,
                        description TEXT,
                        date_debut DATE NOT NULL,
                        date_fin DATE NOT NULL
);

CREATE TABLE experience (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            poste VARCHAR(255) NOT NULL,
                            employeur VARCHAR(255) NOT NULL,
                            description TEXT,
                            date_debut DATE NOT NULL,
                            date_fin DATE NOT NULL
);

CREATE TABLE utilisateur (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             user VARCHAR(255) NOT NULL,
                             password CHAR(255) NOT NULL,
                             admin BOOLEAN DEFAULT FALSE,
);