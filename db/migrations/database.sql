create table users (
    id int not null primary key auto_increment,
    name varchar(155) not null,
    email varchar(255) not null,
    password varchar(255) not null
);