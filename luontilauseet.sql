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

CREATE TABLE kommentit(
id int AUTO_INCREMENT PRIMARY KEY,
tuoteid int,
otsikko varchar(255), 
kommentti varchar(255),
arvosana decimal(10,2),
käyttäjä varchar(255),
FOREIGN KEY (tuoteid) REFERENCES tuote(id) );

CREATE TABLE kategoria(
id int AUTO_INCREMENT,
kategoria varchar(255), 
luokka varchar(255),
FOREIGN KEY (id) REFERENCES tuote(id) );

CREATE TABLE login(
id int AUTO_INCREMENT PRIMARY KEY,
username varchar(255),
password varchar(255),
oikeudet varchar(20)
);

CREATE TABLE tilaus(
    id int AUTO_INCREMENT PRIMARY KEY,
    nimi varchar(255),
    puhelin varchar(255),
    osoite varchar(255),
    postinro varchar(255),
    sähköposti varchar(255),
    toimitustapa varchar(255),
    maksutapa varchar(255),
    pvm timestamp
);

CREATE TABLE tilausrivi(
    tilausid int not null,
    rivinro int not null AUTO_INCREMENT,
    tuotenro int,
    kpl int,
    PRIMARY KEY (rivinro,tilausid)
 
);

insert into tuote(tuotenimi, hinta,tuotetiivistelmä, tuotekuvaus, kuva)
values
('Intel Core i7-10700K', 360, "Intelin LGA1200 -kantaan suunniteltu suoritin Comet Lake -arkkitehtuurilla.", "Intelin LGA1200 -kantaan suunniteltu suoritin Comet Lake -arkkitehtuurilla", "http://localhost/verkkokauppa/img/1.jpg"),
("AMD Ryzen 7 5800x", 480, "Eliitti peliprosessori - 8 ydintä optimoituna high-FPS pelikokoonpanoihin!", "AMD Ryzen 5000 -sarjan suorittimet tarjoavat edistyksellisen prosessoriarkkitehtuurin pelaajille ja sisällöntuottajille. Pelaatpa uusimpia pelejä, suunnittelet pilvenpiirtäjiä tai analysoit dataa, tarvitset prosessorin, joka mahdollistaa tarvitsemasi suorituskyvyn. AMD:n Zen 3 -prosessoriarkkitehtuuri nostaa suorituskyvyn uudelle tasolle niin peleissä kuin myös useita prosessoriytimiä ja -säikeitä käyttävissä sovelliksissa, kuten 3D- ja videorenderöinti.
AMD Ryzen 5000 -sarja tarjoaa PCIe 4.0 -tuen, mikä mahdollistaa myös tulevien sukupolvien näytönohjainten täyden suorituskyvyn ja huippunopeiden SSD-levyjen käytön.", "http://localhost/verkkokauppa/img/2.jpg"),
("AMD Ryzen 5 3600", 220, "3. sukupolven Ryzen on viimein täällä ja tuo mukanaan tuen PCIe 4.0 -väylälle!","Suorituskykyä tarjoava AMD:n 7 nanometrin valmistusprosessilla valmistettu 6-ydinprosessori.", "http://localhost/verkkokauppa/img/3.jpg"),
("Nvidia GeForce RTX 3090", 2800, "GeForce RTX 30 -sarjan grafiikkasuorittimet antavat äärimmäisen suorituskyvyn.", "GeForce RTX 30 -sarjan grafiikkasuorittimet antavat äärimmäisen suorituskyvyn niin pelaajien kuin luovan työn tekijöidenkin käyttöön. Tehon salaisuus on Ampere – NVIDIAN toisen sukupolven RTX-arkkitehtuuri, jonka uudistetut RT- ja Tensor-ytimet sekä SM-monisuorittimet varmistavat tähän asti realistisimman säteenseurantagrafiikan ja huippuluokan tekoälytoiminnot", "http://localhost/verkkokauppa/img/4.jpg"),
("Samsung 860 EVO SSD", 130, "SATA3 -SSD-kovalevy", "860 EVO on suunnattu kuluttaja-asiakkaille, jotka vaativat lisää suorituskykyä päivittäisiin sovellusaskareisiin ja raskaisiin graafista suorituskykyä vaativiin tehtäviin. 860 EVO hyödyntää suositun 850-sarjan tavoin V-NAND-piiriteknologiaa, mutta siinä on parannettu nopeutta, luotettavuutta ja yhteensopivuutta. 860 EVO-sarjan asemat tukevat peräti 550 Mt/s lukunopeuksia ja 520 Mt/s kirjoitusnopeuksia. Lisäksi ne tarjoavat vertaansa vailla olevan toimintavarmuuden." ,"http://localhost/verkkokauppa/img/5.jpg"),
("Logitech G Pro", 99, "Mekaaninen Logitech G Pro -pelinäppäimistö", "Mekaaninen Logitech G Pro -pelinäppäimistö on suunniteltu e-urheilijoiden kanssa e-urheilijoita varten. Se on pienikokoinen eikä siinä ole lainkaan numeronäppäimistöä, joten pöydällä on hyvin tilaa hiiren liikkeille alhaisilla herkkyysasetuksilla. Ammattilaistasoiset Clicky-kytkimet tuottavat kuuluvan naksahduksen ja sormenpäissä tuntuvan selkeän palautteen ja painalluksen", "http://localhost/verkkokauppa/img/6.jpg"),
("Samsung Odyssey C27RG50", 299, "Upea 27' Full hd -tarkkuuden pelinäyttö", "Samsung Odyssey C27RG50. Upea 27' Full HD -tarkkuuden pelinäyttö, jonka huippuluokan 240 Hz -virkistystaajuus yhdistettynä NVIDIA G-SYNC -yhteensopivuuteen varmistaa veitsenterävän, häntimättömän ja repeilemättömän kuvan. 1500R-kaareva paneeli luo mukaansatempaavan pelikokemuksen ja VA-paneelitekniikka takaa laajan 178 asteen katselukulman sekä mainion värientoiston, syvät mustat värit sekä kirkkaat valkoiset värit 3000:1 kontrastisuhteen tukemana.", "http://localhost/verkkokauppa/img/7.jpg"),
("Logitech M220 Silent", 25, "Suorita työsi jättämättä yhtään sydämenlyöntiä väliin tai häiritsemättä ympärilläsi olevia. ", "Hiljaisilla hiirillä on sama napsautustuntuma ilman napsautusääntä- yli 90 % aiempaa pienemmällä melulla*. Kestävät, korkean suorituskyvyn tassut liukuvat hiljaisesti työpöydän yli. Tasainen vierityspyörä täydentää hiljaisen kokemuksen.", "http://localhost/verkkokauppa/img/8.jpg"),
("Asus Prime B550-Plus AM4", 152, "Asus Prime B550-Plus AMD B550 -piirisarjalla varustettu AM4-kantainen emolevy", "Asus Prime B550-Plus on AMD B550 -piirisarjalla varustettu AM4-kantainen emolevy 3. sukupolven AMD Ryzen prosessoreille. Emolevy tukee myös BIOS-päivityksellä tulevan sukupolven AMD Ryzen prosessoreita. B550 piirisarjan PCIe 4.0 -tuki tarjoaa tarvittavan kaistan huippunopeille SSD-levyille ja seuraavan sukupolven näytönohjaimille!", "http://localhost/verkkokauppa/img/9.jpeg"),
("Asus VG248QE 24' Full HD -näyttö", 220, "ASUS VG248QE on jokaisen PC-pelaajan unelmamonitori - Full HD 1920x1080-resoluution 24' näyttö", "ASUS VG248QE on jokaisen PC-pelaajan unelmamonitori - Full HD 1920x1080-resoluution 24' näyttö on varustettu tyrmäävällä 144Hz virkistystaajuudella ja 1ms vasteajalla, joiden ansiosta pelikuva ei repeile intensiivisimmissäkään pelitilanteissa. Näyttö tukee myös nVidian 3D-tekniikkaa. Näyttö on varustettu viimeisimmillä liitännöillä, kuten DisplayPort, Dual-link DVI ja HDMI-porteilla.", "http://localhost/verkkokauppa/img/10.png"),
("Kolink Observatory Lite Mesh RGB", 57, "Kolink Observatory Lite Mesh RGB, ikkunallinen miditornikotelo, musta", "Kolink Observatory Lite Mesh on hinta-laatusuhteeltaan erinomainen miditorni, jossa on monipuolisia ominaisuuksia juuri oikeassa suhteessa. Observatory Lite Mesh on myös näyttävä: kotelossa on 4 esiasennettua 120 mm ARGB LED -tuuletinta joissa monta erilaista valaisu- ja värivalovaihtoehtoa joita voidaan säätää sisältyvän kaukosäätimen avulla. Myös pyörimisnopeus on säädettävissä, ja tuulettimet yhdistettynä verkkomateriaalista valmistettuun etupaneeliin pitävät sisustan viileänä", "http://localhost/verkkokauppa/img/11.jpg"),
("PowerColor Radeon RX 6700 XT Red Devil", 900, "AMD näytönohjain, jota vauhdittaa AMD RDNA 2 arkkitehtuuri, 40 tehokasta laskentayksikköä.", "AMD Radeon RX 6700 XT näytönohjain, jota vauhdittaa AMD RDNA 2 arkkitehtuuri, 40 tehokasta laskentayksikköä, 96 Mt AMD Infinity Cache ja 12 Gt GDDR6 -muistia. AMD Radeon RX 6700 XT -sarja tuo pelikoneeseesi kaiken mitä tarvitset uuden sukupolven huippupelien pelaamiseen tarjoamalla runsaasti suorituskykyä, uskomattomat tehosteet ja pelifysiikan, sekä uusimmat ominaisuudet.", "http://localhost/verkkokauppa/img/12.png");

insert into kategoria()
values
(1, "Prosessorit", "komponentit"),
(2, "Prosessorit", "komponentit"),
(3, "Prosessorit", "komponentit"),
(4, "Näytönohjaimet", "komponentit"),
(5, "Kovalevyt", "komponentit"),
(6, "Näppäimistöt", "oheislaitteet"),
(7, "Näytöt", "oheislaitteet"),
(8, "Hiiret", "oheislaitteet"),
(9, "Emolevyt", "komponentit"),
(10, "Näytöt", "oheislaitteet"),
(11, "Kotelot", "komponentit"),
(12, "Näytönohjaimet", "komponentit");


