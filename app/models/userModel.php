<?php
namespace models;
class userModel extends abstractModel
{
    protected static $tableName = 'users';
    public static $tableSchema = array(
        'username'     => '',
        'password'     => ''
    );
    protected static $primaryKey = 'id';
}