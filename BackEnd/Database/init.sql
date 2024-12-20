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
   FOREIGN KEY (nationality_id) REFERENCES nationality(nationality_id) ,
   FOREIGN KEY (club_id) REFERENCES club(club_id) ,
);

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Player'

alter table Player add constraint Player_ibfk_nationnality
FOREIGN KEY (nationality_id) REFERENCES nationality(nationality_id) on update CASCADE on DELETE SET NULL;
alter table Player add constraint Player_ibfk_club
FOREIGN KEY (club_id) REFERENCES club(club_id) on update CASCADE  on DELETE SET NULL ; 



CREATE FUNCTION GetNationalit(TEST INT) RETURNS INT
BEGIN
    DECLARE R INT ;
    SELECT COUNT(*) INTO R 
    FROM nationality;

    RETURN R ;
END;



select count(*) from `Player`;
SELECT count(*)  FROM Player p  
                LEFT JOIN club c ON c.club_id = p.club_id
                LEFT JOIN nationality n  ON n.nationality_id = n.nationality_id