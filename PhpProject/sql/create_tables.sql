use art_db;

drop table if exists User;

create table Users (
    login Varchar(30) not null,
    passwordHash Varchar(128) not null,
    type Varchar(12) not null default 'regular',
    primary key(login)
);

create table Comments (
    url Varchar(50) not null,
    user Varchar(30) not null,
    created Timestamp default current_timestamp not null,
    text Varchar(400) not null,
    foreign key(user) references Users(login)
);

create table BlogPosts (
    user Varchar(30) not null,
    created Timestamp default current_timestamp not null,
    title Varchar(100) not null,
    text Text not null,
    foreign key(user) references Users(login)
)
