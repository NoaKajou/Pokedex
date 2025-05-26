CREATE TABLE Generation (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE Type (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE Pokemon (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    weight DECIMAL(5,2),
    height DECIMAL(5,2),
    sexe ENUM('Male_Female', 'Unknown', 'Femelle', 'Male'),
    talent VARCHAR(100),
    legendary BOOLEAN DEFAULT FALSE,
    id_gen INT,
    numero INT,
    FOREIGN KEY (id_gen) REFERENCES Generation(id) ON DELETE CASCADE
);

CREATE TABLE Pokemon_Type (
    id_pokemon INT,
    id_type INT,
    PRIMARY KEY (id_pokemon, id_type),
    FOREIGN KEY (id_pokemon) REFERENCES Pokemon(id) ON DELETE CASCADE,
    FOREIGN KEY (id_type) REFERENCES Type(id) ON DELETE CASCADE
);

ALTER TABLE Pokemon ADD COLUMN image VARCHAR(255);