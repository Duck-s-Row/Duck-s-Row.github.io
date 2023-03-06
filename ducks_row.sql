create database ducks_row;
use ducks_row;
create table branshes ( ID int NOT NULL primary key auto_increment,
branch_name varchar(255),
branch_location varchar(255)
);
create table budget (ID int NOT NULL primary key auto_increment,
min_amount int,
max_amout int,
place_ID int unique NOT NULL
);
create table details(ID int NOT NULL primary key auto_increment,
place_ID int,
attributs1 varchar(255),
attributs2 varchar(255),
attributs3 varchar(255),
attributs4 varchar(255)
);
create table places (ID int NOT NULL primary key auto_increment,
p_name varchar(255),
photo1 longblob NOT null,
photo2 longblob NOT null,
photo3 longblob NOT null,
details_ID int NOT NULL,
budget_ID int NOT NULL,
rating_ID int NOT NULL,
bransh_ID int NOT NULL
);
create table planes(ID int NOT NULL primary key auto_increment,
user_ID int NOT NULL,
place_ID int NOT NULL
);
create table rating(ID int NOT NULL primary key auto_increment,
rating_number int,
user_ID int NOT NULL,
comments varchar(500)
);
create table users(ID int NOT NULL primary key auto_increment,
fname varchar(255),
lname varchar(255),
nationality varchar(255),
phone varchar(11),
b_date date,
gender varchar(7),
email varchar (255),
u_password varchar(255)
);

ALTER TABLE `ducks_row`.`places` 
ADD INDEX `rating_ID_idx` (`rating_ID` ASC) VISIBLE,
ADD INDEX `details_ID_idx` (`details_ID` ASC) VISIBLE,
ADD INDEX `budget_ID_idx` (`budget_ID` ASC) VISIBLE,
ADD INDEX `bransh_ID_idx` (`bransh_ID` ASC) VISIBLE,
DROP INDEX `bransh_ID_idx` ,
DROP INDEX `rating_ID_idx` ,
DROP INDEX `budget_ID_idx` ,
DROP INDEX `details_ID_idx` ;
;

ALTER TABLE `ducks_row`.`planes` 
ADD INDEX `user_ID_idx` (`user_ID` ASC) VISIBLE,
ADD INDEX `place_ID_idx` (`place_ID` ASC) VISIBLE,
DROP INDEX `place_ID_idx` ,
DROP INDEX `user_ID_idx` ;
;

ALTER TABLE `ducks_row`.`rating` 
ADD INDEX `users_ID_idx` (`user_ID` ASC) VISIBLE,
DROP INDEX `users_ID_idx` ;
;