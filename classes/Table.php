<?php
/**
* @todo : create CreateTableMigration class
* @todo : create Column class
*/
class Table
{
    protected $parsed_create_schema;

    function __construct(array $parsed_create_schema)
    {
        $this->parsed_create_schema = $parsed_create_schema;
    }

    public function generateMigrationClass()
    {

    }

}