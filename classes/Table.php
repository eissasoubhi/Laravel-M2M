<?php
/**
* @todo : create CreateTableMigration class
* @todo : create Column class
*/
class Table
{
    protected $parsed_create_schema;
    protected $create_table_migration;
    protected $table_name;
    protected $columns = [];
    protected $raw_columns = [];
    protected $indexes = [];
    protected $foreign_keys = [];

    function __construct(array $parsed_create_schema)
    {
        $this->parsed_create_schema = $parsed_create_schema;
        $this->create_table_migration = new CreateTableMigration();
        $this->setTableDetails();
    }

    public function generateMigrationClass()
    {
        $migration = $this->create_table_migration->createMigration($this->table_name, $this->columns, $this->indexes, $this->foreign_keys)
    }

    public function createColumns()
    {
        $raw_columns = $this->getRawColumns();

        foreach ($raw_columns as $raw_col) {
            $this->columns[] = new Column($raw_col);
        }
    }

    public function setTableDetails()
    {
        $this->setTableName();
        $this->createColumns();
        $this->createIndexes();
        $this->createForeignKeys();
    }

    public function setTableName()
    {

    }

    public function createIndexes()
    {

    }

    public function createForeignKeys()
    {

    }

}