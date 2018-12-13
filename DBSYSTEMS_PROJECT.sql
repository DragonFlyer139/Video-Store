create table employee
(name varchar(30) not null,
employeeid char(9) not null,
address varchar(30),
phone char(9),
primary key (employeeid));

create table hourly
(employeeid char(9) not null,
primary key (employeeid));

create table store
(storeno char(10) not null,
saddress varchar(30),
sphone char(9),
primary key (storeno));

create table full_time
(employeeid char(9) not null,
salary integer,
storeno char(10) not null,
constraint fk_fulltimestoreno
foreign key (storeno) references store(storeno)
on delete cascade,
constraint fk_fulltimeemployee
foreign key (employeeid) references employee(employeeid)
on delete cascade);
             
create table hworks
(employeeid char(9) not null,
rate integer,
hours integer,
storeno char(10) not null,
constraint fk_hworksstoreno
foreign key (storeno) references store(storeno)
on delete cascade,
constraint fk_hourlyemployee
foreign key (employeeid) references employee(employeeid)
on delete cascade);

create table movie
(objectid char(9) not null,
title varchar(30),
director varchar(30),
producer varchar(30),
actor1 varchar(30),
actor2 varchar(30),
category varchar(30),
primary key (objectid));
              
create table player
(objectid char(9) not null,
model varchar(15),
brand varchar(15),
playerfeature varchar(15),
primary key (objectid));
 
create table store_object
(objectid char(9) not null,
dailycharge int,
copyno char(9) not null,
primary key (objectid));

create table copy
(copyno char(9) not null,
type varchar(10),
stat varchar(10),
objectid char(9) not null,
primary key (copyno),
constraint fk_copyobjectid
foreign key (objectid) 
references movie(objectid)
on delete cascade);

alter table store_object
add constraint fk_socopy
foreign key (copyno) references copy(copyno);
             
create table player_device
(copyno char(9) not null,
storeno char(10) not null,
primary key (copyno),
foreign key (storeno) 
references store(storeno));
             
create table no_assigned
(objectid char(9) not null,
storeno char(10) not null,
nodvd int,
nobd int,
foreign key (objectid) 
references movie(objectid),
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
storeno char(10),
copyno char(9) not null,
memberid char(9) not null,
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

alter table movie
change column objectid movieid
char(9);

alter table player
change column objectid playerid
char(9);

rename table store_object to store_charge;

alter table store_charge
change column objectid chargeid
char(9);

alter table no_assigned
change column objectid movieid
char(9);

/*
ended up creating a separate fk instead of replacing copyno
*/
alter table player_device
add playerid char(9);


alter table player_device
add constraint fk_plyr_device_cpy
foreign key (playerid) references player(playerid);

alter table copy
change column objectid movieid
char(9);
