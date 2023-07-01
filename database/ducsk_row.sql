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



-- -- table user_review

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `place_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;




-- create table user_reviews(
--     id int primary key auto_increment,
--     place_id bigint,
--     user_id bigint,
--     rate int(1) NOT NULL,
--     date_time int(11) NOT NULL,
--     review varchar(255),
--     user_name varchar(200) NOT NULL,
--     index(review)
-- );

-- alter table user_reviews
-- add foreign key(user_id) references users(user_id);
-- alter table user_reviews
-- add foreign key(place_id) references places(place_id);