<?php
/**
* converts mysql database schema to laravel migration
*/
class MySqlToMigration
{
    protected $tables = array();

    function __construct($mysql_schema)
    {

    }

    public function getMigrationCode()
    {
        $migration_code = "";

        foreach ($this->tables as $table)
        {
            $migration_code .= $table->generateMigration();
        }

        $migration_code = $this->code_beautifier->beautify($migration_code);

        return $migration_code;
    }

    public function createMigrationFiles()
    {
        $generated_migration_files = array();

        foreach ($this->tables as $table)
        {
            $migration = $table->generateMigration();

            $migration = $this->code_beautifier->beautify($migration);

            $file_name = $table->migrationFileName();

            file_put_contents($file_name, $migration);

            $generated_migration_files[] = $file_name;
        }
        return $generated_migration_files;
    }
}