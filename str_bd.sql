CREATE DATABASE IF NOT EXISTS StreaksDB;
USE StreaksDB;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
role            varchar(50),
name            varchar(100),
surname         varchar(200),
email           varchar(255),
password        varchar(255),
create_at       datetime,
imagen          varchar(255),

CONSTRAINT pk_users PRIMARY KEY(id)

)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL,'ROLE_USER','Jesus','Mejia','j@gmail.com','chuy120',CURTIME(),'');

INSERT INTO users VALUES(NULL,'ROLE_USER','Manolo','Perez','m@gmail.com','chuy120',CURTIME(),'');

INSERT INTO users VALUES(NULL,'ROLE_USER','Carmen','Ramos','c@gmail.com','chuy120',CURTIME(),'');



CREATE TABLE IF NOT EXISTS streaks(
id              int(255) auto_increment not null,  
user_id         int(255) not null,
title           varchar(255),
content         text,
priority        varchar(20),
hours           int(100),
create_at       datetime,
category_id     int(255),
imagen          varchar(255),
repeat_streak   int(255),
CONSTRAINT pk_streaks PRIMARY KEY(id),
CONSTRAINT pk_streak_user FOREIGN KEY(USE_id) references users(id),
CONSTRAINT pk_category_streaks FOREIGN KEY(USE_id) references categories(id)
)ENGINE=InnoDb;



INSERT INTO tasks VALUES(NULL,1,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,1,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,2,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,3,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,2,'Tarea 1','Prueba','alta',20,CURTIME());




CREATE TABLE IF NOT EXISTS categories(
id              int(255) auto_increment not null,  
title           varchar(255),
description_str varchar(255),
imagen        varchar(20),
hours           int(100),
CONSTRAINT pk_category PRIMARY KEY(id)
)ENGINE=InnoDb;




