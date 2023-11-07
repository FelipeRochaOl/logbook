-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.7.44

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Desenvolvimento'),(8,'Metodologia'),(9,'Qualidade'),(10,'Gerenciamento'),(11,'DocumentaÃ§Ã£o');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `date_publication` date NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_FK` (`category_id`),
  CONSTRAINT `posts_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (7,'Iniciando o Projeto: Escolhendo a Ideia de Jogo Perfeita',10,'2023-07-01','Neste post, vou compartilhar como nossa equipe comeÃ§ou o projeto de criaÃ§Ã£o de um jogo em JavaScript. Exploramos o processo de escolha da ideia perfeita para o jogo, destacando os critÃ©rios que consideramos. Discutirei a importÃ¢ncia de escolher um conceito que fosse desafiador, mas alcanÃ§Ã¡vel dentro do tempo do projeto. TambÃ©m abordarei como a ideia escolhida se alinhou com nossas habilidades e interesses como equipe.','002-computacao-em-nuvem.png'),(8,'Desenvolvimento do Jogo em JavaScript: LiÃ§Ãµes Aprendidas',1,'2023-07-05','Neste post, vou compartilhar as liÃ§Ãµes que aprendemos durante o desenvolvimento do jogo em JavaScript. Discutirei os desafios tÃ©cnicos que enfrentamos, como a programaÃ§Ã£o de mecÃ¢nicas de jogo, grÃ¡ficos e resoluÃ§Ã£o de bugs. TambÃ©m destacarei as soluÃ§Ãµes que encontramos para superar esses desafios, incluindo o uso de bibliotecas e a colaboraÃ§Ã£o eficaz da equipe.','008-sucesso.png'),(9,'MÃ©todos Ãgeis no Desenvolvimento de Jogos: Uma ExperiÃªncia PrÃ¡tica',8,'2023-07-12','Neste post, explorarei como aplicamos os mÃ©todos Ã¡geis, como sprints, reuniÃµes diÃ¡rias e adaptaÃ§Ã£o a mudanÃ§as, ao desenvolvimento do jogo. Mostrarei como a metodologia Agile nos permitiu ser flexÃ­veis, acompanhar o progresso e ajustar nosso plano Ã  medida que avanÃ§Ã¡vamos no projeto.','008-sucesso.png'),(10,'Testando e Depurando: Garantindo a Qualidade do Jogo em JavaScript',9,'2023-07-21','Este post abordarÃ¡ os processos de teste e depuraÃ§Ã£o que utilizamos para garantir a qualidade do nosso jogo em JavaScript. Vou discutir a importÃ¢ncia de testar o jogo em diferentes cenÃ¡rios e dispositivos, alÃ©m de como identificamos e corrigimos os bugs que surgiram durante o desenvolvimento.','008-sucesso.png'),(11,'Gerenciamento de Tempo Eficiente para Estudantes de Sistemas de InformaÃ§Ã£o',10,'2023-08-10','Neste post, compartilharei dicas prÃ¡ticas sobre como equilibrar o tempo entre os compromissos acadÃªmicos, o projeto do jogo e outras responsabilidades. Vou abordar estratÃ©gias de gerenciamento de tempo que ajudaram nossa equipe a cumprir os prazos e manter um equilÃ­brio saudÃ¡vel entre estudo e desenvolvimento do projeto.','008-sucesso.png'),(12,'Aprenda JavaScript para Desenvolvimento de Jogos: Recursos Essenciais',1,'2023-08-22','Este post apresentarÃ¡ uma lista de recursos essenciais para estudantes que desejam aprender JavaScript para desenvolvimento de jogos. Incluirei tutoriais, livros, cursos online e ferramentas Ãºteis que nos ajudaram a adquirir as habilidades necessÃ¡rias para o projeto.','008-sucesso.png'),(13,'Design de Jogos: Elementos Chave para uma ExperiÃªncia de Jogo Cativante',1,'2023-08-29','Neste post, explorarei os elementos de design de jogos que utilizamos para criar uma experiÃªncia de jogo cativante. Abordarei tÃ³picos como a narrativa do jogo, a jogabilidade, a estÃ©tica e a interaÃ§Ã£o do jogador, destacando como esses elementos influenciaram a experiÃªncia do usuÃ¡rio.','008-sucesso.png'),(14,'A ImportÃ¢ncia da DocumentaÃ§Ã£o TÃ©cnica em Projetos de Desenvolvimento de Jogos',11,'2023-09-05','Este post destacarÃ¡ a importÃ¢ncia da documentaÃ§Ã£o tÃ©cnica em projetos de desenvolvimento de jogos. Discutirei como manter registros detalhados e documentaÃ§Ã£o adequada facilitou o desenvolvimento e a manutenÃ§Ã£o do nosso jogo em JavaScript.','008-sucesso.png'),(15,'O Dia da Entrega: LiÃ§Ãµes Aprendidas e CelebraÃ§Ã£o do Sucesso',10,'2023-09-20','Neste post, compartilharei nossa experiÃªncia no dia da entrega do projeto. Discutirei as emoÃ§Ãµes, os desafios e as liÃ§Ãµes aprendidas ao final do projeto. TambÃ©m celebraremos o sucesso da equipe e as conquistas alcanÃ§adas.','008-sucesso.png'),(16,'Compartilhando Nosso Jogo JavaScript com o Mundo: PublicaÃ§Ã£o e Feedback',1,'2023-09-20','Este post falarÃ¡ sobre como publicamos nosso jogo JavaScript e os desafios que enfrentamos nesse processo. AlÃ©m disso, discutirei a recepÃ§Ã£o inicial do jogo e o feedback valioso que recebemos dos jogadores, e como estamos usando isso para melhorar o jogo.','008-sucesso.png');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(180) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(180) DEFAULT 'avatar.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Felipe Rocha','admin@admin.com.br','d0282dca69649e903cc660c4ef33a72cdbdf01b1c1f5de3a686fd8d66960128e','avatar.png'),(5,'Professor','fiap@fiap.com','f24ac00bb83ff6eb08221a25af0554c97c01889ed4d196c7655dbe1a762fde48','test.jpeg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-07  4:20:42
