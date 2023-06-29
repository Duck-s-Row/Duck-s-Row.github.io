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
    user_id bigint,
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
    place_id bigint,
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
create table place_pics(
    id int primary key auto_increment,
    photo_id bigint,
    place_id bigint,
    photo_name varchar(255),
    index(photo_id)
);
alter table place_pics
add foreign key(place_id) references places(place_id);
create table user_plans(
    id int primary key auto_increment,
    plan_id bigint,
    user_id bigint,
    place_id bigint
);
alter table user_plans
add foreign key(user_id) references users(user_id);
alter table user_plans
add foreign key(place_id) references places(place_id);
alter table places
add column logo varchar(255) default "default_logo.png";
alter table places
    rename column details to small_details;
alter table places
add column more_details varchar(255);
alter table user_plans drop column plan_id;
ALTER TABLE `ducks_row`.`places` CHANGE COLUMN `location` `location` LONGTEXT;
create table offers(
    offer_id bigint primary key,
    offer_image varchar(255)
);
drop table if exists user_plans;
create table exist_plan(
    id int primary key auto_increment,
    plan_id bigint,
    place_id bigint,
    user_id bigint
);
create table user_plans(
    plan_id bigint primary key,
    plan_name varchar(255),
    creation_date timestamp,
    plan_date date
);
alter table exist_plan
add foreign key(plan_id) references user_plans(plan_id);
alter table exist_plan
add foreign key(user_id) references users(user_id);
alter table exist_plan
add foreign key(place_id) references places(place_id);
alter table user_plans
add column user_id bigint;
alter table user_plans
add foreign key(user_id) references users(user_id);
alter table places
add column menu_image varchar(255);
alter table user_plans
add column average Double DEFAULT 0;
-- triggers of the average
DELIMITER / / CREATE TRIGGER update_average_after_insert
AFTER
INSERT ON exist_plan FOR EACH ROW BEGIN
DECLARE total_avg DOUBLE;
DECLARE place_avg DOUBLE;
DECLARE plan_id_val BIGINT;
-- Get the plan_id of the newly inserted row
SET plan_id_val = NEW.plan_id;
-- Calculate the average for the newly added place
SELECT AVG(average_budget) INTO place_avg
FROM places
WHERE place_id = NEW.place_id;
-- Calculate the total average for the plan
SELECT AVG(average) INTO total_avg
FROM user_plans
WHERE plan_id = plan_id_val;
-- Update the average in the user_plans table
UPDATE user_plans
SET average = total_avg + place_avg
WHERE plan_id = plan_id_val;
END / / DELIMITER;
DELIMITER / /
CREATE TRIGGER update_average_after_delete
AFTER DELETE ON exist_plan FOR EACH ROW BEGIN
DECLARE total_avg DOUBLE;
DECLARE place_avg DOUBLE;
DECLARE plan_id_val BIGINT;
-- Get the plan_id of the deleted row
SET plan_id_val = OLD.plan_id;
-- Calculate the average for the removed place
SELECT AVG(average_budget) INTO place_avg
FROM places
WHERE place_id = OLD.place_id;
-- Calculate the total average for the plan
SELECT AVG(average) INTO total_avg
FROM user_plans
WHERE plan_id = plan_id_val;
-- Update the average in the user_plans table
UPDATE user_plans
SET average = total_avg - place_avg
WHERE plan_id = plan_id_val;
END / /
DELIMITER;
-- request table
create table requests(
    request_id bigint primary key,
    user_id bigint,
    req_status varchar(255)  default 'pending'
);
alter table requests add foreign key(user_id) references users(user_id);
create table request_details(
    place_id bigint primary key,
    request_id bigint,
    p_name varchar(255),
    p_branch varchar(255),
    details varchar(255),
    logo varchar(255) default "default_logo.png",
    average_budget double,
    category varchar(255),
    location varchar(255),
    min_price int,
    max_price int,
    menu_image varchar(255)
);
alter table request_details add foreign key(request_id) references requests(request_id);
 create table request_place_pics(
	photo_id bigint primary key,
     place_id bigint,
photo_name varchar(255)
);
alter table request_place_pics add foreign key(place_id) references request_details(place_id);
create table request_comment(
id int primary key auto_increment,
place_id bigint,
comment varchar(255)
);
alter table request_comment add foreign key(place_id) references request_details(place_id);

ALTER TABLE `ducks_row`.`exist_plan` DROP FOREIGN KEY `exist_plan_ibfk_2`;
ALTER TABLE `ducks_row`.`exist_plan` DROP COLUMN `user_id`,
    DROP INDEX `user_id`;
;