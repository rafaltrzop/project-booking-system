### Usuń stare tabele

DROP TABLE IF EXISTS Profesor, Student, Wykonany_projekt, Osoba, Projekt;

### Utwórz nowe tabele

CREATE TABLE Projekt
(
nr_projektu INT PRIMARY KEY AUTO_INCREMENT,
temat VARCHAR(255)
) ENGINE = INNODB;

CREATE TABLE Osoba
(
id_osoby INT PRIMARY KEY AUTO_INCREMENT,
email VARCHAR(80),
imie VARCHAR(30),
nazwisko VARCHAR(30)
) ENGINE = INNODB;

CREATE TABLE Wykonany_projekt
(
id_osoby_student INT PRIMARY KEY,
id_osoby_profesor INT DEFAULT NULL,
data_oddania DATE,
ocena DECIMAL(2,1) DEFAULT NULL,
FOREIGN KEY (id_osoby_student) REFERENCES Osoba(id_osoby) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE Student
(
id_osoby INT PRIMARY KEY,
grupa INT,
nr_projektu INT DEFAULT NULL,
FOREIGN KEY (id_osoby) REFERENCES Osoba(id_osoby) ON DELETE CASCADE,
FOREIGN KEY (nr_projektu) REFERENCES Projekt(nr_projektu) ON DELETE SET NULL
) ENGINE = INNODB;

CREATE TABLE Profesor
(
id_osoby INT PRIMARY KEY,
wykladany_przedmiot VARCHAR(50),
FOREIGN KEY (id_osoby) REFERENCES Osoba(id_osoby) ON DELETE CASCADE
) ENGINE = INNODB;