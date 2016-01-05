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

### Dodaj przykładowe osoby do bazy

INSERT INTO Osoba(email, imie, nazwisko) VALUES
('solszewski@uj.edu.pl', 'Stanisław', 'Olszewski'),
('akania@uj.edu.pl', 'Agata', 'Kania'),
('pszewczyk@uj.edu.pl', 'Paulina', 'Szewczyk'),
('jkaminska@uj.edu.pl', 'Jagoda', 'Kamińska'),
('mlewandowski@uj.edu.pl', 'Mateusz', 'Lewandowski'),
('arogowska@uj.edu.pl', 'Amanda', 'Rogowska'),
('izielinski@uj.edu.pl', 'Igor', 'Zieliński'),
('mmatusiak@uj.edu.pl', 'Maria', 'Matusiak'),
('amalinowski@uj.edu.pl', 'Adam', 'Malinowski'),
('kwalczak@uj.edu.pl', 'Krzysztof', 'Walczak'),
('jsawicka@uj.edu.pl', 'Julia', 'Sawicka'),
('mbielecki@uj.edu.pl', 'Marcin ', 'Bielecki');

### Dodaj wykonane projekty do bazy

INSERT INTO Wykonany_projekt VALUES
(1, 11, '2015-12-11', 4.5),
(3, NULL, '2016-01-21', NULL),
(4, 11, '2015-12-17', 2.0),
(9, 12, '2015-12-01', NULL),
(2, 12, '2015-12-19', 3.5);

### Dodaj studentów do bazy

INSERT INTO Student VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 5),
(4, 1, 7),
(5, 2, NULL),
(6, 3, NULL),
(7, 1, 9),
(8, 2, 6),
(9, 3, 10),
(10, 1, NULL);

### Dodaj profesorów do bazy

INSERT INTO Profesor VALUES
(11, 'Bazy danych 1'),
(12, 'Bazy danych 2');