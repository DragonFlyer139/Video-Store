create table employee
(name varchar(15) not null,
employeeid int(9) not null auto_increment,
address varchar(30),
phone char(9),
primary key (employeeid));

create table hourly
(employeeid int(9) not null auto_increment,
primary key (employeeid));

create table store
(storeno int(10) not null auto_increment,
saddress varchar(30),
sphone char(9),
primary key (storeno));

create table full_time
(employeeid int(9) not null auto_increment,
salary integer,
storeno int(10) not null,
constraint fk_fulltimestoreno
foreign key (storeno) references store(storeno)
on delete cascade,
constraint fk_fulltimeemployee
foreign key (employeeid) references employee(employeeid)
on delete cascade);

create table hworks
(employeeid int(9) not null auto_increment,
rate integer,
hours integer,
storeno int(10) not null,
constraint fk_hworksstoreno
foreign key (storeno) references store(storeno)
on delete cascade,
constraint fk_hourlyemployee
foreign key (employeeid) references employee(employeeid)
on delete cascade);

create table movie
(movieid int(9) not null auto_increment,
title varchar(15),
director varchar(15),
producer varchar(15),
actor1 varchar(15),
actor2 varchar(15),
category varchar(15),
primary key (movieid));

create table player
(objectid int(9) not null auto_increment,
model varchar(15),
brand varchar(15),
playerfeature varchar(15),
primary key (objectid));

create table store_object
(objectid int(9) not null auto_increment,
dailycharge int,
copyno int(9) not null,
primary key (objectid));

create table copy
(copyno int(9) not null auto_increment,
type varchar(10),
stat varchar(10),
movieid int(9) not null,
primary key (copyno),
constraint fk_copyobjectid
foreign key (movieid)
references movie(movieid)
on delete cascade);

alter table store_object
add constraint fk_socopy
foreign key (copyno) references copy(copyno);

create table player_device
(copyno int(9) not null,
storeno int(10) not null,
primary key (copyno),
foreign key (storeno)
references store(storeno));

create table no_assigned
(movieid int(9) not null,
storeno int(10) not null,
nodvd int,
nobd int,
foreign key (movieid)
references movie(movieid),
foreign key (storeno)
references store(storeno));

create table member
(memberid int(9) not null auto_increment,
address char(30),
membername char(15),
password char(15),
primary key (memberid));

create table invoice_transaction
(transaction_id int(9) not null auto_increment,
stamp datetime,
amount int,
type int(10),
storeno int(10) not null,
copyno int(9) not null,
memberid int(9) not null,
primary key (transaction_id),
foreign key (storeno)
references store(storeno),
foreign key (copyno)
references copy(copyno),
foreign key (memberid)
references member(memberid));

alter table employee
add password varchar(15);

drop table hourly;
alter table player
change column objectid playerid
int(9);

rename table store_object to store_charge;

/*
ended up creating a separate fk instead of replacing copyno
*/
alter table player_device
add playerid int(9);


alter table player_device
add constraint fk_plyr_device_cpy
foreign key (playerid) references player(playerid);
