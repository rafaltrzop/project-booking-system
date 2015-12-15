### Usuń stare tabele

DROP TABLE IF EXISTS Osoba, Student, Profesor, Projekt, Wykonany_projekt;

### Utwórz nowe tabele

CREATE TABLE Osoba
(
id_osoby INT PRIMARY KEY AUTO_INCREMENT,
email VARCHAR(80),
imie VARCHAR(30),
nazwisko VARCHAR(30)
);

CREATE TABLE Student
(
id_osoby INT PRIMARY KEY,
grupa INT,
nr_projektu INT DEFAULT NULL
);

CREATE TABLE Profesor
(
id_osoby INT PRIMARY KEY,
wykladany_przedmiot VARCHAR(50)
);

CREATE TABLE Projekt
(
nr_projektu INT PRIMARY KEY AUTO_INCREMENT,
temat VARCHAR(255)
);

CREATE TABLE Wykonany_projekt
(
id_osoby_student INT PRIMARY KEY,
id_osoby_profesor INT DEFAULT NULL,
data_oddania DATE,
ocena DECIMAL(2,1) DEFAULT NULL
);

### Dodaj przykładowe osoby do bazy

INSERT INTO Osoba(email, imie, nazwisko) VALUES
('bgraham0@patch.com', 'Barbara', 'Graham'),
('pgarcia1@blogspot.com', 'Philip', 'Garcia'),
('rkelly2@home.pl', 'Ralph', 'Kelly'),
('cadams3@businessinsider.com', 'Catherine', 'Adams'),
('jking4@wikispaces.com', 'James', 'King'),
('clawson5@nature.com', 'Cynthia', 'Lawson'),
('cray6@dropbox.com', 'Christina', 'Ray'),
('agraham7@jugem.jp', 'Angela', 'Graham'),
('pclark8@state.gov', 'Pamela', 'Clark'),
('dgarcia9@ucsd.edu', 'Deborah', 'Garcia'),
('ksandersa@i2i.jp', 'Kevin', 'Sanders'),
('rstevensb@instagram.com', 'Russell', 'Stevens');

### Dodaj studentów do bazy

INSERT INTO Student VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 5),
(4, 1, 7),
(5, 2, 1),
(6, 3, 4),
(7, 1, 9),
(8, 2, 6),
(9, 3, 10),
(10, 1, 8);

### Dodaj profesorów do bazy

INSERT INTO Profesor VALUES
(11, 'Bazy danych 2 (wykład)'),
(12, 'Bazy danych 2 (ćwiczenia)');

### Dodaj tematy projektów do bazy

INSERT INTO Projekt(temat) VALUES
('Rejestracja czasu pracy'),
('Ewidencja płatności za wynajem mieszkań'),
('Strona z wynikami ligowymi'),
('Magazyn towarów'),
('Wypożyczalnia filmów'),
('Biblioteka książek'),
('Stacja krwiodawstwa'),
('Wypożyczalnia samochodów'),
('System rezerwacji biletów'),
('Pizzeria'),
('Rezerwacja terminów dla zakładu usługowego'),
('System rezerwacji tematów projektów'),
('System parkingowy'),
('Dziennik ocen'),
('System zarządzania szpitalem'),
('System zarządzania wypłatami pracowników'),
('Galeria obrazów'),
('Hurtownia');

### Dodaj wykonane projekty do bazy

INSERT INTO Wykonany_projekt VALUES
(1, 11, '2015-12-11', '4.5'),
(3, 12, '2016-01-21', '2.0'),
(4, 11, '2015-12-17', '4.0'),
(9, 12, '2015-12-01', '5.0'),
(2, 11, '2015-12-19', '3.5');