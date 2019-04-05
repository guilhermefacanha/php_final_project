<?php

class LibraryMapper {

    //Place to store the PDO Agent
    private static $db;

    static function initialize()   {
        
        self::$db = new PDOAgent('Library');

    }

    static function create(Library $library) : int   {
        $sqlInsert = "INSERT INTO LIBRARY (Name, Address) VALUES (:name, :address)";

        self::$db->query($sqlInsert);

        self::$db->bind(':name', $library->getName());
        self::$db->bind(':address', $library->getAddress());

        self::$db->execute();

        return self::$db->lastInsertId();

    }

    static function update(Library $library){
        //query
        $query = "UPDATE LIBRARY
                        SET Name=:name, Address=:address
                        WHERE LibraryId=:id;
                        ";
        self::$db->query($query);

        //bind
        self::$db->bind(":name", $library->getName());
        self::$db->bind(":address", $library->getAddress());
        self::$db->bind(":id", $library->getId());
        
        //execute
        self::$db->execute();
        
        //result
        return true;
    }

    static function getAll() : Array {
        
        $selectAll = "SELECT * FROM LIBRARY";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function getOne($id) : Library{
        $sqlSelect = "SELECT * FROM LIBRARY WHERE LibraryId = :id";
        self::$db->query($sqlSelect);
        //bind
        self::$db->bind(":id", $id);
        self::$db->execute();
        return self::$db->singleResult();
    }

    static function delete(int $id) : bool {
        $deleteSQLQuery = "DELETE FROM LIBRARY WHERE LibraryId = :id;";

        try {

            self::$db->query($deleteSQLQuery);
            self::$db->bind(':id', $id);
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting library with id $id");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            return false;
            
        }

        return true;

    }
    static function getAllAsAssociativeArray() : Array {
        
        $selectAll = "SELECT * FROM LIBRARY";

        self::$db->query($selectAll);
        self::$db->execute();
        $libraries = self::$db->resultSet();
        $associativeArray=array();
        foreach($libraries as $library){
            $associativeArray[$library->getId()]=$library->getName();
        }
        
        return $associativeArray;
    }

}

?>