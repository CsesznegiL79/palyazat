SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS palyazat DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE palyazat;

CREATE TABLE IF NOT EXISTS user_rights (
  user_right_id int NOT NULL,
  name varchar(30) NOT NULL,
  PRIMARY KEY (user_right_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user_rights(user_right_id, name) VALUES
(1, 'Visitor'),
(2, 'Registered user'),
(3, 'Admin');


CREATE TABLE IF NOT EXISTS users (
  nickname varchar(30) NOT NULL,
  first_name varchar(45) NOT NULL,
  last_name varchar(45) NOT NULL,
  password varchar(40) NOT NULL,
  user_right int NOT NULL,
  PRIMARY KEY (nickname),
  FOREIGN KEY (user_right) REFERENCES user_rights(user_right_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO users(nickname, first_name, last_name, password, user_right)
 VALUES("admin", "Admin", "Admin", "7dd12f3a9afa0282a575b8ef99dea2a0c1becb51", 3);

CREATE TABLE IF NOT EXISTS menu_pages (
  menu_page_id INT NOT NULL AUTO_INCREMENT,
  pid varchar(3),
  page_url varchar(30),
  name varchar(30) NOT NULL, 
  user_right int NOT NULL,
  ordered int NOT NULL,
  PRIMARY KEY (menu_page_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO menu_pages (pid, page_url, name, user_right, ordered) VALUES
(1, 'kezdolap', 'Kezdőlap', 1, 100),
('#', '', 'Felhasználó', 1, 200),
('7', 'news', 'Hírek', 1, 250),
('#', '', 'Információ',  1, 300),
('#', '', 'Admin',  3, 400);


CREATE TABLE IF NOT EXISTS menu_subpages (
  menu_subpage_id INT NOT NULL AUTO_INCREMENT,
  parent INT NOT NULL,
  pid INT NOT NULL,
  page_url varchar(30) NOT NULL,
  name varchar(30) NOT NULL, 
  user_right int NOT NULL,
  ordered int NOT NULL,
  PRIMARY KEY (menu_subpage_id),
  FOREIGN KEY (parent) REFERENCES menu_pages(menu_page_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO menu_subpages (parent, pid, page_url, name, user_right, ordered) VALUES
(2, 6, 'regisztracio', 'Regisztráció', 1, 10),
(2, 2, 'bejelentkezes', 'Bejelentkezés', 1, 100),
(2, 3, 'kijelentkezes', 'Kijelentkezés', 2, 200),
(4, 4, 'rolunk', 'Rólunk', 1, 100),
(4, 5, 'elerhetosegek', 'Elérhetőségek', 1, 100),
(5, 8, 'felhasznalok', 'Felhasználók', 3, 100);

CREATE TABLE IF NOT EXISTS news (
  news_id INT NOT NULL AUTO_INCREMENT,
  title varchar(30) NOT NULL,
  news varchar(4000) NOT NULL,
  nickname varchar(30) NOT NULL,
  created_time TIMESTAMP NOT NULL,
  FOREIGN KEY (nickname) REFERENCES users(nickname),
  PRIMARY KEY (news_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;