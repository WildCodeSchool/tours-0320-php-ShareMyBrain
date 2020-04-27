-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/?code=1d9826745d9574632b33#/d/YipnsC
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.

DROP DATABASE IF EXISTS sharemybrain;
CREATE DATABASE sharemybrain CHARACTER SET 'utf8';
USE sharemybrain;

CREATE TABLE `answer` (
    `id` int AUTO_INCREMENT NOT NULL ,
    `id_question` int  NOT NULL ,
    `content` LONGTEXT  NOT NULL ,
    `id_user` INT  NOT NULL ,
    `date` DATE NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `question` (
    `id` int AUTO_INCREMENT NOT NULL ,
    `id_theme` int  NOT NULL ,
    `content` LONGTEXT  NOT NULL ,
    `id_user` int  NOT NULL ,
    `date` DATE NULL ,
    `resolved` bool NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `theme` (
    `id` int AUTO_INCREMENT NOT NULL ,
    `name` VARCHAR(255)  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `user_theme` (
    `id` int AUTO_INCREMENT NOT NULL ,
    `id_theme` int  NOT NULL ,
    `id_user` int  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `user` (
    `id` int AUTO_INCREMENT NOT NULL ,
    `username` VARCHAR(255)  NOT NULL ,
    `userpassword` VARCHAR(255) NULL ,
    `usermail` VARCHAR(255) NULL ,
    `admin` bool NULL ,
    PRIMARY KEY (
        `id`
    )
);

ALTER TABLE `answer` ADD CONSTRAINT `fk_answer_id_question` FOREIGN KEY(`id_question`)
REFERENCES `question` (`id`);

ALTER TABLE `answer` ADD CONSTRAINT `fk_answer_id_user` FOREIGN KEY(`id_user`)
REFERENCES `user` (`id`);

ALTER TABLE `question` ADD CONSTRAINT `fk_question_id_theme` FOREIGN KEY(`id_theme`)
REFERENCES `theme` (`id`);

ALTER TABLE `question` ADD CONSTRAINT `fk_question_id_user` FOREIGN KEY(`id_user`)
REFERENCES `user` (`id`);

ALTER TABLE `user_theme` ADD CONSTRAINT `fk_user_theme_id_theme` FOREIGN KEY(`id_theme`)
REFERENCES `theme` (`id`);

ALTER TABLE `user_theme` ADD CONSTRAINT `fk_user_theme_id_user` FOREIGN KEY(`id_user`)
REFERENCES `user` (`id`);

-- Contenu de la table `thème`
--

INSERT INTO theme (name) VALUES ('Jardinage'),('Cuisine'),('Bricolage'),('Ménage');

-- Contenu de la table `user`
--

INSERT INTO user (username) VALUES ('visiteur'),('admin');

