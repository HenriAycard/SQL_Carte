use spot;

drop table IF EXISTS POSCARTE;

drop table IF EXISTS MEMBRE;

drop table IF EXISTS FOLLOWER;
  
drop table IF EXISTS CARTE;

drop table IF EXISTS INFO;

drop table IF EXISTS POSITIONS;
  
drop table IF EXISTS GROUPE;

DROP TABLE IF EXISTS CLIENTS;

create table CLIENTS (
  IDClient INTEGER(10) NOT NULL Primary key auto_increment,
  nom VARCHAR(20) NOT NULL,
  prenom VARCHAR(20) NOT NULL,
  email VARCHAR(30) NOT NULL,
  numTel VARCHAR(15)
);

create table CARTE(
  IDCarte INTEGER(10) NOT NULL Primary key auto_increment,
  IDClient INTEGER(10) NOT NULL,
  nom VARCHAR(30) NOT NULL,
  MDP VARCHAR(20),
  categorie VARCHAR(20),
  TypePartage INT(1) NOT NULL,
  CONSTRAINT keyCC FOREIGN KEY (IDClient) REFERENCES CLIENTS (IDClient) ON DELETE CASCADE
);

create table POSITIONS(
  IDPosition INT(10) NOT NULL Primary key auto_increment,
  Longitude VARCHAR(12) NOT NULL,
  Latitude VARCHAR(12) NOT NULL
);

create table INFO(
  IDInfo INT(10) NOT NULL Primary key auto_increment,
  IDPosition INT(10),
  type VARCHAR(1),
  description VARCHAR(400)
);

create table GROUPE(
  IDGroup INT(10) NOT NULL Primary key auto_increment,
  nom VARCHAR(30)
);

create table POSCARTE(
  IDPosition INT(10), 
  IDCarte INT(10),
  CONSTRAINT keyPP FOREIGN KEY (IDPosition) REFERENCES POSITIONS (IDPosition) ON DELETE CASCADE,
  CONSTRAINT keyPC FOREIGN KEY (IDCarte) REFERENCES CARTE (IDCarte) ON DELETE CASCADE
);

create table MEMBRE(
  IDGroup INT(10),
  IDClient INT(10),
  CONSTRAINT keyMG FOREIGN KEY (IDGroup) REFERENCES GROUPE (IDGroup) ON DELETE CASCADE,
  CONSTRAINT keyMC FOREIGN KEY (IDClient) REFERENCES CLIENTS (IDClient) ON DELETE CASCADE,
  constraint cleM Primary key (IDGroup, IDClient)
);

create table FOLLOWER(
  IDFollower INT(10),
  IDClient INT(10),
  CONSTRAINT keyFF FOREIGN KEY (IDFollower) REFERENCES CLIENTS (IDClient) ON DELETE CASCADE,
  CONSTRAINT keyFC FOREIGN KEY (IDClient) REFERENCES CLIENTS (IDClient) ON DELETE CASCADE
);

show tables;


INSERT INTO CLIENTS VALUES (1, 'Dupont', 'Jean', 'Paris@gmail.com', null);
INSERT INTO CLIENTS VALUES (2, 'Martin', 'Paul', 'Pesfess@gmail.com', '06 06 06 06 06');
INSERT INTO CLIENTS VALUES (3, 'Bob', 'Pierre', 're@gmail.com', '06 06 06 06 06');
INSERT INTO CLIENTS VALUES (4, 'Toto', 'Vine', 'Ps@gmail.com', '06 06 06 06 06');

INSERT INTO CARTE VALUES (1, 1,'Personel', null, null, 1);

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


