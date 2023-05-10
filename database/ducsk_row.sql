drop database ducks_row;
create database ducks_row;
use ducks_row;

create table codes(
id int primary key auto_increment,
email varchar(100),
code varchar(6),
expire varchar(100)
);

create table users(
id int primary key auto_increment,
user_id bigint ,
username varchar(255),
Fname varchar(255),
Lname varchar(255),
phone varchar(13),
gender varchar(1),
email varchar(255),
password varchar(255),
privilege int default 0,
user_pic varchar(50) default 'non_profile_pic.png',
index(user_id)
);

create table places(
id int primary key auto_increment,
place_id bigint ,
p_name varchar(255),
p_branch varchar(255),
details varchar(255),
average_budget double,
category varchar(255),
location varchar(255),
min_price int,
max_price int,
index(place_id)
);


delimiter //
create trigger after_insert_min_max after insert
on places 
for each row 
update places set average_budget = (new.max_price+new.min_price)/2 where place_id = new.place_id;
delimiter ; 

create table place_pics(
id int primary key auto_increment,
photo_id bigint,
place_id bigint,
photo_name varchar(255),
index(photo_id)
);
alter table place_pics add foreign key(place_id) references places(place_id);



create table user_plans(
id int primary key auto_increment,
plan_id bigint,
user_id bigint,
place_id bigint
);
alter table user_plans add foreign key(user_id) references users(user_id);
alter table user_plans add foreign key(place_id) references places(place_id);



