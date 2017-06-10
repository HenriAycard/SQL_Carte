/*PREMIERE PARTI       /!\ CLEF NON PARTAGER*/
create table CLIENTS (
  IDClient NUMBER(10),
  nom VARCHAR2(20) NOT NULL,
  prenom VARCHAR2(20) NOT NULL,
  email VARCHAR2(30) NOT NULL,
  numTel VARCHAR2(15),
  constraint cleClient Primary key (IDClient));

create table CARTE(
  IDCarte NUMBER(10),
  IDClient NUMBER(10),
  nom VARCHAR2(30) NOT NULL,
  MDP VARCHAR2(20),
  categorie VARCHAR2(20),
  TypePartage VARCHAR2(1),
  constraint cleCarte Primary key (IDCarte),
  CONSTRAINT keyCC FOREIGN KEY (IDClient) REFERENCES CLIENTS);
  
create table POSITIONS(
  IDPosition NUMBER(10),
  Longitude VARCHAR2(12) NOT NULL,
  Latitude VARCHAR2(12) NOT NULL,
  constraint clePosition Primary key (IDPosition));

create table INFO(
  IDInfo NUMBER(10),
  IDPosition NUMBER(10),
  type VARCHAR2(1),
  description VARCHAR2(400),
  constraint cleInfo Primary key (IDInfo));
  
create table GROUPE(
  IDGroup NUMBER(10),
  nom VARCHAR2(30),
  constraint cleGroup Primary key (IDGroup));

/* DEUXIEME PARTIE      /!\ CLEF NON PARTAGER*/
create table POSCARTE(
  IDPosition NUMBER(10), 
  IDCarte NUMBER(10),
  CONSTRAINT keyPP FOREIGN KEY (IDPosition) REFERENCES POSITIONS,
  CONSTRAINT keyPC FOREIGN KEY (IDCarte) REFERENCES CARTE);

create table MEMBRE(
  IDGroup NUMBER(10),
  IDClient NUMBER(10),
  CONSTRAINT keyMG FOREIGN KEY (IDGroup) REFERENCES GROUPE,
  CONSTRAINT keyMC FOREIGN KEY (IDClient) REFERENCES CLIENTS,
  constraint cleM Primary key (IDGroup, IDClient));
  
create table FOLLOWER(
  IDFollower NUMBER(10),
  IDClient NUMBER(10),
  CONSTRAINT keyFF FOREIGN KEY (IDFollower) REFERENCES CLIENTS,
  CONSTRAINT keyFC FOREIGN KEY (IDClient) REFERENCES CLIENTS);






INSERT INTO CLIENTS VALUES (1, 'Dupont', 'Jean', 'Paris@gmail.com', null);
INSERT INTO CLIENTS VALUES (2, 'Martin', 'Paul', 'Pesfess@gmail.com', '06 06 06 06 06');
INSERT INTO CLIENTS VALUES (3, 'Bob', 'Pierre', 're@gmail.com', '06 06 06 06 06');
INSERT INTO CLIENTS VALUES (4, 'Toto', 'Vine', 'Ps@gmail.com', '06 06 06 06 06');

INSERT INTO CARTE VALUES (1, 1,'Personel', null, null, 'A');

INSERT INTO POSITIONS VALUES (1, 100, 200);
INSERT INTO POSITIONS VALUES (2, 30, 2220);
INSERT INTO POSITIONS VALUES (3, 11230, 9800);

INSERT INTO POSCARTE VALUES (1,1);
INSERT INTO POSCARTE VALUES (2,1);
INSERT INTO POSCARTE VALUES (3,1);

INSERT INTO INFO VALUES (1, 1, 'T','Tres beau monument'); 
INSERT INTO INFO VALUES (2, 1, 'I','Image.jpeg'); 

INSERT INTO FOLLOWER VALUES (2, 1);
INSERT INTO FOLLOWER VALUES (3, 1);
INSERT INTO FOLLOWER VALUES (4, 2);

SELECT *
FROM CLIENTS;

SELECT *
FROM CARTE;

SELECT *
FROM CARTE CA, CLIENTS CL, POSITIONS P, POSCARTE PC
WHERE CA.IDClient=CL.IDClient
AND PC.IDCarte = CA.IDCarte
AND PC.IDPosition = P.IDPosition;

/*Toutes les cartes et les information associer*/
SELECT *
FROM CARTE CA, CLIENTS CL, POSITIONS P, POSCARTE PC, INFO I
WHERE CA.IDClient=CL.IDClient
AND PC.IDCarte = CA.IDCarte
AND PC.IDPosition = P.IDPosition
AND I.IDPosition = P.IDPosition;    

/*Donne tout les follower d'un client donné*/
SELECT C2.Nom, C2.Prenom
FROM CLIENTS C, FOLLOWER F, CLIENTS C2
WHERE F.IDClient = C.IDClient
AND F.IDFollower = C2.IDClient
AND F.IDClient = 2;
/*Donne tout les follower de tout les client (n, p follow n, p)*/
SELECT C2.Nom, C2.Prenom, C.Nom, C.Prenom
FROM CLIENTS C, FOLLOWER F, CLIENTS C2
WHERE F.IDClient = C.IDClient
AND F.IDFollower = C2.IDClient;

/*
INSERT INTO Buveur VALUES (4, 'Durand', 'Pierrette', 'Rouen');
INSERT INTO Buveur VALUES (5, 'Le Bihan', 'Yves', 'Brest');
INSERT INTO Buveur VALUES (6, 'Martini', 'Marius', 'MArseille');
INSERT INTO Buveur VALUES (7, 'Moreau', 'Jean-Pierre', 'Lyon');
INSERT INTO Buveur VALUES (8, 'Van Donck', 'Pierre', 'Lille');

*/
/*

drop table POSCARTE;

drop table MEMBRE;

drop table FOLLOWER;

drop table CLIENTS;
  
drop table CARTE;

drop table POSITIONS;

drop table INFO;
  
drop table GROUPE;

INSERT INTO Viticulteur Values (1,'Tarroux', 'Philippe', 'Béziers');
INSERT INTO Viticulteur Values (2,'Maillard', 'Catherine', 'Bordeaux');
INSERT INTO Viticulteur Values (3,'Rallègue', 'Didier', 'Arbois');
INSERT INTO Viticulteur Values (4,'Bollinger', 'Charles', 'Reims');
INSERT INTO Viticulteur Values (5,'Bréchard', 'Maurice', 'Chiroubles');
INSERT INTO Viticulteur Values (6,'Macaze', 'Philippe', 'Léognan');
INSERT INTO Viticulteur Values (7,'Cliquot', 'Julie', 'Reims');

INSERT INTO Vin values(1,'Côtes du Jura',2004, 'Jura', 3);
INSERT INTO Vin values(2,'Château Maillard',2002, 'Bordeaux', 2);
INSERT INTO Vin values(3,'Château Lafourche ',2005, 'Médoc', 2);
INSERT INTO Vin values(4,'Vin Jaune',2003, 'Jura', 3);
INSERT INTO Vin values(5,'Minervois',2008, 'Languedoc', 1);
INSERT INTO Vin values(6,'Limoux',2007, 'Languedoc', 1);
INSERT INTO Vin values(9,'Veuve Cliquot',2013, 'Champagne', 7);
INSERT INTO Vin values(7,'Dom Perignon',2008, 'Champagne', 7);
INSERT INTO Vin values(8,'Châblis',2002, 'Bourgogne', 5);

INSERT INTO Commande Values (1, 2, 3, '04/02/16', 5);
INSERT INTO Commande Values (2, 1, 4, '05/02/16', 10); 
INSERT INTO Commande Values (3, 5, 9, '20/01/16', 12); 
INSERT INTO Commande Values (4, 8, 2, '04/01/16', 15); 
INSERT INTO Commande Values (5, 3, 1, '08/01/16', 6); 
INSERT INTO Commande Values (6, 4, 3, '22/12/15', 8); 
INSERT INTO Commande Values (7, 8, 6, '23/12/15', 24); 
INSERT INTO Commande Values (8, 1, 4, '04/12/15', 30); 
INSERT INTO Commande Values (9, 2, 9, '06/12/15', 15); 
INSERT INTO Commande Values (10, 6, 8, '10/12/15', 20); 
INSERT INTO Commande Values (11, 7, 6, '04/11/15', 12); 
INSERT INTO Commande Values (12, 3, 7, '14/11/15', 20); 
INSERT INTO Commande Values (13, 5, 9, '21/11/15', 6); 
INSERT INTO Commande Values (14, 8, 1, '03/02/16', 12); 
INSERT INTO Commande Values (15, 2, 3, '04/02/16', 18); 

INSERT INTO Livraison VALUES (2, '25/2/2016', 6);
INSERT INTO Livraison VALUES (2, '10/2/2016', 4);
INSERT INTO Livraison VALUES (9, '10/12/2015', 10);
INSERT INTO Livraison VALUES (9, '16/12/2015', 5);
INSERT INTO Livraison VALUES (14, '8/2/2016', 12);
INSERT INTO Livraison VALUES (15, '8/2/2016', 10);
INSERT INTO Livraison VALUES (15, '15/2/2016', 8);
INSERT INTO Livraison VALUES (10, '19/12/2015', 20);
INSERT INTO Livraison VALUES (1, '25/2/2016', 5);
INSERT INTO Livraison VALUES (6, '28/12/2015', 8);
INSERT INTO Livraison VALUES (7, '29/12/2015', 12);
INSERT INTO Livraison VALUES (7, '10/1/2016', 12);
*/