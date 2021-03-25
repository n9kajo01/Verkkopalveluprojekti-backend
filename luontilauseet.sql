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
luokka varchar(255),
FOREIGN KEY (id) REFERENCES tuote(id) );

insert into tuote(tuotenimi, hinta, tuotekuvaus, kuva)
values
('Intel-i7-6700K', 230, "Intel prosessori", "http://localhost/verkkokauppa/img/1.jpg"),
("AMD Ryzen 7 5800x", 480, "AMD prosessori", "http://localhost/verkkokauppa/img/2.jpg"),
("AMD Ryzen 5 3600", 220, "AMD prosessori", "http://localhost/verkkokauppa/img/3.jpg"),
("Nvidia GeForce RTX 3090", 2800, "Nvidia näytönohjain", "http://localhost/verkkokauppa/img/4.jpg"),
("Samsung 860 EVO SSD", 130, "Samsung ssd", "http://localhost/verkkokauppa/img/5.jpg");

insert into kategoria()
values
(1, "Prosessorit", "komponentit"),
(2, "Prosessorit", "komponentit"),
(3, "Prosessorit", "komponentit"),
(4, "Näytönohjaimet", "komponentit"),
(5, "Kovalevyt", "komponentit")










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

insert into tuote(tuotenimi, hinta, tuotekuvaus, kuva)
values
('Intel-i7-6700K', 230, "Intel prosessori", "http://localhost/verkkokauppa/img/1.jpg"),
("AMD Ryzen 7 5800x", 480, "AMD prosessori", "http://localhost/verkkokauppa/img/2.jpg"),
("AMD Ryzen 5 3600", 220, "AMD prosessori", "http://localhost/verkkokauppa/img/3.jpg"),
("Nvidia GeForce RTX 3090", 2800, "Nvidia näytönohjain", "http://localhost/verkkokauppa/img/4.jpg"),
("Samsung 860 EVO SSD", 130, "Samsung ssd", "http://localhost/verkkokauppa/img/5.jpg");

insert into kategoria()
values
(1, "Prosessorit Komponentit"),
(2, "Prosessorit Komponentit"),
(3, "Prosessorit Komponentit"),
(4, "Näytönohjaimet Komponentit"),
(5, "Kovalevyt Komponentit")