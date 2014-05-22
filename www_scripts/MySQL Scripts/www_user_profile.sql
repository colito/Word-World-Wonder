CREATE  TABLE `word_world_wonder`.`www_user_profile` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(45) NULL ,
  `name` VARCHAR(45) NULL ,
  `surname` VARCHAR(45) NULL ,
  `email` VARCHAR(60) NOT NULL ,
  `password` VARCHAR(100) NOT NULL ,
  `day_of_birth` VARCHAR(45) NULL ,
  `month_of_birth` VARCHAR(45) NULL ,
  `year_of_birth` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) );



