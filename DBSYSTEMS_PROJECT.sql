CREATE TABLE EMPLOYEE
(NAME VARCHAR(15) NOT NULL,
EMPLOYEEID INT(9) NOT NULL AUTO_INCREMENT,
ADDRESS VARCHAR(30),
PHONE CHAR(9),
PRIMARY KEY (EMPLOYEEID));

CREATE TABLE HOURLY
(EMPLOYEEID int(9) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (EMPLOYEEID));

CREATE TABLE STORE
(STORENO int(10) NOT NULL AUTO_INCREMENT,
SADDRESS VARCHAR(30),
SPHONE CHAR(9),
PRIMARY KEY (STORENO));

CREATE TABLE FULL_TIME
(EMPLOYEEID int(9) NOT NULL AUTO_INCREMENT,
SALARY INTEGER,
STORENO int(10) NOT NULL,
CONSTRAINT fk_FULLTIMESTORENO
FOREIGN KEY (STORENO) REFERENCES STORE(STORENO)
ON DELETE CASCADE,
CONSTRAINT fk_FULLTIMEEMPLOYEE
FOREIGN KEY (EMPLOYEEID) REFERENCES EMPLOYEE(EMPLOYEEID)
ON DELETE CASCADE);

CREATE TABLE HWORKS
(EMPLOYEEID int(9) NOT NULL AUTO_INCREMENT,
RATE INTEGER,
HOURS INTEGER,
STORENO int(10) NOT NULL,
CONSTRAINT fk_HWORKSSTORENO
FOREIGN KEY (STORENO) REFERENCES STORE(STORENO)
ON DELETE CASCADE,
CONSTRAINT fk_HOURLYEMPLOYEE
FOREIGN KEY (EMPLOYEEID) REFERENCES EMPLOYEE(EMPLOYEEID)
ON DELETE CASCADE);

CREATE TABLE MOVIE
(MOVIEID int(9) NOT NULL AUTO_INCREMENT,
TITLE VARCHAR(15),
DIRECTOR VARCHAR(15),
PRODUCER VARCHAR(15),
ACTOR1 VARCHAR(15),
ACTOR2 VARCHAR(15),
CATEGORY VARCHAR(15),
PRIMARY KEY (MOVIEID));

CREATE TABLE PLAYER
(OBJECTID int(9) NOT NULL AUTO_INCREMENT,
MODEL VARCHAR(15),
BRAND VARCHAR(15),
PLAYERFEATURE VARCHAR(15),
PRIMARY KEY (OBJECTID));

CREATE TABLE STORE_OBJECT
(OBJECTID int(9) NOT NULL AUTO_INCREMENT,
DAILYCHARGE INT,
COPYNO int(9) NOT NULL,
PRIMARY KEY (OBJECTID));

CREATE TABLE COPY
(COPYNO int(9) NOT NULL AUTO_INCREMENT,
TYPE VARCHAR(10),
STAT VARCHAR(10),
MOVIEID int(9) NOT NULL,
PRIMARY KEY (COPYNO),
CONSTRAINT fk_COPYOBJECTID
FOREIGN KEY (MOVIEID)
REFERENCES MOVIE(MOVIEID)
ON DELETE CASCADE);

ALTER TABLE STORE_OBJECT
ADD CONSTRAINT fk_SOCOPY
FOREIGN KEY (COPYNO) REFERENCES COPY(COPYNO);

CREATE TABLE PLAYER_DEVICE
(COPYNO int(9) NOT NULL,
STORENO int(10) NOT NULL,
PRIMARY KEY (COPYNO),
FOREIGN KEY (STORENO)
REFERENCES STORE(STORENO));

CREATE TABLE NO_ASSIGNED
(MOVIEID int(9) NOT NULL,
STORENO int(10) NOT NULL,
NODVD int,
NOBD int,
FOREIGN KEY (MOVIEID)
REFERENCES MOVIE(MOVIEID),
FOREIGN KEY (STORENO)
REFERENCES STORE(STORENO));

CREATE TABLE MEMBER
(MEMBERID int(9) NOT NULL AUTO_INCREMENT,
ADDRESS CHAR(30),
MEMBERNAME CHAR(15),
PASSWORD CHAR(15),
PRIMARY KEY (MEMBERID));

CREATE TABLE INVOICE_TRANSACTION
(TRANSACTION_ID int(9) NOT NULL AUTO_INCREMENT,
STAMP DATETIME,
AMOUNT int,
TYPE int(10),
STORENO int(10) NOT NULL,
COPYNO int(9) NOT NULL,
MEMBERID int(9) NOT NULL,
PRIMARY KEY (TRANSACTION_ID),
FOREIGN KEY (STORENO)
REFERENCES STORE(STORENO),
FOREIGN KEY (COPYNO)
REFERENCES COPY(COPYNO),
FOREIGN KEY (MEMBERID)
REFERENCES MEMBER(MEMBERID));

ALTER TABLE EMPLOYEE
ADD PASSWORD VARCHAR(15);

DROP TABLE HOURLY;
ALTER TABLE PLAYER
CHANGE COLUMN OBJECTID PLAYERID
int(9);

RENAME TABLE STORE_OBJECT to STORE_CHARGE;

/*
Ended up creating a separate fk instead of replacing copyno
*/
ALTER TABLE PLAYER_DEVICE
ADD PLAYERID int(9);


ALTER TABLE PLAYER_DEVICE
ADD CONSTRAINT fk_PLYR_DEVICE_CPY
FOREIGN KEY (PLAYERID) REFERENCES PLAYER(PLAYERID);
