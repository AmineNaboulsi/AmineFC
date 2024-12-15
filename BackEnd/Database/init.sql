
USE dbaminefc ;

CREATE TABLE `nationality` (
  `nationality_id` INT PRIMARY KEY AUTO_INCREMENT,
  `nationality_name` VARCHAR(100) ,
  `nationality_img` VARCHAR(1000) 
);

CREATE TABLE `club` (
  `club_id` INT PRIMARY KEY AUTO_INCREMENT,
  `club_name` VARCHAR(100) ,
  `club_img` VARCHAR(1000) 
);


CREATE TABLE `Player` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100),
  `photo` VARCHAR(1000),
  `position` VARCHAR(5),
  `pace` INT,
  `shooting` INT,
  `passing` INT,
  `dribbling` INT,
  `defending` INT,
  `physical` INT,
  `nationality_id` INT,
  `club_id` INT,
   FOREIGN KEY (nationality_id) REFERENCES nationality(nationality_id),
   FOREIGN KEY (club_id) REFERENCES club(club_id)
);

insert into club (club_name , club_img)
VALUES ("Arsenal" , "https://cdn3.futbin.com/content/fifa25/img/clubs/dark/1.png?fm=png&amp;ixlib=java-2.1.0&amp;verzion=2&amp;w=256&amp;s=0f5f1b415788c03a743b0d898ccba3af"),
("Aston Villa" , "https://cdn3.futbin.com/content/fifa25/img/clubs/dark/2.png?fm=png&amp;ixlib=java-2.1.0&amp;verzion=2&amp;w=256&amp;s=54cd239ece2af92d9f792165557828f9"),
("Blackburn Rovers" , "https://cdn3.futbin.com/content/fifa25/img/clubs/dark/3.png?fm=png&amp;ixlib=java-2.1.0&amp;verzion=2&amp;w=256&amp;s=3e2d273b2499c550e9d583fbdf31d292");
