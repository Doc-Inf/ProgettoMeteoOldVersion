START TRANSACTION;
SELECT 'Transaction Started' as '';

DROP DATABASE IF EXISTS meteo;
SELECT 'DROP Database effettuato' as '';

CREATE DATABASE meteo;
SELECT 'Database creato' as '';
USE meteo;
SELECT "Database selezionato e pronto all'uso" as '';

CREATE TABLE `y2022` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2022 CREATA' as '';

CREATE TABLE `y2023` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2023 CREATA' as '';

CREATE TABLE `y2024` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2024 CREATA' as '';

CREATE TABLE `y2025` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2025 CREATA' as '';

CREATE TABLE `y2026` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2026 CREATA' as '';

CREATE TABLE `y2027` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2027 CREATA' as '';

CREATE TABLE `y2028` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2028 CREATA' as '';

CREATE TABLE `y2029` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2029 CREATA' as '';

CREATE TABLE `y2030` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2030 CREATA' as '';

CREATE TABLE `y2031` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2031 CREATA' as '';

CREATE TABLE `y2032` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2032 CREATA' as '';

CREATE TABLE `y2033` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2033 CREATA' as '';

CREATE TABLE `y2034` (
  id                int PRIMARY KEY AUTO_INCREMENT, 
  data              datetime NOT NULL,
  temperatura       int NOT NULL,
  pressione         double NOT NULL,
  umidita           int NOT NULL,
  `direzione-vento` varchar(2) NOT NULL,
  `km-h`            int NOT NULL
);

SELECT 'TABELLA Y2034 CREATA' as '';

CREATE TABLE login (
    id              INT primary key AUTO_INCREMENT,
    username        varchar(32) NOT NULL,
    password        varchar(2048) NOT NULL,
    ruolo           enum('superadmin','admin','operatore') DEFAULT 'operatore' NOT NULL,
    last_access     DATETIME

);

SELECT 'TABELLA login CREATA' as '';

-- username:root password:root (sha256) --
INSERT INTO login(username, password,ruolo) value ("docente", '4a06fcaff060e92bcc38c5b5ecb2e599c6dc20dd92fcbe13f9fee62c2b735db9','superadmin');
-- Password originale (Studenti): '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2' 

SELECT 'INSERIMENTO ACCOUNT ADMIN Completato' as '';

INSERT INTO `y2022`(data, temperatura, pressione, umidita, `direzione-vento`, `km-h`) VALUES 
    ('2022-10-18 09:00','24','995.4','59','NE','2'),
		('2022-10-19 09:00','20','989.3','77','W','3'),
		('2022-10-20 09:00','22','989.4','57','S','2'),
		('2022-10-21 09:00','19','990.3','71','SW','0'),
		('2022-10-25 09:00','19','990.0','88','SW','5'),
		('2022-10-26 09:00','23','991.7','76','NW','3'),
		('2022-10-27 09:00','17','994.4','71','NE','5'),
		('2022-10-28 09:00','20','994.0','67','SE','0'),
		('2022-11-02 09:00','19','993.0','82','NE','3'),
		('2022-11-03 09:00','17','990.8','83','SW','2'),
		('2022-11-04 09:00','18','976.5','71','NE','8'),
		('2022-11-07 09:00','18','987.8','65','NW','5'),
		('2022-11-11 09:00','19','997.1','74','SW','0'),
		('2022-11-15 09:00','16','986.8','74','NW','2'),
		('2022-11-16 09:00','16','975.6','93','SW','0'),
		('2022-11-22 09:00','11','960.2','88','NE','13'),
		('2022-11-24 09:00','16','981.6','58','SW','3'),
		('2022-11-25 09:00','14','988.0','74','NW','0'),
		('2022-11-28 09:00','20','985.2','53','SW','0'),		
		('2022-12-01 09:00','13','981.6','64','SW','0'),		
		('2022-12-02 09:00','11','985.3','77','SW','0'),		
		('2022-12-06 09:00','17','983.8','70','NW','3'),		
		('2022-12-07 09:00','17','980.0','54','SW','2'),		
		('2022-12-13 09:00','10','972.2','93','S','6'),		
		('2022-12-14 09:00','11','969.7','93','SW','9'),		
		('2022-12-15 09:00','13','977.5','88','SW','3'),		
		('2022-12-16 09:00','14','976.4','94','W','2'),		
		('2022-12-19 09:00','14','999.9','76','W','0'),		
		('2022-12-20 09:00','9','996.8','78','S','2');

SELECT 'INSERIMENTO Dati rilevazioni Y2022 Completato' as '';

INSERT INTO `y2023`(data, temperatura, pressione, umidita, `direzione-vento`, `km-h`) VALUES     	
    ('2023-01-09 09:00','14','961.4','95','NE','26'),		
    ('2023-01-10 09:00','9','978.8','58','SE','11'),
    ('2023-01-13 9:00:00', '12', '989.7',  '63', 'NE', '0'),
    ('2023-01-16 9:00:00', '12', '973.5',  '74', 'NE', '27'), 
    ('2023-01-17 9:00:00', '13', '960.1',  '94', 'NE', '13'),
    ('2023-02-01 9:00:00', '10', '991.9',  '76', 'SE', '0'),
    ('2023-02-02 9:00:00', '16', '989.5', '50', 'N', '2'),
    ('2023-02-08 9:00:00', '8', '997.2',  '31', 'NE', '2'),
    ('2023-02-10 9:00:00', '8', '997.8',  '48', 'S', '11'),
    ('2023-02-16 9:00:00', '11', '999.4',  '74', 'SW', '2'),
    ('2023-02-17 9:00:00', '11', '998.5',  '67', 'SW', '6'),
    ('2023-02-21 9:00:00', '12', '991.5',  '78', 'W', '5'),
    ('2023-02-22 9:00:00', '14', '985.1',  '66', 'N', '6'),
    ('2023-02-23 9:00:00', '14', '984.4',  '72', 'N', '3'),
    ('2023-02-24 9:00:00', '12', '983.3',  '86', 'W', '2'),
    ('2023-02-28 9:00:00', '9', '981.6',  '76', 'SW', '8'),
    ('2023-03-02 9:00:00', '9', '978.2',  '78', 'SW', '6'),
    ('2023-03-03 9:00:00', '9', '981.2',   '85', 'S', '6'),
    ('2023-03-06 9:00:00', '10', '979.6',  '85', 'NE', '3'), 
    ('2023-03-07 9:00:00', '12', '977.3',  '79', 'NW', '6'),
    ('2023-03-08 9:00:00', '12', '978.8',  '93', 'SW', '5'),
    ('2023-03-09 9:00:00', '15', '979.6',  '85', 'W', '3'),
    ('2023-03-10 9:00:00', '13', '974.3',  '95', 'NE', '2'),
    ('2023-03-14 9:00:00', '14', '979.4',  '71', 'NW', '5'),
    ('2023-03-16 9:00:00', '11', '983.9',  '41', 'SW', '0'),
    ('2023-03-17 9:00:00', '12', '988.3',  '55', 'NE', '5'),	
		('2023-03-20 9:00:00',  '11', '987.1',  '88', 'SW', '0'),
		('2023-03-21 9:00:00',  '15',  '983.4',  '72', 'NW', '5'),
    ('2023-03-22 9:00:00', '15', '984.6',  '69', 'W', '5'),
    ('2023-03-23 9:00:00', '14', '984.2',  '77', 'SW', '6'),
    ('2023-03-27 9:00:00', '10', '972.4',  '80', 'SW', '0'),
    ('2023-03-28 9:00:00', '11', '966.6',  '57', 'SW', '11'),
    ('2023-03-29 9:00:00', '13', '996.0',  '64', 'W', '3'),
    ('2023-03-30 9:00:00', '12', '994.2',  '82', 'SW', '0'),
    ('2023-03-31 9:00:00', '13', '986.1', '76', 'W', '3'),
    ('2023-04-3 9:00:00', '16', '972.9',  '45', 'SW', '2'),
    ('2023-04-4 9:00:00', '11', '975.0',  '61', 'S', '5'),
    ('2023-04-5 9:00:00', '6', '980.2',  '84', 'S', '8'),
    ('2023-04-12 9:00:00', '16', '980.3',  '64', 'W', '2'),
    ('2023-04-13 9:00:00', '13', '974.1',  '78', 'W', '3'),
    ('2023-04-14 9:00:00', '14', '974.2',  '58', 'E', '5'),
    ('2023-04-20 9:00:00', '17', '980.9',  '65', 'NE', '6'),
    ('2023-04-26 9:00:00', '16', '980.7',  '58', 'W', '3'),
    ('2023-04-27 9:00:00', '17', '986.0',  '56', 'W', '3'),
    ('2023-05-02 9:00:00', '14', '976.0',  '94', 'SW', '2'),
    ('2023-05-03 9:00:00', '17', '981.4',  '78', 'S', '0'),
    ('2023-05-04 9:00:00', '17', '986.4',  '73', 'NE', '2'),
    ('2023-05-05 9:00:00', '17', '988.0',  '75', 'W', '3'),
    ('2023-05-06 9:00:00', '17', '986.3',  '86', 'N', '5'),
    ('2023-05-09 9:00:00', '19', '984.7',  '67', 'W', '0'),
    ('2023-05-10 9:00:00', '16', '980.1',  '90', 'WE', '2'),
    ('2023-05-11 9:00:00', '17', '979.6',  '81', 'N', '3'),
    ('2023-05-12 9:00:00', '15', '982.0',  '79', 'SW', '2'),
    ('2023-05-16 9:00:00', '13', '963.8',  '53', 'S', '2'),    
    ('2023-05-17 9:00:00', '14', '973.6',  '94', 'N', '3'),
    ('2023-05-18 9:00:00', '13', '963.8',  '53', 'W', '3'),
    ('2023-05-19 9:00:00', '16', '1012.8',  '84', 'S', '5'),
    ('2023-05-22 9:00:00', '19', '1008.9',  '66', 'SW', '0'),
    ('2023-05-23 9:00:00', '22', '1011.3',  '66', 'NE', '0');

SELECT 'INSERIMENTO Dati rilevazioni Y2023 Completato' as '';

COMMIT;

SELECT 'Transaction Completed' as '';