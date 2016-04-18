<?php
/**
*
*/
class CreateTableMigration
{
    protected $migration_class_template;

    function __construct()
    {
        $migration_class_template $this->getMigrationClassTemplateConent();
    }

    function createMigration($table_name, $columns, $indexes, $foreign_keys)
    {
        $this->replaceTaBleName($table_name);
        $this->replaceColulmns($columns);
        $this->replaceIndexes($indexes);
        $this->replaceForeignKeys($foreign_keys);
    }

    public function replaceTaBleName($table_name)
    {

    }

    public function getMigrationClassTemplateConent()
    {

    }
}