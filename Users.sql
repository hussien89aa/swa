drop database  Users;
create database Users;
use Users;
CREATE TABLE  login (
	 userID 	INTEGER PRIMARY KEY AUTO_INCREMENT,
	 userName 	varchar(25),
	 password 	varchar(200)
);
DESCRIBE login;

insert into login(userName,password)values ('admin','admin');
insert into login(userName,password)values ('jena','1111');
insert into login(userName,password)values ('laya','1234');
select * from login;


CREATE TABLE  activities (
	transactionKey 	varchar(100),
	fromUserName 	varchar(25),
	ToUserName 	varchar(25),
	Amount 	FLOAT
);
DESCRIBE activities;

CREATE TRIGGER before_insert_activities
BEFORE INSERT ON activities
FOR EACH ROW
	SET new.transactionKey = uuid();

insert into activities(fromUserName,ToUserName,Amount)values ('admin','jena',100);
insert into activities(fromUserName,ToUserName,Amount)values ('admin','laya',500);
insert into activities(fromUserName,ToUserName,Amount)values ('jena','admin',800);
insert into activities(fromUserName,ToUserName,Amount)values ('jena','laya',600);
select * from activities;


ALTER TABLE login
	ADD userToken VARCHAR(36);
DESCRIBE login;

CREATE TRIGGER before_insert_login
BEFORE INSERT ON login
FOR EACH ROW
	SET new.userToken = uuid();


CREATE TABLE  chating (
	chatText 	varchar(1000)
);
DESCRIBE chating;

CREATE TABLE  sessions (
	session 	varchar(1000)
);
DESCRIBE sessions;