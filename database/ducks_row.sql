create database ducks_row;
use ducks_row;

create table branshes ( 
  ID int NOT NULL primary key auto_increment,
  branch_name varchar(255),
  branch_location varchar(255)
);

create table budget (
  ID int NOT NULL primary key auto_increment,
  min_amount int,
  max_amout int,
  place_ID int unique NOT NULL
);

create table details(
  ID int NOT NULL primary key auto_increment,
  place_ID int,
  attributs1 varchar(255),
  attributs2 varchar(255),
  attributs3 varchar(255),
  attributs4 varchar(255)
);

create table places (
  ID int NOT NULL primary key auto_increment,
  p_name varchar(255),
  photo1 longblob NOT null,
  photo2 longblob NOT null,
  photo3 longblob NOT null,
  details_ID int NOT NULL,
  budget_ID int NOT NULL,
  rating_ID int NOT NULL,
  bransh_ID int NOT NULL
);

create table planes(
  ID int NOT NULL primary key auto_increment,
  user_ID int NOT NULL,
  place_ID int NOT NULL
);

create table rating(
  ID int NOT NULL primary key auto_increment,
  rating_number int,
  user_ID int NOT NULL,
  comments varchar(500)
);

create table users(
  ID int NOT NULL primary key auto_increment,
  user_id BIGINT NOT NULL,
  username varchar(255) NOT NULL,
  Fname varchar(255),
  Lname varchar(255),
  phone varchar(13),
  gender varchar(1),
  email varchar (255),
  password varchar(255),
  admin int default 0,
  user_pic varchar(60)
);

create table codes(
id int primary key auto_increment,
email varchar(100),
code varchar(6),
expire varchar(100)
);

ALTER TABLE `ducks_row`.`places` 
ADD INDEX `details_ID_idx` (`details_ID` ASC) VISIBLE,
ADD INDEX `budget_ID_idx` (`budget_ID` ASC) VISIBLE,
ADD INDEX `rating_ID_idx` (`rating_ID` ASC) VISIBLE,
ADD INDEX `bransh_ID_idx` (`bransh_ID` ASC) VISIBLE;
;
ALTER TABLE `ducks_row`.`places` 
ADD CONSTRAINT `details_ID`
  FOREIGN KEY (`details_ID`)
  REFERENCES `ducks_row`.`details` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `budget_ID`
  FOREIGN KEY (`budget_ID`)
  REFERENCES `ducks_row`.`budget` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `rating_ID`
  FOREIGN KEY (`rating_ID`)
  REFERENCES `ducks_row`.`rating` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `bransh_ID`
  FOREIGN KEY (`bransh_ID`)
  REFERENCES `ducks_row`.`branshes` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  ALTER TABLE `ducks_row`.`rating` 
ADD INDEX `users_ID_idx` (`user_ID` ASC) VISIBLE;
;
ALTER TABLE `ducks_row`.`rating` 
ADD CONSTRAINT `users_ID`
  FOREIGN KEY (`user_ID`)
  REFERENCES `ducks_row`.`users` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  ALTER TABLE `ducks_row`.`planes` 
ADD INDEX `user_ID_idx` (`user_ID` ASC) VISIBLE,
ADD INDEX `place_ID_idx` (`place_ID` ASC) VISIBLE;
;
ALTER TABLE `ducks_row`.`planes` 
ADD CONSTRAINT `user_ID`
  FOREIGN KEY (`user_ID`)
  REFERENCES `ducks_row`.`users` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `place_ID`
  FOREIGN KEY (`place_ID`)
  REFERENCES `ducks_row`.`places` (`ID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  


ALTER TABLE `ducks_row`.`codes` 
ADD INDEX `email` (`email` ASC) VISIBLE;
;