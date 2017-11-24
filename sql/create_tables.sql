use art_db;

drop table if exists User;

create table Users (
    login Varchar(30) not null,
    passwordHash Varchar(128) not null,
    type Varchar(12) not null default 'regular',
    primary key(login)
);
