-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: meuvoto
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `chave` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `nivel` int(11) NOT NULL DEFAULT 1,
  `tipo` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `mesa` varchar(25) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'mesa01','mesa01',11,'correspondencia','01'),(2,'mesa02','mesa02',11,'correspondencia','02'),(3,'mesa03','mesa03',11,'correspondencia','03'),(4,'mesa04','mesa04',11,'correspondencia','04'),(5,'mesa05','mesa05',11,'correspondencia','05'),(6,'mesa06','mesa06',11,'correspondencia','06'),(7,'mesa07','mesa07',11,'correspondencia','07'),(8,'mesa08','mesa08',11,'correspondencia','08'),(9,'mesa09','mesa09',11,'correspondencia','09'),(10,'admin','admin',10,'admin','00'),(11,'mesa10','mesa10',11,'correspondencia','10'),(12,'mesa11','mesa11',11,'correspondencia','11'),(13,'mesa12','mesa12',11,'correspondencia','12'),(14,'mesa13','mesa13',11,'correspondencia','13'),(15,'mesa14','mesa14',11,'correspondencia','14'),(16,'mesa15','mesa15',11,'correspondencia','15'),(17,'mesa16','mesa16',11,'correspondencia','16'),(18,'mesa17','mesa17',11,'correspondencia','17'),(19,'mesa18','mesa18',11,'correspondencia','18');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arquivos_csv`
--

DROP TABLE IF EXISTS `arquivos_csv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arquivos_csv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `data` date NOT NULL,
  `descricao` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivos_csv`
--

LOCK TABLES `arquivos_csv` WRITE;
/*!40000 ALTER TABLE `arquivos_csv` DISABLE KEYS */;
/*!40000 ALTER TABLE `arquivos_csv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ata_computo_gerada`
--

DROP TABLE IF EXISTS `ata_computo_gerada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ata_computo_gerada` (
  `id` int(25) NOT NULL,
  `id_ata_computo` int(25) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `data_hora` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ata_computo_gerada`
--

LOCK TABLES `ata_computo_gerada` WRITE;
/*!40000 ALTER TABLE `ata_computo_gerada` DISABLE KEYS */;
/*!40000 ALTER TABLE `ata_computo_gerada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ata_computo_geral`
--

DROP TABLE IF EXISTS `ata_computo_geral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ata_computo_geral` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `municipio` varchar(55) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `data` datetime NOT NULL,
  `crefito` varchar(50) DEFAULT NULL,
  `quadrienio_n1` varchar(4) DEFAULT NULL,
  `quadrienio_n2` varchar(4) DEFAULT NULL,
  `qtd_urnas` int(3) DEFAULT 0,
  `id_chapaeleita` int(25) NOT NULL DEFAULT 0,
  `data_hora_fim` time NOT NULL DEFAULT '10:00:00',
  `crefitod` int(15) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ata_computo_geral`
--

LOCK TABLES `ata_computo_geral` WRITE;
/*!40000 ALTER TABLE `ata_computo_geral` DISABLE KEYS */;
/*!40000 ALTER TABLE `ata_computo_geral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `arquivo` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `arquivo_sql` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin2;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapas`
--

DROP TABLE IF EXISTS `chapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapas` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `numero` varchar(2) NOT NULL DEFAULT '0',
  `descricao` varchar(255) NOT NULL,
  `adv_nome` varchar(255) NOT NULL,
  `adv_inscricao` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapas`
--

LOCK TABLES `chapas` WRITE;
/*!40000 ALTER TABLE `chapas` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chapas_membros`
--

DROP TABLE IF EXISTS `chapas_membros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chapas_membros` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_chapa` int(25) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `crefito` varchar(15) NOT NULL,
  `rep` int(1) NOT NULL DEFAULT 0,
  `ord` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chapas_membros`
--

LOCK TABLES `chapas_membros` WRITE;
/*!40000 ALTER TABLE `chapas_membros` DISABLE KEYS */;
/*!40000 ALTER TABLE `chapas_membros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comissao_eleitoral`
--

DROP TABLE IF EXISTS `comissao_eleitoral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comissao_eleitoral` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `funcao` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comissao_eleitoral`
--

LOCK TABLES `comissao_eleitoral` WRITE;
/*!40000 ALTER TABLE `comissao_eleitoral` DISABLE KEYS */;
/*!40000 ALTER TABLE `comissao_eleitoral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computo_mesas`
--

DROP TABLE IF EXISTS `computo_mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computo_mesas` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_admin` int(25) NOT NULL,
  `id_voto_tipo` int(25) NOT NULL,
  `qtd_voto` int(25) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computo_mesas`
--

LOCK TABLES `computo_mesas` WRITE;
/*!40000 ALTER TABLE `computo_mesas` DISABLE KEYS */;
/*!40000 ALTER TABLE `computo_mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `computo_mesas_chapas`
--

DROP TABLE IF EXISTS `computo_mesas_chapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `computo_mesas_chapas` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `id_admin` int(25) NOT NULL,
  `id_chapa` int(25) NOT NULL,
  `qtd_voto` int(25) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `computo_mesas_chapas`
--

LOCK TABLES `computo_mesas_chapas` WRITE;
/*!40000 ALTER TABLE `computo_mesas_chapas` DISABLE KEYS */;
/*!40000 ALTER TABLE `computo_mesas_chapas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `acao` text NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69575 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissionais`
--

DROP TABLE IF EXISTS `profissionais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profissionais` (
  `id_inscricao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `crefito` varchar(155) DEFAULT NULL,
  `votou` varchar(3) DEFAULT NULL,
  `forma` varchar(25) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT 0,
  `data_horario` datetime NOT NULL DEFAULT current_timestamp(),
  `endereco` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_inscricao`)
) ENGINE=MyISAM AUTO_INCREMENT=325821 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissionais`
--

LOCK TABLES `profissionais` WRITE;
/*!40000 ALTER TABLE `profissionais` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissionais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissionais_enderecos`
--

DROP TABLE IF EXISTS `profissionais_enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profissionais_enderecos` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `crefito` varchar(25) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `CEP` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2764 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissionais_enderecos`
--

LOCK TABLES `profissionais_enderecos` WRITE;
/*!40000 ALTER TABLE `profissionais_enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissionais_enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voto_tipo`
--

DROP TABLE IF EXISTS `voto_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voto_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `id_chapa` int(25) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voto_tipo`
--

LOCK TABLES `voto_tipo` WRITE;
/*!40000 ALTER TABLE `voto_tipo` DISABLE KEYS */;
INSERT INTO `voto_tipo` VALUES (1,'Branco',0),(2,'Nulo',0);
/*!40000 ALTER TABLE `voto_tipo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-04 20:24:32
