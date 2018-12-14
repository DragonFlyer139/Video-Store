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

insert into store(saddress,sphone)
values ("777 Lucky Street", "545692459"),
	   ("312 Some Address", "845692145");
	   
insert into employee(name,address,phone,password)
values ("John Smith", "547 Rando Street","654125479","123456"),
	   ("Jane Doe", "327 Crazy Street","654125478","123456"),
	   ("Ben Moskow", "574 Ahhh Street","648254789","123456"),
	   ("Sarah Stauber", "764 Amazing Street","872145698","123456");
	   
	   
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

insert into movie(title,director,producer,actor1,actor2,category)
values ("Batman Begins", "Christopher Nolan", "Emma Thomas", "Christian Bale", "Katie Holmes", "action"),
	   ("The Great Gatsby", "Baz Luhrmann", "Baz Luhrmann", "Leonardo DiCaprio", "Carey Mulligan", "romance"),
	   ("Fight Club", "David Fincher", "Art Linson", "Brad Pitt", "Edward Norton", "action"),
	   ("Titanic", "James Cameron", "James Cameron", "Leonardo DiCaprio", "Kate Winslet", "romance"),
	   ("Pokemon 2000", "Kunihiko Yuyama", "Choji Yoshikawa", "Ikue Otani", "Unsho Ishizuka", "anime"),
	   ("The Wolf of Wall Street", "Martin Scorsese", "Leonardo DiCaprio", "Leonardo DiCaprio", "Margot Robbie", "comedy"),
	   ("Avatar", "James Cameron", "James Cameron", "Sam Worthington", "Zoe Saldana", "action"),
	   ("Phantom of the Opera", "Joel Schumacher", "Andrew Lloyd Webber", "Gerard Butler", "Emmy Rossum", "musical"),
	   ("Bee Movie", "Simon J. Smith", "Jerry Seinfeld", "Jerry Seinfeld", "Renée Zellweger", "comedy"),
	   ("Venom", "Ruben Fleischer", "Avi Arad", "Tom Hardy", "Michelle Williams", "action"),
	   ("Pokemon: Detective Pikachu", "Rob Letterman", "Mary Parent", "Ryan Reynolds", "Justice Smith", "comedy"),
	   ("Bringing Up Baby", "Howard Hawks", "Cliff Reid", "Katharine Hepburn", "Cary Grant", "comedy");

insert into member(memberid,address,membername,password)
values ("123456", "514 Happy Address", "Ryan Zunker","password1"),
	   ("234567", "845 Other Street", "Maggi Lopez","maggi123"),
	   ("345678", "215 Name Of Street", "Leo Carrico","mypassword"),
	   ("456789", "212 1st Avenue", "Emma Juettner","pass1"),
	   ("321654", "2151 Street Street", "Sally Juettner","primary"),
	   ("654321", "123 Apple Road", "Ana Sabaj","p123"),
	   ("346578", "333 Three Street", "Anna Fifhause","pw123"),
	   ("101010", "345 A Road", "Jaime Harris","mypassword"),
	   ("111111", "555 Sheridan Rd", "Bonnie Juettner","bonnie"),
	   ("222222", "321 Campus Rd", "J.P. Fernandes","jpf"),
	   ("999999", "345 Out of Ideas Road", "Human Being","pass1234");

	   
	   
/*
	options for type are: 
		blu-ray
		dvd
	options for status are:
		in-store
		checked out
*/
insert into copy(type,stat,movieid)
values ("blu-ray", "in-store", "1"),
	   ("blu-ray", "in-store", "1"),
	   ("dvd", "in-store", "1"),
	   ("dvd", "in-store", "1"),
	   ("blu-ray", "in-store", "2"),
	   ("blu-ray", "in-store", "2"),
	   ("dvd", "in-store", "2"),
	   ("dvd", "in-store", "2"),
	   ("blu-ray", "in-store", "3"),
	   ("blu-ray", "in-store", "3"),
	   ("dvd", "in-store", "3"),
	   ("dvd", "in-store", "3"),
	   ("blu-ray", "in-store", "4"),
	   ("blu-ray", "in-store", "4"),
	   ("dvd", "in-store", "4"),
	   ("dvd", "in-store", "4"),
	   ("blu-ray", "in-store", "5"),
	   ("blu-ray", "in-store", "5"),
	   ("dvd", "in-store", "5"),
	   ("dvd", "in-store", "5"),
	   ("blu-ray", "in-store", "6"),
	   ("blu-ray", "in-store", "6"),
	   ("dvd", "in-store", "6"),
	   ("dvd", "in-store", "6"),
	   ("blu-ray", "in-store", "6"),
	   ("blu-ray", "in-store", "6"),
	   ("dvd", "in-store", "6"),
	   ("dvd", "in-store", "6"),
	   ("blu-ray", "in-store", "1"),
	   ("blu-ray", "in-store", "1"),
	   ("dvd", "in-store", "1"),
	   ("dvd", "in-store", "1"),
	   ("blu-ray", "in-store", "11"),
	   ("blu-ray", "in-store", "11"),
	   ("dvd", "in-store", "2"),
	   ("dvd", "in-store", "10"),
	   ("blu-ray", "in-store", "9"),
	   ("blu-ray", "in-store", "12"),
	   ("dvd", "in-store", "11"),
	   ("dvd", "in-store", "10"),
	   ("blu-ray", "in-store", "9"),
	   ("blu-ray", "in-store", "8"),
	   ("dvd", "in-store", "7"),
	   ("dvd", "in-store", "6"),
	   ("blu-ray", "in-store", "7"),
	   ("blu-ray", "in-store", "7"),
	   ("dvd", "in-store", "7"),
	   ("dvd", "in-store", "7"),
	   ("blu-ray", "in-store", "8"),
	   ("blu-ray", "in-store", "9"),
	   ("dvd", "in-store", "10"),
	   ("dvd", "in-store", "10"),
	   ("blu-ray", "in-store", "11"),
	   ("blu-ray", "in-store", "11"),
	   ("dvd", "in-store", "12"),
	   ("dvd", "in-store", "12");
	   
	   
insert into player(model,brand,playerfeature)
values ("dp132", "LG", "multi-format"),
	   ("ubpx1000ex", "Sony", "4k ultra hd");

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

insert into invoice_transaction(stamp,amount,type,storeno,copyno,memberid)
values ("2018-12-01 00:00:00", 7, "checkout", "1", "1", "123456"),
	   ("2018-12-11 00:00:00", 0, "return", "1", "6", "123456"),
	   ("2018-12-11 00:00:00", 1.75, "fine", "1", "12", "123456"),
	   ("2018-12-10 00:00:00", 7, "checkout", "2", "16", "234567"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "18", "345678"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "44", "234567"),
	   ("2018-12-12 00:00:00", 0, "return", "1", "45", "234567"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "49", "345678"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "37", "456789"),
	   ("2018-12-13 00:00:00", 7, "checkout", "2", "36", "234567"),
	   ("2018-12-13 00:00:00", 7, "checkout", "2", "52", "111111"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "53", "456789"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "38", "111111"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "55", "234567"),
	   ("2018-12-09 00:00:00", 7, "checkout", "1", "54", "346578"),
	   ("2018-12-08 00:00:00", 7, "checkout", "1", "52", "321654"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "51", "321654"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "1", "101010"),
	   ("2018-12-13 00:00:00", 7, "checkout", "2", "3", "234567"),
	   ("2018-12-13 00:00:00", 7, "checkout", "2", "5", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "7", "101010"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "9", "999999"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "11", "999999"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "12", "234567"),
	   ("2018-12-09 00:00:00", 7, "checkout", "1", "13", "222222"),
	   ("2018-12-09 00:00:00", 7, "checkout", "2", "13", "222222"),
	   ("2018-12-08 00:00:00", 7, "checkout", "2", "11", "346578"),
	   ("2018-12-11 00:00:00", 1.75, "fine", "1", "16", "654321"),
	   ("2018-12-11 00:00:00", 1.75, "fine", "2", "17", "654321"),	   
	   ("2018-12-08 00:00:00", 7, "checkout", "1", "52", "321654"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "51", "321654"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "1", "101010"),
	   ("2018-12-13 00:00:00", 7, "checkout", "1", "3", "234567"),
	   ("2018-12-13 00:00:00", 7, "checkout", "1", "5", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "7", "101010"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "9", "999999"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "11", "999999"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "12", "234567"),
	   ("2018-12-09 00:00:00", 7, "checkout", "2", "13", "222222"),
	   ("2018-12-09 00:00:00", 7, "checkout", "1", "13", "222222"),
	   ("2018-12-08 00:00:00", 7, "checkout", "1", "11", "346578"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "16", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "17", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "45", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "1", "46", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "45", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "46", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "24", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "21", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "55", "654321"),
	   ("2018-12-11 00:00:00", 7, "checkout", "2", "56", "654321");

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