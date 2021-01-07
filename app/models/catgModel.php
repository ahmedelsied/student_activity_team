<?php
namespace models;
class catgModel extends abstractModel
{
    protected static $tableName = 'categories';
    public static $tableSchema = array(
        'name'     => '',
    );
    protected static $primaryKey = 'id';
    protected static $uniqeRec  = 'id';
}