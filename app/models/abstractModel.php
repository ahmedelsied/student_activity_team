<?php
namespace models;
class abstractModel
{
    public function getAll()
    {
        global $con;
        $stmt = $con->prepare("SELECT * FROM " . static::$tableName);
		$stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getLimit($argument)
    {
        global $con;
        $sql = "SELECT * FROM " . static::$tableName . " LIMIT ".$argument;
        $stmt = $con->prepare($sql);
		$stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getWPK($pk)
    {
        global $con;
        $sql = 'SELECT * FROM '. static::$tableName . ' WHERE '.static::$primaryKey.' = ' . $pk;
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getOneRec($value)
    {
        global $con;
        $sql = 'SELECT * FROM '.static::$tableName.' WHERE '.static::$primaryKey.' = ? LIMIT 1';
        $statment = $con->prepare($sql);
        $statment->execute(array($value));
        $records = $statment->fetch();
        return $records;
    }
    public function getSpec($target,$cond,$value)
    {
        global $con;
        $sql = 'SELECT '.$target.' FROM '. static::$tableName . ' WHERE '.$cond.' = ' . $value;
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getJOIN($table,$column,$selected,$val)
    {
        global $con;
        $sql = 'SELECT '.$table.'.'.$column.'
        FROM '.$table.'
        INNER JOIN '.static::$tableName.'
        ON '.static::$tableName.'.'.static::$primaryKey.' = '.$selected.' 
        WHERE '.static::$tableName.'.'.static::$primaryKey. ' = '.$val;
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function buildNameParametersSQL()
    {
        $namedParams = '';
        foreach (static::$tableSchema as $columnName => $type) {
            $namedParams .= $columnName . ' = "' . $type . '", ';
        }
        return trim($namedParams, ', ');
    }
    public function insertRec()
    {
        global $con;
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL();
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return true;
    }
    public function deleteRec($param)
    {
        global $con;
        $sql = 'DELETE FROM '. static::$tableName .' WHERE '. static::$primaryKey .' = ' . $param;
        $stmt = $con->prepare($sql);
        $stmt->execute();
    }
    public function updateRec($param)
    {
        global $con;
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . $this->buildNameParametersSQL() . ' WHERE ' . static::$primaryKey .' = ' . $param;
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return true;
    }
    public function checkIfExist($value){
        global $con;
        $sql = 'SELECT '.static::$uniqeRec.' FROM '.static::$tableName.' WHERE '.static::$uniqeRec.' = ?';
        $stmt = $con->prepare($sql);
        $stmt->execute(array($value));
        $count = $stmt->rowCount();
        return $count;
    }
    public function login($value)
    {
        global $con;
        $sql = 'SELECT * FROM '.static::$tableName.' WHERE username = ? AND password = ? LIMIT 1';
        $stmt = $con->prepare($sql);
        $stmt->execute($value);
        $data = $stmt->fetch();
        $count = $stmt->rowCount();
        return array($data,$count);
    }
}