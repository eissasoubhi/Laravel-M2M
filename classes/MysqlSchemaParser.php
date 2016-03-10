<?php
/**
* deals with mysql database schema
*/
use PHPSQLParser\PHPSQLParser;

class MysqlSchemaParser
{
    protected $mysql_schema;
    protected $parser;
    protected $create_table_pattern = "/CREATE +(?:TEMPORARY +)?TABLE +(?:IF +NOT +EXISTS)?/is";
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
            $create_table_schemas = array();

            $schemas = preg_split($this->create_table_pattern,
                                    $this->mysql_schema, null ,PREG_SPLIT_DELIM_CAPTURE);
            // var_dump($schemas);
                // exit(); "<hr>";
            foreach ($schemas as $key => $table_body)
            {
                if($table_body)
                {
                    $create_table_schemas[] = "CREATE TABLE ".$table_body;
                }
            }
            ini_set('xdebug.var_display_max_depth', 10);
            var_dump($create_table_schemas);
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
