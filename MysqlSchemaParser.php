<?php
/**
* deals with mysql database schema
*/
class MysqlSchemaParser
{
    protected $mysql_schema;
    protected $parser;
    function __construct($mysql_schema = null)
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