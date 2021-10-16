-- MySQL dump 10.13  Distrib 5.7.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: inventariorq
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `controle_r`
--

DROP TABLE IF EXISTS `controle_r`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controle_r` (
  `idcontrole` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `controle` varchar(40) DEFAULT NULL COMMENT 'Lista de controles para os reagentes.',
  PRIMARY KEY (`idcontrole`),
  UNIQUE KEY `controle_UNIQUE` (`controle`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controle_r`
--

LOCK TABLES `controle_r` WRITE;
/*!40000 ALTER TABLE `controle_r` DISABLE KEYS */;
INSERT INTO `controle_r` VALUES (4,'Exército'),(2,'Polícia Civil'),(6,'Polícia Civil e Exército'),(5,'Polícia Civil e Federal'),(8,'Polícia Civil, Federal e Exército'),(3,'Polícia Federal'),(7,'Polícia Federal e Exército'),(1,'Sem controle');
/*!40000 ALTER TABLE `controle_r` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laboratorio_r`
--

DROP TABLE IF EXISTS `laboratorio_r`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laboratorio_r` (
  `idlaboratorio` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `laboratorio` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idlaboratorio`),
  UNIQUE KEY `laboratorio_UNIQUE` (`laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laboratorio_r`
--

LOCK TABLES `laboratorio_r` WRITE;
/*!40000 ALTER TABLE `laboratorio_r` DISABLE KEYS */;
INSERT INTO `laboratorio_r` VALUES (1,'Ciências da Terra'),(2,'Ecologia e Evolução');
/*!40000 ALTER TABLE `laboratorio_r` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca_r`
--

DROP TABLE IF EXISTS `marca_r`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca_r` (
  `idmarca` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idmarca`),
  UNIQUE KEY `marca_UNIQUE` (`marca`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca_r`
--

LOCK TABLES `marca_r` WRITE;
/*!40000 ALTER TABLE `marca_r` DISABLE KEYS */;
INSERT INTO `marca_r` VALUES (12,'Dinâmica'),(4,'Fmaia'),(2,'Merck'),(3,'Mtedia'),(15,'Nuclear'),(1,'Synth'),(8,'Vetec');
/*!40000 ALTER TABLE `marca_r` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reagente`
--

DROP TABLE IF EXISTS `reagente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reagente` (
  `idreagente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `formula` varchar(20) DEFAULT NULL,
  `idmarca` tinyint(3) unsigned NOT NULL,
  `volume_massa` varchar(8) NOT NULL,
  `quantidade` tinyint(3) unsigned NOT NULL,
  `validade` date DEFAULT NULL,
  `idcontrole` tinyint(3) unsigned DEFAULT NULL,
  `compra` date DEFAULT NULL,
  `idlaboratorio` tinyint(3) unsigned NOT NULL,
  `localizacao` varchar(45) NOT NULL,
  `idresponsavel` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idreagente`),
  KEY `fk_reagentes_controle_r1_idx` (`idcontrole`),
  KEY `fk_reagentes_laboratorios_r1_idx` (`idlaboratorio`),
  KEY `fk_reagentes_responsaveis_r1_idx` (`idresponsavel`),
  KEY `fk_reagentes_marcas_r1_idx` (`idmarca`),
  CONSTRAINT `fk_reagentes_controle_r1` FOREIGN KEY (`idcontrole`) REFERENCES `controle_r` (`idcontrole`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_reagentes_laboratorios_r1` FOREIGN KEY (`idlaboratorio`) REFERENCES `laboratorio_r` (`idlaboratorio`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_reagentes_marcas_r1` FOREIGN KEY (`idmarca`) REFERENCES `marca_r` (`idmarca`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_reagentes_responsaveis_r1` FOREIGN KEY (`idresponsavel`) REFERENCES `responsavel_r` (`idresponsavel`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reagente`
--

LOCK TABLES `reagente` WRITE;
/*!40000 ALTER TABLE `reagente` DISABLE KEYS */;
INSERT INTO `reagente` VALUES (109,'Ácido Clorídrico','HCl',12,'1000 mL',3,'2021-04-11',2,'2021-04-11',1,'C4',2),(110,'Ácido Clorídrico','HCl',2,'1000 mL',2,'2019-02-11',2,'2021-04-11',1,'C4',2);
/*!40000 ALTER TABLE `reagente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recup_senha`
--

DROP TABLE IF EXISTS `recup_senha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recup_senha` (
  `idrecup_senha` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(10) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `register` varchar(45) DEFAULT NULL,
  `usado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrecup_senha`),
  KEY `fk_usuario_idx` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recup_senha`
--

LOCK TABLES `recup_senha` WRITE;
/*!40000 ALTER TABLE `recup_senha` DISABLE KEYS */;
INSERT INTO `recup_senha` VALUES (7,20,'127.0.0.1','2021-03-14 16:43:51','2021-03-14 17:00:28'),(8,23,'127.0.0.1','2021-04-04 11:32:10','2021-04-04 11:32:53');
/*!40000 ALTER TABLE `recup_senha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsavel_r`
--

DROP TABLE IF EXISTS `responsavel_r`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsavel_r` (
  `idresponsavel` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `responsavel` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idresponsavel`),
  UNIQUE KEY `responsavel_UNIQUE` (`responsavel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel_r`
--

LOCK TABLES `responsavel_r` WRITE;
/*!40000 ALTER TABLE `responsavel_r` DISABLE KEYS */;
INSERT INTO `responsavel_r` VALUES (2,'Cristiano Chiessi'),(1,'Sem Vínculo');
/*!40000 ALTER TABLE `responsavel_r` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(25) NOT NULL,
  `email` varchar(45) NOT NULL,
  `login` varchar(10) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `idlaboratorio` tinyint(3) unsigned NOT NULL,
  `idresponsavel` tinyint(3) NOT NULL,
  `tipo` tinyint(3) unsigned NOT NULL,
  `situacao` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_laboratorios_r1_idx` (`idlaboratorio`),
  KEY `fk_usuario_responsaveis_r1_idx` (`idresponsavel`),
  CONSTRAINT `fk_usuario_laboratorios_r1` FOREIGN KEY (`idlaboratorio`) REFERENCES `laboratorio_r` (`idlaboratorio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (19,'Suporte','Suporte','suporte.inventariorq@gmail.com','suporte','$2y$10$U70zmyRPlpypUuYJ6vsaOuQcetrwZXK6lZFVx2gYgdXnSESd5pQYS',1,1,0,1),(22,'Pedro','Alcântra','rodrigoifusp@yahoo.com.br','palcantra','$2y$10$NEkzu6j9nDNbc.HQqubYYO1IXtNdYqIJsKpnPGiXQuEV6IZu7GqPW',2,1,1,1),(23,'Carlos','Augusto','adeusradar@yahoo.com.br','caugusto','$2y$10$.XbbaQubKUsZQu.7Oz5jfuL2f833Tfn/6WBjsuDxKwPFJNiD3eKwC',2,1,2,1),(25,'Antonio','Silva','rodrigo.lucena09@gmail.com','asilva','$2y$10$6zXTN7hE1xStS8IqldPf4OEPpoi..K4LacEsdoUishvLGP/Fv.lFy',2,1,2,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'inventariorq'
--

--
-- Dumping routines for database 'inventariorq'
--
/*!50003 DROP PROCEDURE IF EXISTS `reagent_save` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`id17156510_rodrigo`@`%` PROCEDURE `reagent_save`(
pnome varchar(30),
pformula varchar(20),
pmarca varchar(30),
pvolume_massa varchar(8),
pquantidade tinyint(3),
pvalidade date,
pcontrole varchar(40),
pcompra date,
plaboratorio varchar(30),
plocalizacao varchar(45),
presponsavel varchar(30)
)
BEGIN
insert into reagente (nome, formula, idmarca, volume_massa, quantidade, validade, idcontrole, compra, idlaboratorio, localizacao, idresponsavel)
values(pnome, 
pformula, 
(SELECT idmarca from marca_r
where marca = pmarca), 
pvolume_massa, 
pquantidade, 
pvalidade, 
(SELECT idcontrole from controle_r
where controle = pcontrole), 
pcompra, 
(SELECT idlaboratorio from laboratorio_r
where laboratorio = plaboratorio), 
plocalizacao, 
(SELECT idresponsavel from responsavel_r
where responsavel = presponsavel));


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `reagent_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`id17156510_rodrigo`@`%` PROCEDURE `reagent_update`(
pidreagente int(11), 
pnome varchar(30),
pformula varchar(20),
pmarca varchar(30),
pvolume_massa varchar(8),
pquantidade tinyint(3),
pvalidade date,
pcontrole varchar(40),
pcompra date,
plaboratorio varchar(30),
plocalizacao varchar(45),
presponsavel varchar(30)
)
BEGIN
update reagente set
nome = pnome, 
formula = pformula, 
idmarca = (SELECT idmarca from marca_r
where marca = pmarca), 
volume_massa = pvolume_massa, 
quantidade = pquantidade, 
validade = pvalidade, 
idcontrole = (SELECT idcontrole from controle_r
where controle = pcontrole), 
compra = pcompra, 
idlaboratorio = (SELECT idlaboratorio from laboratorio_r
where laboratorio = plaboratorio), 
localizacao = plocalizacao, 
idresponsavel = (SELECT idresponsavel from responsavel_r
where responsavel = presponsavel)
where idreagente = pidreagente;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `recup_senha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`id17156510_rodrigo`@`%` PROCEDURE `recup_senha`(
pidusuario INT,
pip varchar(45)
)
BEGIN
insert into recup_senha (idusuario, ip, register)
values(pidusuario, pip, now());
select * from recup_senha where idrecup_senha = last_insert_id();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_save` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`id17156510_rodrigo`@`%` PROCEDURE `user_save`(
pnome varchar(20),
psobrenome varchar(25),
pemail varchar(45),
plogin varchar(10),
psenha varchar(255),
plaboratorio varchar(30),
presponsavel varchar(30)
)
BEGIN
insert into usuario (nome, sobrenome, email, login, senha, idlaboratorio, idresponsavel, tipo, situacao)
values(pnome, 
psobrenome, 
pemail, 
plogin, 
psenha, 
(SELECT idlaboratorio from laboratorio_r
where laboratorio = plaboratorio),  
(SELECT idresponsavel from responsavel_r
where responsavel = presponsavel),
2,
0
);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`id17156510_rodrigo`@`%` PROCEDURE `user_update`(
pidusuario int(10), 
pnome varchar(20),
psobrenome varchar(25),
pemail varchar(45),
plogin varchar(10),
psenha varchar(10),
plaboratorio varchar(30),
presponsavel varchar(30),
ptipo tinyint(3),
psituacao tinyint(3)
)
BEGIN
update usuario set
nome = pnome, 
sobrenome = psobrenome, 
email = pemail, 
login = plogin, 
senha = psenha,  
idlaboratorio = (SELECT idlaboratorio from laboratorio_r
where laboratorio = plaboratorio), 
idresponsavel = (SELECT idresponsavel from responsavel_r
where responsavel = presponsavel),
tipo = ptipo,
situacao = psituacao
where idusuario = pidusuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-02 20:47:43
