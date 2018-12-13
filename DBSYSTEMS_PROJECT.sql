create table employee
(name varchar(30) not null,
employeeid int not null auto_increment,
address varchar(30),
phone char(9),
password varchar(15),
primary key (employeeid));
/*
create table hourly
(employeeid char(9) not null,
primary key (employeeid));
*/
create table store
(storeno int not null auto_increment,
saddress varchar(30),
sphone char(9),
primary key (storeno));

create table full_time
(employeeid int not null,
salary integer,
storeno int not null,
constraint fk_fulltimestoreno
foreign key (storeno) references store(storeno)
on delete cascade,
constraint fk_fulltimeemployee
foreign key (employeeid) references employee(employeeid)
on delete cascade);
             
create table hworks
(employeeid int not null,
rate integer,
hours integer,
storeno int not null,
constraint fk_hworksstoreno
foreign key (storeno) references store(storeno)
on delete cascade,
constraint fk_hourlyemployee
foreign key (employeeid) references employee(employeeid)
on delete cascade);

create table movie
(movieid int not null auto_increment,
title varchar(30),
director varchar(30),
producer varchar(30),
actor1 varchar(30),
actor2 varchar(30),
category varchar(30),
primary key (movieid));
              
create table player
(playerid int not null auto_increment,
model varchar(15),
brand varchar(15),
playerfeature varchar(15),
primary key (playerid));

create table copy
(copyno int not null auto_increment,
type varchar(10),
stat varchar(10),
movieid int not null,
primary key (copyno),
constraint fk_copymovieid
foreign key (movieid) 
references movie(movieid)
on delete cascade);

create table store_charge
(chargeid int not null auto_increment,
dailycharge decimal(10,2) not null default '0',
copyno int not null,
primary key (chargeid),
constraint fk_socopy
foreign key (copyno) references copy(copyno));
/*
alter table store_object
add constraint fk_socopy
foreign key (copyno) references copy(copyno);
  */           
create table player_device
(copyno int not null,
storeno int not null,
playerid int,
primary key (copyno),
foreign key (storeno) 
references store(storeno),
constraint fk_plyr_device_cpy
foreign key (playerid) references player(playerid));
             
create table no_assigned
(movieid int not null,
storeno int not null,
nodvd int,
nobd int,
foreign key (movieid) 
references movie(movieid),
foreign key (storeno) 
references store(storeno));

create table member
(memberid char(9) not null,
address char(30),
membername char(30),
password char(15),
balance decimal(10,2) not null default '0',
primary key (memberid));
                 
create table invoice_transaction
(transaction_id int not null auto_increment,
stamp datetime,
amount int,
type varchar(10),
storeno int,
copyno int not null,
memberid char(9) not null,
primary key (transaction_id),
foreign key (storeno)
references store(storeno),
foreign key (copyno)
references copy(copyno),
foreign key (memberid)
references member(memberid));
/*
alter table employee
add password varchar(15);

drop table hourly;

alter table movie
change column objectid movieid
int;

alter table player
change column objectid playerid
int;

rename table store_object to store_charge;

alter table store_charge
change column objectid chargeid
int;

alter table no_assigned
change column objectid movieid
int;
*/
/*
ended up creating a separate fk instead of replacing copyno
*/
/*
alter table player_device
add playerid int;


alter table player_device
add constraint fk_plyr_device_cpy
foreign key (playerid) references player(playerid);

alter table copy
change column objectid movieid
int;
*/