CREATE TABLE `miwifiadmin`.`mainmenu`( 
   `id` INT(10) NOT NULL AUTO_INCREMENT , 
   `title` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '菜单标题', 
   `url` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '菜单链接', 
   `enable` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '1:enable0:disable', 
   PRIMARY KEY (`id`)
 )ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='主菜单';
 
CREATE TABLE `miwifiadmin`.`asidemenu`( 
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '子菜单标题',
  `map` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '子菜单简称',
  `url` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '子菜单链接',
  `module_id` INT(3) NOT NULL DEFAULT '0' COMMENT '子菜单模块id',
  `enable` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '1:enable0:disable',
  PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='子菜单';
 
CREATE TABLE `miwifiadmin`.`menu_module_relation`(
   `id` INT(10) NOT NULL AUTO_INCREMENT COMMENT '模块主键', 
   `menu_id` INT(10) NOT NULL DEFAULT '0' COMMENT '主菜单id', 
   `title` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '模块标题',  
   `enable` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '1:enable0:disable', 
  PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8 COMMENT='子菜单模块';
