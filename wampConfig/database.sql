CREATE DATABASE IF NOT EXISTS symfony_master;
USE symfony_master;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
role            varchar(50),
name            varchar(100),
surname         varchar(200),
email           varchar(255),
password        varchar(255),
create_at       datetime,

CONSTRAINT pk_users PRIMARY KEY(id)

)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL,'ROLE_USER','Jesus','jmejia','j@gmail.com','chuy120',CURTIME());

INSERT INTO users VALUES(NULL,'ROLE_USER','Manolo','mperez','m@gmail.com','chuy120',CURTIME());

INSERT INTO users VALUES(NULL,'ROLE_USER','Carmen','cramos','c@gmail.com','chuy120',CURTIME());



CREATE TABLE IF NOT EXISTS tasks(
id              int(255) auto_increment not null,  
user_id         int(255) not null,
title           varchar(255),
content         text,
priority        varchar(20),
hours           int(100),
create_at       datetime,
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT pk_task_user FOREIGN KEY(USE_id) references users(id)
)ENGINE=InnoDb;

INSERT INTO tasks VALUES(NULL,1,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,1,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,2,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,3,'Tarea 1','Prueba','alta',20,CURTIME());
INSERT INTO tasks VALUES(NULL,2,'Tarea 1','Prueba','alta',20,CURTIME());
