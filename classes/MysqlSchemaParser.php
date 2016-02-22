<?php
/**
* deals with mysql database schema
*/
use PHPSQLParser\PHPSQLParser;

class MysqlSchemaParser
{
    protected $mysql_schema;
    protected $parser;
    function __construct($mysql_schema)
    {
        $this->setSchema($mysql_schema);
        $this->parser  = new PHPSQLParser($mysql_schema) ;
    }

    public function setSchema($mysql_schema)
    {
        $this->mysql_schema = $mysql_schema;
    }

    public function getCreateTableSchemas()
    {
        if ($this->hasSchema())
        {
            ini_set('xdebug.var_display_max_depth', 10);
            var_dump($this->parser);
            exit();
        }
        else
        {
            throw new Exception('error : no schema has been set');
        }
    }

    public function hasSchema()
    {
        return (bool) $this->mysql_schema;
    }
}