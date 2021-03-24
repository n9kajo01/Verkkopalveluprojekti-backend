DROP DATABASE if exists verkkokauppa;

CREATE DATABASE if not exists verkkokauppa;

USE verkkokauppa;

CREATE TABLE tuote(
id int AUTO_INCREMENT PRIMARY KEY,
tuotenimi varchar(32),
hinta decimal(8),
tuotetiivistelmä text,
tuotekuvaus text,
kuva varchar(255),
pvm timestamp
);

CREATE TABLE kategoria(
id int,
kategoria varchar(255),
FOREIGN KEY (id) REFERENCES tuote(id)
);

insert into tuote(tuotenimi, hinta, tuotekuvaus)
values
('Intel-i7-6700K', 230, "Intel prosessori"),
("AMD Ryzen 7 5800x", 480, "AMD prosessori"),
("AMD Ryzen 5 3600", 220, "AMD prosessori"),
("Nvidia GeForce RTX 3090", 2800, "Nvidia näytönohjain"),
("Samsung 860 EVO SSD", 130, "Samsung ssd");

insert into kategoria()
values
(1, "Prosessorit"),
(2, "Prosessorit"),
(3, "Prosessorit"),
(4, "Näytönohjaimet"),
(5, "Kovalevyt")