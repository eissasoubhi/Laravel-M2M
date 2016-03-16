<?php
/**
* converts mysql database schema to laravel migration
*/
use gossi\formatter\Formatter;
class MySqlToMigration
{
    protected $schema_parser;
    protected $code_formater;
    protected $tables = array();
    protected $create_table_schemas = array();

    function __construct($mysql_schema)
    {
        $this->code_formater = New Formatter();
        $this->schema_parser = New MysqlSchemaParser($mysql_schema);
        $this->create_table_schemas = $this->getParsedCreateSchemas($mysql_schema);
        $this->tables = $this->getTables($this->create_table_schemas);
    }

    public function getMigrationCode()
    {
        $migration_code = "";

        foreach ($this->tables as $table)
        {
            $migration_code .= $table->generateMigrationClass();
        }

        $migration_code = $this->code_formater->format($migration_code);

        return $migration_code;
    }

    public function createMigrationFiles()
    {
        $generated_migration_files = array();

        foreach ($this->tables as $table)
        {
            $migration = $table->generateMigrationClass();

            $migration = $this->code_formater->format($migration);

            $file_name = $table->migrationFileName();

            file_put_contents($file_name, $migration);

            $generated_migration_files[] = $file_name;
        }
        return $generated_migration_files;
    }

    private function getParsedCreateSchemas($mysql_schema)
    {
        return $this->schema_parser->getParsedCreateSchemas();
    }

    private function getTables($create_table_schemas)
    {
        ini_set('xdebug.var_display_max_depth', 10);
        foreach ($create_table_schemas as $parsed_create_schema)
        {
            var_dump($parsed_create_schema);
            exit();
            $this->tables[] = New Table($parsed_create_schema);
        }
    }
}