<?php

class EasyDb {

    public static function selectAll($sql, $params = array()) {
        $connection = Yii::app()->db;
        return $connection->createCommand($sql)->bindValues($params)->queryAll();
    }

    public static function selectRow($sql, $params = array()) {
        $connection = Yii::app()->db;
        return $connection->createCommand($sql)->bindValues($params)->queryRow();
    }

    public static function selectCol($sql, $params = array()) {
        $connection = Yii::app()->db;
        return $connection->createCommand($sql)->bindValues($params)->queryColumn();
    }

    public static function selectOne($sql, $params = array()) {
        $connection = Yii::app()->db;
        return $connection->createCommand($sql)->bindValues($params)->queryScalar();
    }

    /**
     * 执行SQL，返回影响的行数
     */
    public static function execute($sql, $params = array()) {
        $connection = Yii::app()->db;
        return $connection->createCommand($sql)->bindValues($params)->execute();
    }

    /**
     * 返回最后一次插入的id
     */
    public static function lastInsertId() {
        return Yii::app()->db->lastInsertID;
    }

    /**
     * 返回指定表的下一个自增id
     * @param String $name 表名
     * @param int $count 自增的数字
     * @return int 新的ID
     */
    public static function id($name, $count = 1) {
        $affected_rows = EasyDb::execute('UPDATE RES SET ID=LAST_INSERT_ID(ID+:count) WHERE ATTRIB=:name', array(':count' => $count, ':name' => $name));
        if($affected_rows == 0) {
            EasyDb::execute('INSERT INTO RES(ATTRIB,ID) VALUES(:name,0)', array(':name' => $name));
            EasyDb::execute('UPDATE RES SET ID=LAST_INSERT_ID(ID+:count) WHERE ATTRIB=:name', array(':count' => $count, ':name' => $name));
        }
        return EasyDb::selectOne('SELECT LAST_INSERT_ID()');
    }
}

?>
