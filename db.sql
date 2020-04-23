CREATE DATABASE loginsystem;

CREATE TABLE users (
    idUsers int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    uidUsers TINYTEXT NOT NULL,
    emailUsers TINYTEXT NOT NULL,
    pwdUsers LONGTEXT NOT NULL
);


CREATE TABLE pwdreset (
	pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    pwdResetEmail TEXT NOT NULL,
    pwdResetSelector TEXT NOT NULL,
    pwdResetToken LONGTEXT NOT NULL,
    pwdResetExpires TEXT NOT NULL
);

CREATE TABLE posts (
    idPosts int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    titlePosts TINYTEXT NOT NULL,
    bodyPosts TEXT NOT NULL,
    createdByPosts TINYTEXT NOT NULL,
    createdAtPosts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idUsers int(11) NOT NULL,
    FOREIGN KEY(idUsers) REFERENCES users(idUsers)
);

