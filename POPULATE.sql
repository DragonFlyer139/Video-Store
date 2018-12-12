/*Not sure if I mentioned this before, but I'm using MariaDB
Order of tables to populate:
	STORE
	EMPLOYEE
	MOVIE
	MEMBER
	COPY
	PLAYER
	INVOICE_TRANSACTIONS
		Typically these are created when we actually have invoices
		But we're going to need an invoice history to test
	NO_ASSIGNED
	HWORKS
	FULL_TIME
	PLAYER_DEVICE
	STORE_CHARGE
	
You insert into tables with:
	INSERT INTO table_name (column1, column2, column3, ...)
	VALUES (value1, value2, value3, ...);
	
or with
	INSERT INTO table_name
	VALUES (value1, value2, value3, ...);
	
If you want to delete, the code for that is something like:
	DELETE FROM table 
	WHERE condition;
*/

INSERT INTO STORE
VALUES ("1", "777 Lucky Street", "545692459"),
	   ("2", "312 Some Address", "845692145");
	   
INSERT INTO EMPLOYEE
VALUES ("John Smith", "1", "547 Rando Street","654125479","123456"),
	   ("Jane Doe", "2", "327 Crazy Street","654125478","123456"),
	   ("Ben Moskow", "3", "574 Ahhh Street","648254789","123456"),
	   ("Sarah Stauber", "4", "764 Amazing Street","872145698","123456");
	   
	   
/*
List of Movies to add to the DATABASE
Information needed: ID, Title, Director, Producer, 
	Actor1, Actor2, Category
Batman Begins
Great Gatsby
Fight Club
Titanic
Pokemon 2000
Wolf of Wall Street
Ted 2
*/

INSERT INTO MOVIE
VALUES ("1", "Batman Begins", "Christopher Nolan", "Emma Thomas", "Christian Bale", "Katie Holmes", "Action"),
	   ("2", "Great Gatsby", "Baz Luhrmann", "Baz Luhrmann", "Leonardo DiCaprio", "Carey Mulligan", "Romance"),
	   ("3", "Fight Club", "David Fincher", "Art Linson", "Brad Pitt", "Edward Norton", "Action"),
	   ("4", "Titanic", "James Cameron", "James Cameron", "Leonardo DiCaprio", "Kate Winslet", "Romance"),
	   ("5", "Pokemon 2000", "Kunihiko Yuyama", "Choji Yoshikawa", "Ikue Otani", "Unsho Ishizuka", "Anime"),
	   ("6", "Wolf of Wall Street", "Martin Scorsese", "Leonardo DiCaprio", "Leonardo DiCaprio", "Margot Robbie", "Comedy");

INSERT INTO MEMBER
VALUES ("123456", "514 Happy Address", "Ryan Zunker"),
	   ("234567", "845 Other Street", "Maggi Lopez"),
	   ("345678", "215 Name of Street", "Leo Carrico");
	   
	   
/*
	options for type are: 
		Blu-ray
		DVD
	options for status are:
		In-Store
		Checked Out
*/
INSERT INTO COPY
VALUES ("1", "Blu-ray", "In-Store", "1"),
	   ("2", "Blu-ray", "In-Store", "1"),
	   ("3", "DVD", "In-Store", "1"),
	   ("4", "DVD", "In-Store", "1"),
	   ("5", "Blu-ray", "In-Store", "2"),
	   ("6", "Blu-ray", "In-Store", "2"),
	   ("7", "DVD", "In-Store", "2"),
	   ("8", "DVD", "In-Store", "2"),
	   ("9", "Blu-ray", "In-Store", "3"),
	   ("10", "Blu-ray", "In-Store", "3"),
	   ("11", "DVD", "In-Store", "3"),
	   ("12", "DVD", "In-Store", "3"),
	   ("13", "Blu-ray", "In-Store", "4"),
	   ("14", "Blu-ray", "In-Store", "4"),
	   ("15", "DVD", "In-Store", "4"),
	   ("16", "DVD", "In-Store", "4"),
	   ("17", "Blu-ray", "In-Store", "5"),
	   ("18", "Blu-ray", "In-Store", "5"),
	   ("19", "DVD", "In-Store", "5"),
	   ("20", "DVD", "In-Store", "5"),
	   ("21", "Blu-ray", "In-Store", "6"),
	   ("22", "Blu-ray", "In-Store", "6"),
	   ("23", "DVD", "In-Store", "6"),
	   ("24", "DVD", "In-Store", "6"),
	   ("25", "Blu-ray", "In-Store", "6"),
	   ("26", "Blu-ray", "In-Store", "6"),
	   ("27", "DVD", "In-Store", "6"),
	   ("28", "DVD", "In-Store", "6");
	   
	   
INSERT INTO PLAYER
VALUES ("1", "DP132", "LG", "Multi-Format"),
	   ("2", "UBPX1000EX", "Sony", "4K Ultra HD");

/*
	Invoice_transaction
	
	The insert format for datetime looks like this:
	INSERT INTO t1 VALUES ("2011-03-11"), ("2012-04-19 13:08:22"),
						  ("2013-07-18 13:44:22.123456");
						  
	Types are:
		Checkout
		Fine
	
	For the amount, I did $1 per day, so $7. 
		I'm not dealing with decimals or change.
*/

INSERT INTO INVOICE_TRANSACTION
VALUES ("1", "2018-12-01", 7, "Checkout", "1", "3", "123456"),
	   ("2", "2018-12-05", 3, "Fine", "1", "3", "123456"),
	   ("3", "2018-12-10", 7, "Checkout", "2", "12", "234567");

INSERT INTO `HWORKS` (`EMPLOYEEID`, `RATE`, `HOURS`, `STORENO`) VALUES ('1', '15', '30', '1');
INSERT INTO `HWORKS` (`EMPLOYEEID`, `RATE`, `HOURS`, `STORENO`) VALUES ('2', '15', '30', '2');
INSERT INTO `FULL_TIME` (`EMPLOYEEID`, `SALARY`, `STORENO`) VALUES ('3', '12', '1');
INSERT INTO `FULL_TIME` (`EMPLOYEEID`, `SALARY`, `STORENO`) VALUES ('4', '15', '2');

INSERT INTO `PLAYER_DEVICE` (`COPYNO`, `STORENO`, `PLAYERID`) VALUES ('1', '1', '1');
INSERT INTO `PLAYER_DEVICE` (`COPYNO`, `STORENO`, `PLAYERID`) VALUES ('2', '2', '2');
INSERT INTO `PLAYER_DEVICE` (`COPYNO`, `STORENO`, `PLAYERID`) VALUES ('3', '2', '1');

INSERT INTO `STORE_CHARGE` (`CHARGEID`, `DAILYCHARGE`, `COPYNO`) VALUES ('1', '10', '1');
INSERT INTO `STORE_CHARGE` (`CHARGEID`, `DAILYCHARGE`, `COPYNO`) VALUES ('2', '13', '2');
INSERT INTO `STORE_CHARGE` (`CHARGEID`, `DAILYCHARGE`, `COPYNO`) VALUES ('3', '15', '3');
