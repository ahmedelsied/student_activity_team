<?php
namespace models;
class subsModel extends abstractModel
{
    protected static $tableName = 'subscribers';
    public static $tableSchema = array(
        'email'     => ''
        );
    protected static $primaryKey = 'id';
    protected static $uniqeRec = 'email';
}