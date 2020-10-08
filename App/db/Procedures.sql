DELIMITER $$
DROP PROCEDURE IF EXISTS sp_login$$
CREATE PROCEDURE sp_login(IN email VARCHAR(200), IN pass VARCHAR(30))
BEGIN
 SET @mail = '';
 SET @password = '';
 SET @mail = (SELECT COUNT(u.User_email) FROM user u WHERE u.User_email LIKE email AND Stat_id=6);
 IF @mail > 0 THEN
      SET @ok = (SELECT COUNT(*) FROM login LO
        INNER JOIN user USU ON LO.User_id=USU.User_id
        WHERE USU.User_email=email AND LO.Login_password=pass);
   IF @ok > 0 THEN
         SELECT U.User_id, U.User_name, U.User_email FROM user U
            INNER JOIN login L ON U.User_id = L.User_id
            WHERE L.Login_password LIKE pass AND U.User_email like email;
   ELSE
       SELECT 0;
   END IF;
 ELSE
   SELECT 0;
 END IF;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_login_insert$$
CREATE PROCEDURE sp_login_insert(IN pass VARCHAR(30), IN user INT)
BEGIN 
  INSERT INTO login(Login_password, User_id) VALUES (pass,user); 
  SELECT ROW_COUNT(); 
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_login_update$$
CREATE PROCEDURE sp_login_update(IN mail VARCHAR(200), IN pass VARCHAR(30))
BEGIN 
  SET @user_id = (SELECT User_id FROM user WHERE User_email LIKE mail); 
  UPDATE login SET Login_password=pass WHERE User_id = @user_id; 
  SELECT ROW_COUNT(); 
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_broadcast_group_all$$
CREATE PROCEDURE sp_broadcast_group_all(company INT)
BEGIN
	SELECT Bg_id, Bg_name FROM broadcast_group
    WHERE Comp_id = company;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_broadcast_gxu_all$$
CREATE PROCEDURE sp_broadcast_gxu_all(IN name VARCHAR(100), IN company INT)
BEGIN
	SET @bg = (SELECT Bg_id FROM broadcast_group WHERE Bg_name = name);
IF @bg IS NULL THEN
	SET @bg = (SELECT Bg_id FROM broadcast_group WHERE Bg_name = 'Otro');
END IF;
	SELECT U.User_email FROM broadcast_gxu B
	INNER JOIN user U ON B.User_id = U.User_id
	WHERE B.Bg_id = (@bg) AND U.Comp_id = company AND U.Stat_id = 6;
END$$
DELIMITER ;

/*
Author: DIEGO CASALLAS
Date: 24/05/2020
Description : SP select security group 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS sp_user_insert_update$$
CREATE PROCEDURE sp_user_insert_update(IN name VARCHAR(80), IN identification VARCHAR(15), IN email VARCHAR(320), IN title VARCHAR(30), IN stat INT, IN pass VARCHAR(30), IN tel VARCHAR(15), IN id INT, IN role INT, IN securityGroup INT, IN company INT) 
BEGIN
    SET @exist =(SELECT COUNT(*)
    FROM user
    WHERE User_email = email AND User_identification = identification);
    SET @id = (SELECT User_id
    FROM user
    WHERE User_email = email);

    IF @exist = 0 AND id = 0 THEN
        INSERT INTO user (User_name, User_identification, User_email, User_title, Stat_id, User_telephone,Role_id,Sgroup_id, Comp_id) VALUES (name, identification, email, title, stat, tel, role, securityGroup, company);
        SET @user_id = LAST_INSERT_ID();
        INSERT INTO login(Login_password, User_id)VALUES(pass, @user_id);
        SET @return = @user_id;
    ELSE
        IF (SELECT COUNT(User_id) FROM new_user WHERE User_id = @id) =1 THEN
            SET @return = 'Inactive';
        ELSEIF id != 0 AND @exist = 1  THEN
            UPDATE user SET User_name = name, User_title = title, Stat_id = stat, User_telephone = tel, Role_id = role, Sgroup_id = securityGroup WHERE User_id = @id;
            SET @return = 'Update';
        ELSE
            SET @return = 'Registered';
        END IF;
    END IF;
    SELECT @return AS "return_value";
END$$
DELIMITER ; 


DELIMITER $$
DROP PROCEDURE IF EXISTS sp_user_select_active$$
CREATE PROCEDURE sp_user_select_active(IN name VARCHAR(320))
    NO SQL
BEGIN
    IF name IS NULL THEN
        SELECT User_id, User_name, User_email, User_title FROM user
       WHERE Stat_id = 6;
   ELSE
       SELECT User_id, User_name, User_email, User_title FROM user WHERE (User_name LIKE CONCAT('%', name ,'%') OR User_email LIKE CONCAT('%', name ,'%') OR User_title LIKE CONCAT('%', name ,'%')) AND Stat_id = 6;
   END IF;
END$$
DELIMITER ;
/*
Author: DIEGO CASALLAS
Date: 23/05/2020
Description : Update SP get data one user 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS sp_user_select_one$$
CREATE PROCEDURE sp_user_select_one(IN id INT)
BEGIN
SELECT User_id, User_name, User_identification, User_email, User_title, Stat_id, User_telephone,Role_id ,Sgroup_id, Comp_id FROM user  WHERE User_id = id;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_user_validation$$
CREATE PROCEDURE sp_user_validation(IN id INT)
BEGIN
   SELECT User_name, User_email FROM user
   WHERE User_id = id;
END$$
DELIMITER ;

/*
Author: DIEGO CASALLAS
Date: 14/01/2020
Description : SP get email
*/
 
DELIMITER $$
DROP PROCEDURE IF EXISTS sp_user_get_email$$
CREATE PROCEDURE sp_user_get_email(IN email VARCHAR(320)) 
BEGIN
    SET @valid =(SELECT User_id FROM user WHERE User_email=email AND Stat_id = 6);
    IF @valid != 0 THEN 
    SELECT User_id, User_name FROM user WHERE User_email=email;
    ELSE
    SELECT "0" AS User_id;
    END IF; 
END$$
DELIMITER ;
/*
Author: DIEGO CASALLAS
Date: 14/01/2020
Description : SP insert recovery password 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS sp_recovery_password_insert$$
CREATE PROCEDURE sp_recovery_password_insert(IN id INT, IN pass_date VARCHAR(100), IN pass_hash VARCHAR(600),IN pass_state INT)
BEGIN 
	SET @count = (SELECT COUNT(*) FROM recovery_password WHERE User_id = id);
    IF @count = 0 THEN
  		INSERT INTO recovery_password (Recover_pass_id, User_id, Recover_pass_date, Recover_pass_hash, Recover_pass_state) VALUES (NULL, id, pass_date, pass_hash,pass_state);
  	ELSE
    	UPDATE recovery_password SET Recover_pass_date = pass_date, Recover_pass_hash = pass_hash, Recover_pass_state = pass_state WHERE User_id = id;
    END IF;
    SELECT ROW_COUNT(); 
END$$
DELIMITER ;
/*
Author: DIEGO CASALLAS
Date: 15/01/2020
Description : SP select hash 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS sp_recovery_password_select$$
CREATE PROCEDURE sp_recovery_password_select(IN pass_hash VARCHAR(600))
BEGIN 
SET @valid =(SELECT TIMESTAMPDIFF(MINUTE,NOW() ,DATE_ADD(Recover_pass_date,INTERVAL 24 HOUR)) AS Recover_difference FROM recovery_password WHERE Recover_pass_hash=pass_hash);
IF @valid >= 0 THEN 
  SELECT User_id FROM recovery_password WHERE Recover_pass_hash=pass_hash;
  ELSE
  SELECT "expire" AS Error_id;
 END IF; 
END$$
DELIMITER ;
/*
Author: DIEGO CASALLAS
Date: 15/01/2020
Description : SP update login 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS sp_login_update$$
CREATE PROCEDURE sp_login_update(IN id SMALLINT, IN pass VARCHAR(600))
BEGIN 
  UPDATE login SET Login_password=pass WHERE User_id = id; 
  DELETE FROM recovery_password WHERE User_id=id;
  SELECT ROW_COUNT() AS Id_row;
END$$
DELIMITER ;
/*
Author: DIEGO CASALLAS
Date: 23/05/2020
Description : SP select status 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_status`$$
CREATE PROCEDURE `sp_select_status`(IN stat INT)
BEGIN
    SELECT * FROM status WHERE Type_id = stat;
END$$
DELIMITER ;
/*
Author: DIEGO CASALLAS
Date: 23/05/2020
Description : SP select role 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_role`$$
CREATE PROCEDURE `sp_select_role`()
BEGIN
    SELECT * FROM role;
END$$
DELIMITER ;

/*
Author: DIEGO CASALLAS
Date: 23/05/2020
Description : SP select security group 
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_security_group`$$
CREATE PROCEDURE `sp_select_security_group`()
BEGIN
    SELECT * FROM security_group;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_new_user_insert_update$$
CREATE PROCEDURE sp_new_user_insert_update(IN us_id INT(11), IN n_date VARCHAR(100), IN n_hash VARCHAR(600), IN n_status INT) 
BEGIN 
	SET @count = (SELECT COUNT(User_id) FROM new_user WHERE User_id = us_id);
    IF @count = 0 THEN
    	INSERT INTO new_user (Nuser_id, User_id, Nuser_date, Nuser_hash, Nuser_state) VALUES (NULL, us_id, n_date, n_hash, n_status);
    ELSE
    	UPDATE new_user SET Nuser_date = n_date, Nuser_hash = n_hash, Nuser_state = n_status WHERE User_id = us_id;
    END IF;
    SELECT ROW_COUNT();
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_new_user_active$$
CREATE PROCEDURE sp_new_user_active(IN n_hash VARCHAR(600))
BEGIN 
SET @valid =(SELECT TIMESTAMPDIFF(MINUTE,NOW() ,DATE_ADD(Nuser_date,INTERVAL 24 HOUR)) AS Recover_difference FROM new_user WHERE Nuser_hash = n_hash);
IF @valid >= 0 THEN 
  SET @idUser = (SELECT User_id FROM new_user WHERE Nuser_hash = n_hash);
  UPDATE user SET Stat_id = 6 WHERE User_id = @idUser;
  DELETE FROM new_user WHERE User_id = @idUser;
  SELECT ROW_COUNT();
  ELSE
  SELECT "expire" AS Error_id;
 END IF; 
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_new_user_clean$$
CREATE PROCEDURE sp_new_user_clean() 
BEGIN
	 DELETE FROM new_user WHERE TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(Nuser_date, INTERVAL 24 HOUR)) < 0;
   SELECT ROW_COUNT();
END$$
DELIMITER ;

CREATE EVENT IF NOT EXISTS new_user_clean ON SCHEDULE EVERY 1 DAY 
STARTS '2020-03-01 00:00:01' 
ON COMPLETION NOT PRESERVE ENABLE 
DO 
DELETE FROM new_user WHERE TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(Nuser_date, INTERVAL 24 HOUR)) < 0$$