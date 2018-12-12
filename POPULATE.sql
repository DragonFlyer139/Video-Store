/*not sure if i mentioned this before, but i'm using mariadb
order of tables to populate:
	store
	employee
	movie
	member
	copy
	player
	invoice_transactions
		typically these are created when we actually have invoices
		but we're going to need an invoice history to test
	no_assigned
	hworks
	full_time
	player_device
	store_charge
	
you insert into tables with:
	insert into table_name (column1, column2, column3, ...)
	values (value1, value2, value3, ...);
	
or with
	insert into table_name
	values (value1, value2, value3, ...);
	
if you want to delete, the code for that is something like:
	delete from table 
	where condition;
*/

insert into store
values ("1", "777 lucky street", "545692459"),
	   ("2", "312 some address", "845692145");
	   
insert into employee
values ("john smith", "1", "547 rando street","654125479","123456"),
	   ("jane doe", "2", "327 crazy street","654125478","123456"),
	   ("ben moskow", "3", "574 ahhh street","648254789","123456"),
	   ("sarah stauber", "4", "764 amazing street","872145698","123456");
	   
	   
/*
list of movies to add to the database
information needed: id, title, director, producer, 
	actor1, actor2, category
batman begins
great gatsby
fight club
titanic
pokemon 2000
wolf of wall street
ted 2
*/

insert into movie
values ("1", "batman begins", "christopher nolan", "emma thomas", "christian bale", "katie holmes", "action"),
	   ("2", "great gatsby", "baz luhrmann", "baz luhrmann", "leonardo dicaprio", "carey mulligan", "romance"),
	   ("3", "fight club", "david fincher", "art linson", "brad pitt", "edward norton", "action"),
	   ("4", "titanic", "james cameron", "james cameron", "leonardo dicaprio", "kate winslet", "romance"),
	   ("5", "pokemon 2000", "kunihiko yuyama", "choji yoshikawa", "ikue otani", "unsho ishizuka", "anime"),
	   ("6", "wolf of wall street", "martin scorsese", "leonardo dicaprio", "leonardo dicaprio", "margot robbie", "comedy");

insert into member
values ("123456", "514 happy address", "ryan zunker","password1"),
	   ("234567", "845 other street", "maggi lopez","maggi123"),
	   ("345678", "215 name of street", "leo carrico","mypassword");
	   
	   
/*
	options for type are: 
		blu-ray
		dvd
	options for status are:
		in-store
		checked out
*/
insert into copy
values ("1", "blu-ray", "in-store", "1"),
	   ("2", "blu-ray", "in-store", "1"),
	   ("3", "dvd", "in-store", "1"),
	   ("4", "dvd", "in-store", "1"),
	   ("5", "blu-ray", "in-store", "2"),
	   ("6", "blu-ray", "in-store", "2"),
	   ("7", "dvd", "in-store", "2"),
	   ("8", "dvd", "in-store", "2"),
	   ("9", "blu-ray", "in-store", "3"),
	   ("10", "blu-ray", "in-store", "3"),
	   ("11", "dvd", "in-store", "3"),
	   ("12", "dvd", "in-store", "3"),
	   ("13", "blu-ray", "in-store", "4"),
	   ("14", "blu-ray", "in-store", "4"),
	   ("15", "dvd", "in-store", "4"),
	   ("16", "dvd", "in-store", "4"),
	   ("17", "blu-ray", "in-store", "5"),
	   ("18", "blu-ray", "in-store", "5"),
	   ("19", "dvd", "in-store", "5"),
	   ("20", "dvd", "in-store", "5"),
	   ("21", "blu-ray", "in-store", "6"),
	   ("22", "blu-ray", "in-store", "6"),
	   ("23", "dvd", "in-store", "6"),
	   ("24", "dvd", "in-store", "6"),
	   ("25", "blu-ray", "in-store", "6"),
	   ("26", "blu-ray", "in-store", "6"),
	   ("27", "dvd", "in-store", "6"),
	   ("28", "dvd", "in-store", "6");
	   
	   
insert into player
values ("1", "dp132", "lg", "multi-format"),
	   ("2", "ubpx1000ex", "sony", "4k ultra hd");

/*
	invoice_transaction
	
	the insert format for datetime looks like this:
	insert into t1 values ("2011-03-11"), ("2012-04-19 13:08:22"),
						  ("2013-07-18 13:44:22.123456");
						  
	types are:
		checkout
		fine
	
	for the amount, i did $1 per day, so $7. 
		i'm not dealing with decimals or change.
*/

insert into invoice_transaction
values ("1", "2018-12-01", 7, "checkout", "1", "3", "123456"),
	   ("2", "2018-12-05", 3, "fine", "1", "3", "123456"),
	   ("3", "2018-12-10", 7, "checkout", "2", "12", "234567");

insert into `hworks` (`employeeid`, `rate`, `hours`, `storeno`) values ('1', '15', '30', '1');
insert into `hworks` (`employeeid`, `rate`, `hours`, `storeno`) values ('2', '15', '30', '2');
insert into `full_time` (`employeeid`, `salary`, `storeno`) values ('3', '12', '1');
insert into `full_time` (`employeeid`, `salary`, `storeno`) values ('4', '15', '2');

insert into `player_device` (`copyno`, `storeno`, `playerid`) values ('1', '1', '1');
insert into `player_device` (`copyno`, `storeno`, `playerid`) values ('2', '2', '2');
insert into `player_device` (`copyno`, `storeno`, `playerid`) values ('3', '2', '1');

insert into `store_charge` (`chargeid`, `dailycharge`, `copyno`) values ('1', '10', '1');
insert into `store_charge` (`chargeid`, `dailycharge`, `copyno`) values ('2', '13', '2');
insert into `store_charge` (`chargeid`, `dailycharge`, `copyno`) values ('3', '15', '3');
