<?php
namespace models;
class talentModel extends abstractModel
{
    protected static $tableName = 'talents';
    public static $tableSchema = array(
        'name'     => '',
        'phone'     => '',
        'cat_type'     => '',
    );
    protected static $primaryKey = 'id';
    protected static $uniqeRec = 'phone';
}