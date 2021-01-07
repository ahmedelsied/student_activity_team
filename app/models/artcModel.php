<?php
namespace models;
class artcModel extends abstractModel
{
    protected static $tableName = 'articles';
    public static $tableSchema = array(
        'title'     => '',
        'details'     => '',
        'cat_id'     => '',
        'images'     => '',
    );
    protected static $primaryKey = 'id';
    protected static $uniqeRec = 'id';
}