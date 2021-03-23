DROP DATABASE if exists verkkokauppa;

CREATE DATABASE if not exists verkkokauppa;

USE verkkokauppa;

CREATE TABLE tuote(
id int AUTO_INCREMENT PRIMARY KEY,
tuotenimi varchar(32),
hinta decimal(8),
tuotetiivistelmä text,
tuotekuvaus varchar(255),
pvm timestamp
);

insert into tuote(tuotenimi, hinta, tuotekuvaus)
values
('Intel-i7-6700K', 230, "Intel prosessori"),
("AMD Ryzen 7 5800x", 480, "AMD prosessori"),
("AMD Ryzen 5 3600", 220, "AMD prosessori"),
("Nvidia GeForce RTX 3090", 2800, "Nvidia näytönohjain"),
("Samsung 860 EVO SSD", 130, "Samsung ssd")