-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2020 a las 23:30:59
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `processes`
--
CREATE DATABASE IF NOT EXISTS `connect` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `connect`;

DELIMITER $$
--
-- Procedimientos
--

DROP PROCEDURE IF EXISTS `sp_login`$$
CREATE PROCEDURE `sp_login` (IN `email` VARCHAR(200), IN `pass` VARCHAR(30))  BEGIN
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

DROP PROCEDURE IF EXISTS `sp_login_insert`$$
CREATE PROCEDURE `sp_login_insert` (IN `pass` VARCHAR(30), IN `user` INT)  BEGIN 
  INSERT INTO login(Login_password, User_id) VALUES (pass,user); 
  SELECT ROW_COUNT(); 
END$$

DROP PROCEDURE IF EXISTS `sp_login_update`$$
CREATE PROCEDURE `sp_login_update` (IN `id` SMALLINT, IN `pass` VARCHAR(600))  BEGIN 
  UPDATE login SET Login_password=pass WHERE User_id = id; 
  DELETE FROM recovery_password WHERE User_id=id;
  SELECT ROW_COUNT() AS Id_row;
END$$

DROP PROCEDURE IF EXISTS `sp_new_user_active`$$
CREATE PROCEDURE `sp_new_user_active` (IN `n_hash` VARCHAR(600))  BEGIN 
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

DROP PROCEDURE IF EXISTS `sp_new_user_clean`$$
CREATE PROCEDURE `sp_new_user_clean` ()  BEGIN
	 DELETE FROM new_user WHERE TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(Nuser_date, INTERVAL 24 HOUR)) < 0;
   SELECT ROW_COUNT();
END$$

DROP PROCEDURE IF EXISTS `sp_new_user_insert_update`$$
CREATE PROCEDURE `sp_new_user_insert_update` (IN `us_id` INT(11), IN `n_date` VARCHAR(100), IN `n_hash` VARCHAR(600), IN `n_status` INT)  BEGIN 
	SET @count = (SELECT COUNT(User_id) FROM new_user WHERE User_id = us_id);
    IF @count = 0 THEN
    	INSERT INTO new_user (Nuser_id, User_id, Nuser_date, Nuser_hash, Nuser_state) VALUES (NULL, us_id, n_date, n_hash, n_status);
    ELSE
    	UPDATE new_user SET Nuser_date = n_date, Nuser_hash = n_hash, Nuser_state = n_status WHERE User_id = us_id;
    END IF;
    SELECT ROW_COUNT();
END$$

DROP PROCEDURE IF EXISTS `sp_recovery_password_insert`$$
CREATE PROCEDURE `sp_recovery_password_insert` (IN `user_id` INT, IN `pass_date` VARCHAR(100), IN `pass_hash` VARCHAR(600), IN `pass_state` INT)  BEGIN 
	SET @count = (SELECT COUNT(*) FROM recovery_password WHERE User_id = user_id);
    IF @count = 0 THEN
  		INSERT INTO recovery_password (Recover_pass_id, User_id, Recover_pass_date, Recover_pass_hash, Recover_pass_state) VALUES (NULL, user_id,pass_date, pass_hash,pass_state);
  	ELSE
    	UPDATE recovery_password SET Recover_pass_date = pass_date, Recover_pass_hash = pass_hash, Recover_pass_state = pass_state WHERE User_id = user_id;
    END IF;
    SELECT ROW_COUNT(); 
END$$

DROP PROCEDURE IF EXISTS `sp_recovery_password_select`$$
CREATE PROCEDURE `sp_recovery_password_select` (IN `pass_hash` VARCHAR(600))  BEGIN 
SET @valid =(SELECT TIMESTAMPDIFF(MINUTE,NOW() ,DATE_ADD(Recover_pass_date,INTERVAL 24 HOUR)) AS Recover_difference FROM recovery_password WHERE Recover_pass_hash=pass_hash);
IF @valid >= 0 THEN 
  SELECT User_id FROM recovery_password WHERE Recover_pass_hash=pass_hash;
  ELSE
  SELECT "expire" AS Error_id;
 END IF; 
END$$

DROP PROCEDURE IF EXISTS `sp_select_status`$$
CREATE PROCEDURE `sp_select_status` (IN `stat` INT)  BEGIN
    SELECT * FROM status WHERE Type_id = stat;
END$$

DROP PROCEDURE IF EXISTS `sp_user_get_email`$$
CREATE PROCEDURE `sp_user_get_email` (IN `email` VARCHAR(320))  BEGIN
    SET @valid =(SELECT User_id FROM user WHERE User_email=email AND Stat_id = 6);
    IF @valid != 0 THEN 
    SELECT User_id, User_name FROM user WHERE User_email=email;
    ELSE
    SELECT "0" AS User_id;
    END IF; 
END$$

DROP PROCEDURE IF EXISTS `sp_user_insert_update`$$
CREATE PROCEDURE `sp_user_insert_update` (IN `name` VARCHAR(80), IN `identification` VARCHAR(15), IN `email` VARCHAR(320), IN `title` VARCHAR(30), IN `stat` INT, IN `pass` VARCHAR(30), IN `tel` VARCHAR(15), IN `id` INT, IN `role` INT, IN `securityGroup` INT, IN `company` INT)  BEGIN
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

DROP PROCEDURE IF EXISTS `sp_user_select_active`$$
CREATE PROCEDURE `sp_user_select_active` (IN `name` VARCHAR(320))  NO SQL
BEGIN
    IF name IS NULL THEN
        SELECT User_id, User_name, User_email, User_title FROM user
       WHERE Stat_id = 6;
   ELSE
       SELECT User_id, User_name, User_email, User_title FROM user WHERE (User_name LIKE CONCAT('%', name ,'%') OR User_email LIKE CONCAT('%', name ,'%') OR User_title LIKE CONCAT('%', name ,'%')) AND Stat_id = 6;
   END IF;
END$$

DROP PROCEDURE IF EXISTS `sp_user_select_one`$$
CREATE PROCEDURE `sp_user_select_one` (IN `id` INT)  BEGIN
SELECT User_id, User_name, User_identification, User_email, User_title, Stat_id, User_telephone,Role_id ,Sgroup_id, Comp_id FROM user  WHERE User_id = id;
END$$

DROP PROCEDURE IF EXISTS `sp_user_validation`$$
CREATE PROCEDURE `sp_user_validation` (IN `id` INT)  BEGIN
   SELECT User_name, User_email FROM user
   WHERE User_id = id;
END$$

DELIMITER ;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE `application` (
  `App_id` int(11) NOT NULL,
  `App_name` varchar(100) NOT NULL,
  `Mod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `broadcast_group`
--

DROP TABLE IF EXISTS `broadcast_group`;
CREATE TABLE `broadcast_group` (
  `Bg_id` int(11) NOT NULL,
  `Bg_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Comp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `broadcast_gxu`
--

DROP TABLE IF EXISTS `broadcast_gxu`;
CREATE TABLE `broadcast_gxu` (
  `Bgxu_id` int(11) NOT NULL,
  `Bg_id` int(11) DEFAULT NULL,
  `User_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `Comp_id` int(11) NOT NULL,
  `Comp_identification` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Comp_name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Comp_address` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Comp_phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`Comp_id`, `Comp_identification`, `Comp_name`, `Comp_address`, `Comp_phone`) VALUES
(1, '222222222-1', 'Market Place', '', ''),
(2, '1111111111', 'Sinapsis Technologies', 'Cl 1 1 1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `Login_id` int(11) NOT NULL,
  `Login_password` varchar(30) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`Login_id`, `Login_password`, `User_id`) VALUES
(1, 'root123', 1),
(2, 'lina123', 2),
(3, '7142c2907bd83fea0ea03e8020878e', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `Mod_id` int(11) NOT NULL,
  `Mod_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `new_user`
--

DROP TABLE IF EXISTS `new_user`;
CREATE TABLE `new_user` (
  `Nuser_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Nuser_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nuser_hash` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nuser_state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `Not_id` int(11) NOT NULL,
  `Form_consecutive` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Not_message` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `Per_id` int(11) NOT NULL,
  `Per_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recovery_password`
--

DROP TABLE IF EXISTS `recovery_password`;
CREATE TABLE `recovery_password` (
  `Recover_pass_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Recover_pass_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Recover_pass_hash` varchar(600) NOT NULL,
  `Recover_pass_state` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `Role_id` int(11) NOT NULL,
  `Role_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`Role_id`, `Role_name`) VALUES
(1, 'Root');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `security_group`
--

DROP TABLE IF EXISTS `security_group`;
CREATE TABLE `security_group` (
  `Sgroup_id` int(11) NOT NULL,
  `Sgroup_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `security_group`
--

INSERT INTO `security_group` (`Sgroup_id`, `Sgroup_name`) VALUES
(1, 'Grupo1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `security_gxm`
--

DROP TABLE IF EXISTS `security_gxm`;
CREATE TABLE `security_gxm` (
  `Sgxm_id` int(11) NOT NULL,
  `Sgroup_id` int(11) NOT NULL,
  `Mod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `security_gxmxa`
--

DROP TABLE IF EXISTS `security_gxmxa`;
CREATE TABLE `security_gxmxa` (
  `Sgxmxa_id` int(11) NOT NULL,
  `Sgxm_id` int(11) NOT NULL,
  `App_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `security_gxmxaxp`
--

DROP TABLE IF EXISTS `security_gxmxaxp`;
CREATE TABLE `security_gxmxaxp` (
  `Sgxmxaxp_id` int(11) NOT NULL,
  `Sgxmxa_id` int(11) NOT NULL,
  `Per_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `Stat_id` int(11) NOT NULL,
  `Stat_name` varchar(30) NOT NULL,
  `Type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`Stat_id`, `Stat_name`, `Type_id`) VALUES
(1, 'Precotizado', 2),
(2, 'Iniciado', 2),
(3, 'Tránsito', 2),
(4, 'Aprobado', 2),
(5, 'Anulado', 2),
(6, 'Activo', 1),
(7, 'Inactivo', 1),
(8, 'Activo', 3),
(9, 'Inactivo', 3),
(10, 'Diligenciado', 4),
(11, 'Revisado', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_type`
--

DROP TABLE IF EXISTS `status_type`;
CREATE TABLE `status_type` (
  `Type_id` int(11) NOT NULL,
  `Type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `status_type`
--

INSERT INTO `status_type` (`Type_id`, `Type_name`) VALUES
(1, 'Usuario'),
(2, 'Cotización'),
(3, 'General'),
(4, 'Formularios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `User_name` varchar(80) NOT NULL,
  `User_identification` varchar(15) NOT NULL,
  `User_email` varchar(320) NOT NULL,
  `User_title` varchar(30) NOT NULL,
  `User_telephone` varchar(15) NOT NULL,
  `Stat_id` int(11) NOT NULL,
  `Role_id` int(11) NOT NULL,
  `Sgroup_id` int(11) NOT NULL,
  `Comp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`User_id`, `User_name`, `User_identification`, `User_email`, `User_title`, `User_telephone`, `Stat_id`, `Role_id`, `Sgroup_id`, `Comp_id`) VALUES
(1, 'Diego Casallas Vanegas', '11111111111', 'd.casallas@sinapsistechnologies.com', 'TI DESARROLLO 1', '3052344577', 6, 1, 1, 1),
(2, 'Lina Contrerásñop', '1000000000', 'diseno@grupotrivia.co', 'Diseñadora', '1234567', 6, 1, 1, 1),
(3, 'Laura Grisales', '1030654234', 'lauramggarcia@hotmail.com', 'Ingeniero de Software', '3054752261', 6, 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`App_id`),
  ADD KEY `Mod_id` (`Mod_id`);

--
-- Indices de la tabla `broadcast_group`
--
ALTER TABLE `broadcast_group`
  ADD PRIMARY KEY (`Bg_id`),
  ADD KEY `Comp_id` (`Comp_id`);

--
-- Indices de la tabla `broadcast_gxu`
--
ALTER TABLE `broadcast_gxu`
  ADD PRIMARY KEY (`Bgxu_id`),
  ADD KEY `Bg_id` (`Bg_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Comp_id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Login_id`),
  ADD KEY `user_login` (`User_id`);

--
-- Indices de la tabla `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`Mod_id`);

--
-- Indices de la tabla `new_user`
--
ALTER TABLE `new_user`
  ADD PRIMARY KEY (`Nuser_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indices de la tabla `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`Not_id`);

--
-- Indices de la tabla `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`Per_id`);

--
-- Indices de la tabla `recovery_password`
--
ALTER TABLE `recovery_password`
  ADD PRIMARY KEY (`Recover_pass_id`),
  ADD KEY `recovery_password_user` (`User_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Role_id`);

--
-- Indices de la tabla `security_group`
--
ALTER TABLE `security_group`
  ADD PRIMARY KEY (`Sgroup_id`);

--
-- Indices de la tabla `security_gxm`
--
ALTER TABLE `security_gxm`
  ADD PRIMARY KEY (`Sgxm_id`),
  ADD KEY `Sgroup_id` (`Sgroup_id`),
  ADD KEY `Mod_id` (`Mod_id`);

--
-- Indices de la tabla `security_gxmxa`
--
ALTER TABLE `security_gxmxa`
  ADD PRIMARY KEY (`Sgxmxa_id`),
  ADD KEY `Sgxm_id` (`Sgxm_id`),
  ADD KEY `App_id` (`App_id`);

--
-- Indices de la tabla `security_gxmxaxp`
--
ALTER TABLE `security_gxmxaxp`
  ADD PRIMARY KEY (`Sgxmxaxp_id`),
  ADD KEY `Sgxmxa_id` (`Sgxmxa_id`),
  ADD KEY `Per_id` (`Per_id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Stat_id`),
  ADD KEY `type_status` (`Type_id`);

--
-- Indices de la tabla `status_type`
--
ALTER TABLE `status_type`
  ADD PRIMARY KEY (`Type_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `user_status` (`Stat_id`),
  ADD KEY `Role_id` (`Role_id`),
  ADD KEY `Sgroup_id` (`Sgroup_id`),
  ADD KEY `Comp_id` (`Comp_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `application`
--
ALTER TABLE `application`
  MODIFY `App_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `broadcast_group`
--
ALTER TABLE `broadcast_group`
  MODIFY `Bg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `broadcast_gxu`
--
ALTER TABLE `broadcast_gxu`
  MODIFY `Bgxu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `Comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `Login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `module`
--
ALTER TABLE `module`
  MODIFY `Mod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `new_user`
--
ALTER TABLE `new_user`
  MODIFY `Nuser_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notification`
--
ALTER TABLE `notification`
  MODIFY `Not_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permission`
--
ALTER TABLE `permission`
  MODIFY `Per_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recovery_password`
--
ALTER TABLE `recovery_password`
  MODIFY `Recover_pass_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `Role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `security_group`
--
ALTER TABLE `security_group`
  MODIFY `Sgroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `security_gxm`
--
ALTER TABLE `security_gxm`
  MODIFY `Sgxm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `security_gxmxa`
--
ALTER TABLE `security_gxmxa`
  MODIFY `Sgxmxa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `security_gxmxaxp`
--
ALTER TABLE `security_gxmxaxp`
  MODIFY `Sgxmxaxp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `Stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `status_type`
--
ALTER TABLE `status_type`
  MODIFY `Type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`Mod_id`) REFERENCES `module` (`Mod_id`);

--
-- Filtros para la tabla `broadcast_group`
--
ALTER TABLE `broadcast_group`
  ADD CONSTRAINT `broadcast_group_ibfk_1` FOREIGN KEY (`Comp_id`) REFERENCES `company` (`Comp_id`);

--
-- Filtros para la tabla `broadcast_gxu`
--
ALTER TABLE `broadcast_gxu`
  ADD CONSTRAINT `broadcast_gxu_ibfk_1` FOREIGN KEY (`Bg_id`) REFERENCES `broadcast_group` (`Bg_id`),
  ADD CONSTRAINT `broadcast_gxu_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `user_login` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);
--
-- Filtros para la tabla `new_user`
--
ALTER TABLE `new_user`
  ADD CONSTRAINT `new_user_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Filtros para la tabla `recovery_password`
--
ALTER TABLE `recovery_password`
  ADD CONSTRAINT `recovery_password_user` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Filtros para la tabla `security_gxm`
--
ALTER TABLE `security_gxm`
  ADD CONSTRAINT `security_gxm_ibfk_1` FOREIGN KEY (`Sgroup_id`) REFERENCES `security_group` (`Sgroup_id`),
  ADD CONSTRAINT `security_gxm_ibfk_2` FOREIGN KEY (`Mod_id`) REFERENCES `module` (`Mod_id`);

--
-- Filtros para la tabla `security_gxmxa`
--
ALTER TABLE `security_gxmxa`
  ADD CONSTRAINT `security_gxmxa_ibfk_1` FOREIGN KEY (`Sgxm_id`) REFERENCES `security_gxm` (`Sgxm_id`),
  ADD CONSTRAINT `security_gxmxa_ibfk_2` FOREIGN KEY (`App_id`) REFERENCES `application` (`App_id`);

--
-- Filtros para la tabla `security_gxmxaxp`
--
ALTER TABLE `security_gxmxaxp`
  ADD CONSTRAINT `security_gxmxaxp_ibfk_1` FOREIGN KEY (`Sgxmxa_id`) REFERENCES `security_gxmxa` (`Sgxmxa_id`),
  ADD CONSTRAINT `security_gxmxaxp_ibfk_2` FOREIGN KEY (`Per_id`) REFERENCES `permission` (`Per_id`);

--
-- Filtros para la tabla `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `type_status` FOREIGN KEY (`Type_id`) REFERENCES `status_type` (`Type_id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`Role_id`) REFERENCES `role` (`Role_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`Sgroup_id`) REFERENCES `security_group` (`Sgroup_id`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`Comp_id`) REFERENCES `company` (`Comp_id`),
  ADD CONSTRAINT `user_status` FOREIGN KEY (`Stat_id`) REFERENCES `status` (`Stat_id`);

DELIMITER $$
--
-- Eventos
--
DROP EVENT `new_user_clean`$$
CREATE EVENT `new_user_clean` ON SCHEDULE EVERY 1 DAY STARTS '2020-03-01 00:00:01' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM new_user WHERE TIMESTAMPDIFF(MINUTE, NOW(), DATE_ADD(Nuser_date, INTERVAL 24 HOUR)) < 0$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
