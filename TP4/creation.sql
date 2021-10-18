CREATE TABLE users (
    login varchar(255) PRIMARY KEY NOT NULL UNIQUE,
    password varchar(255) NOT NULL
);