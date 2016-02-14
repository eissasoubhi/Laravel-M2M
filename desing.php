<?php
$mysql = "";

$mysql_parser = New MySqlParser($mysql);

$mysql_parser->generateMigationClass();

/* */

$mysql_to_migration = New MySqlToMigration($mysql);

$migration_code = $mysql_to_migration->getMigrationCode();

$created_files = $mysql_to_migration->createMigrationFiles();
