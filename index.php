<?php
require_once 'vendor/autoload.php';

$mysql = "CREATE TABLE `logs` (
    `ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `evt` MEDIUMINT(16) UNSIGNED NOT NULL,
    `err` MEDIUMINT(16) UNSIGNED NULL DEFAULT '0',
    `uid` INT(10) UNSIGNED NULL DEFAULT '0',
    `ip` VARCHAR(48) NULL DEFAULT NULL,
    `data` VARCHAR(256) NULL DEFAULT NULL,
    INDEX `uid` (`uid`)
)
COLLATE='utf8_general_ci'
ENGINE=MyISAM
;
CREATE TABLE `langs` (
    `id` TINYINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
    `label` VARCHAR(32) NOT NULL,
    `locale` VARCHAR(20) NOT NULL,
    `enabled` TINYINT(1) UNSIGNED NULL DEFAULT '0',
    PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=4
";
/*echo "<pre>";
print_r(get_declared_classes());
echo "</pre>";*/
$mysql_to_migration = New MySqlToMigration($mysql);
// $migration_code = $mysql_to_migration->getMigrationCode();
// $created_files = $mysql_to_migration->createMigrationFiles();
