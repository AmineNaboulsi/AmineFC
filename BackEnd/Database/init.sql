
USE dbaminefc ;

CREATE TABLE `nationality` (
  `nationality_id` INT PRIMARY KEY AUTO_INCREMENT,
  `nationality_name` VARCHAR(100) ,
  `nationality_img` VARCHAR(100) 
);

CREATE TABLE `club` (
  `club_id` INT PRIMARY KEY AUTO_INCREMENT,
  `club_name` VARCHAR(100) ,
  `club_img` VARCHAR(100) 
);


CREATE TABLE `Player` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100),
  `photo` VARCHAR(100),
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
