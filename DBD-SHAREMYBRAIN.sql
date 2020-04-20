-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/?code=1d9826745d9574632b33#/d/YipnsC
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `answer` (
    `ID` int  NOT NULL ,
    `id_question` int  NOT NULL ,
    `content` TXT  NOT NULL ,
    `id_user` INT  NOT NULL ,
    `date` DATE  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `question` (
    `ID` int  NOT NULL ,
    `id_theme` int  NOT NULL ,
    `content` VARCHAR(255)  NOT NULL ,
    `id_user` int  NOT NULL ,
    `date` DATE  NOT NULL ,
    `resolved` bool  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `theme` (
    `ID` int  NOT NULL ,
    `name` VARCHAR(255)  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `user_theme` (
    `ID` int  NOT NULL ,
    `id_theme` int  NOT NULL ,
    `id_user` int  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `user` (
    `ID` int  NOT NULL ,
    `username` VARCHAR(255)  NOT NULL ,
    `userpassword` VARCHAR(255)  NOT NULL ,
    `usermail` VARCHAR(255)  NOT NULL ,
    `admin` bool  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

ALTER TABLE `answer` ADD CONSTRAINT `fk_answer_id_question` FOREIGN KEY(`id_question`)
REFERENCES `question` (`ID`);

ALTER TABLE `answer` ADD CONSTRAINT `fk_answer_id_user` FOREIGN KEY(`id_user`)
REFERENCES `user` (`ID`);

ALTER TABLE `question` ADD CONSTRAINT `fk_question_id_theme` FOREIGN KEY(`id_theme`)
REFERENCES `theme` (`ID`);

ALTER TABLE `question` ADD CONSTRAINT `fk_question_id_user` FOREIGN KEY(`id_user`)
REFERENCES `user` (`ID`);

ALTER TABLE `user_theme` ADD CONSTRAINT `fk_user_theme_id_theme` FOREIGN KEY(`id_theme`)
REFERENCES `theme` (`ID`);

ALTER TABLE `user_theme` ADD CONSTRAINT `fk_user_theme_id_user` FOREIGN KEY(`id_user`)
REFERENCES `user` (`ID`);

