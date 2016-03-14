<?php
/**
* deals with mysql database schema
*/
use PHPSQLParser\PHPSQLParser;

class MysqlSchemaParser
{
    protected $mysql_schema;
    protected $create_table_pattern = "/CREATE +(?:TEMPORARY +)?TABLE +(?:IF +NOT +EXISTS)?/is";
    function __construct($mysql_schema)
    {
        $this->setSchema($mysql_schema);
    }

    public function setSchema($mysql_schema)
    {
        $this->mysql_schema = $mysql_schema;
    }

    public function getParsedCreateSchemas()
    {
        if ($this->hasSchema())
        {
            $schemas = $this->splitCreateSchema($this->mysql_schema);
            $parsed_create_schema = array();

            foreach ($schemas as $create_schema)
            {
                $parser  = new PHPSQLParser($create_schema) ;
                $parsed_create_schema[] = $parser->parsed;
            }

            return $parsed_create_schema;
        }
        else
        {
            throw new Exception('error : no schema has been set');
        }
    }

    public function splitCreateSchema($mysql_schema)
    {
        $create_table_schemas = array();

        $schemas = preg_split($this->create_table_pattern, $mysql_schema, null ,PREG_SPLIT_DELIM_CAPTURE);

        foreach ($schemas as $key => $table_body)
        {
            if($table_body)
            {
                $create_table_schemas[] = "CREATE TABLE ".$table_body;
            }
        }
        // ini_set('xdebug.var_display_max_depth', 10);
        return $create_table_schemas;
    }
    public function hasSchema()
    {
        return (bool) $this->mysql_schema;
    }
}
