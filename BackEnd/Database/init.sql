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
   FOREIGN KEY (nationality_id) REFERENCES nationality(nationality_id) on DELETE CASCADE,
   FOREIGN KEY (club_id) REFERENCES club(club_id) on DELETE CASCADE,
);




CREATE FUNCTION GetNationalit(TEST INT) RETURNS INT
BEGIN
    DECLARE R INT ;
    SELECT COUNT(*) INTO R 
    FROM nationality;

    RETURN R ;
END;


Update  club 
        SET club_name = ? , club_img = ? 
        WHERE club_id = ?