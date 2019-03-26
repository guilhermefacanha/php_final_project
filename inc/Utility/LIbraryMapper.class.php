<?php

class LibraryMapper {

    //Place to store the PDO Agent
    private static $db;

    static function initialize(string $className)   {
        
        self::$db = new PDOAgent($className);

    }

    static function createLibrary(Library $library) : int   {
        $sqlInsert = "INSERT INTO LIBRARY (Name, Address) VALUES (:name, :address)";

        self::$db->query($sqlInsert);

        self::$db->bind(':name', $library->getName());
        self::$db->bind(':address', $library->getAddress());

        self::$db->execute();

        return self::$db->lastInsertId();

    }

    static function getBooks() : Array {
        
        $selectAll = "SELECT * FROM LIBRARY;";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }

    static function deleteLibrary(int $id) : bool {
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

}

?>