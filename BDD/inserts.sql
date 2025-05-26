INSERT INTO Type (name) VALUES
('Acier'),
('Combat'),
('Dragon'),
('Eau'),
('Électrik'),
('Fée'),
('Feu'),
('Glace'),
('Insecte'),
('Normal'),
('Plante'),
('Poison'),
('Psy'),
('Roche'),
('Sol'),
('Spectre'),
('Ténèbres'),
('Vol');

INSERT INTO Generation (name) VALUES
('1ère génération'),
('2ème génération'),
('3ème génération'),
('4ème génération'),
('5ème génération'),
('6ème génération'),
('7ème génération'),
('8ème génération'),
('9ème génération');

INSERT INTO Pokemon (name, weight, height, sexe, talent, legendary, id_gen, numero, image)
VALUES
('Bulbizarre', 6.90, 0.70, 'Male_Female', 'Engrais', FALSE, 1, 1, 'images/001.png'),
('Herbizarre', 13.00, 1.00, 'Male_Female', 'Engrais', FALSE, 1, 2, 'images/002.png'),
('Florizarre', 100.00, 2.00, 'Male_Female', 'Engrais', FALSE, 1, 3, 'images/003.png'),
('Salamèche', 8.50, 0.60, 'Male_Female', 'Brasier', FALSE, 1, 4, 'images/004.png'),
('Reptincel', 19.00, 1.10, 'Male_Female', 'Brasier', FALSE, 1, 5, 'images/005.png'),
('Dracaufeu', 90.50, 1.70, 'Male_Female', 'Brasier', FALSE, 1, 6, 'images/006.png'),
('Carapuce', 9.00, 0.50, 'Male_Female', 'Torrent', FALSE, 1, 7, 'images/007.png'),
('Carabaffe', 22.50, 1.00, 'Male_Female', 'Torrent', FALSE, 1, 8, 'images/008.png'),
('Tortank', 85.50, 1.60, 'Male_Female', 'Torrent', FALSE, 1, 9, 'images/009.png');

INSERT INTO Pokemon_Type (id_pokemon, id_type) VALUES
(1, 11), (1, 12),   -- Bulbizarre: Plante, Poison
(2, 11), (2, 12),   -- Herbizarre
(3, 11), (3, 12),   -- Florizarre
(4, 7),             -- Salamèche: Feu
(5, 7),             -- Reptincel
(6, 7), (6, 18),    -- Dracaufeu: Feu, Vol
(7, 4),             -- Carapuce: Eau
(8, 4),             -- Carabaffe
(9, 4);             -- Tortank
