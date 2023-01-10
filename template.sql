/* Creazione database meteo */
CREATE SCHEMA `meteo`;

/* Template provvisorio per le tabelle 
 * c'è da sperimentare con i tempi di esecuzione delle query
 */
CREATE TABLE `meteo`.`2023` (
  `id` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `temperatura` int(11) DEFAULT NULL,
  `pressione` double DEFAULT NULL,
  `umidita` int(11) DEFAULT NULL,
  `direzione-vento` varchar(2) DEFAULT NULL,
  `km-h` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
