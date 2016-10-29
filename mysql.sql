#创建pra数据库
create database if not exists pra
default character set "utf8";	

#创建admin表
create table admin(
	id tinyint(3) primary key auto_increment,
	username char(30) unique key not null,
	password varchar(52) not null
);

#创建文章表
create table news(
	id int(12) primary key auto_increment,
	title varchar(100) not null,
	content text,
	author varchar(10),
	type varchar(10),
	pubTime datetime
);