CREATE TABLE users (
    login varchar(255) PRIMARY KEY NOT NULL UNIQUE,
    password varchar(255) NOT NULL
);

INSERT INTO users VALUES(0, 'Wetterwald', 'Baptiste', 20, 'Baptou', 'Wett');
INSERT INTO users VALUES(1, 'Louada', 'Hamza', 19, 'Hamzouz', 'zouzou123');
INSERT INTO users VALUES(2, 'Yanovskyy', 'Alexander', 19, 'Russkov', 'piano');
INSERT INTO users VALUES(3, 'VDM', 'Julien', 19, 'ElPompier', 'pimpompim');
