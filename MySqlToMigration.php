<?php
/**
* converts mysql database schema to laravel migration
*/
class MySqlToMigration
{
    protected $schema_parser;
    protected $code_formater;
    protected $tables = array();
    protected $create_table_schemas = array();

    function __construct($mysql_schema)
    {
        $this->code_formater = New Formatter();
        $this->schema_parser = New MysqlSchemaParser();
        $this->create_table_schemas = $this->getCreateSchemas($mysql_schema);
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

    private function getCreateSchemas($mysql_schema)
    {
        $this->schema_parser->setSchema($mysql_schema);
        return $this->schema_parser->getCreateTableSchemas();
    }

    private function getTables($create_table_schemas)
    {
        foreach ($create_table_schemas as $create_schema)
        {
            $this->tables[] = New Table($create_schema);
        }
    }
}