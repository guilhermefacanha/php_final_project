<?php
class PDOAgent
{
    //connection properties
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;

    //DSN
    private $dsn = "";
    //Errors
    private $error;
    //Statement
    private $stm;
    //Class name
    private $className;

    //PDO Objecto
    private $pdo;

    //Default Constructor
    public function __construct(string $className)
    {
        //Store the class name
        $this->className = $className;

        //Construct DSN
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        //PDO Options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        //run
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $options);
        } catch (PDOException $pe) {
            $this->error = $pe->getMessage();
        }
    }

    public function query(string $query)
    {
        $this->stm = $this->pdo->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stm->bindValue($param, $value, $type);  
    }

    //execute the prepared statement
    public function execute($data = null){
        if(is_null($data)){
            //Fire the query
            $this->stm->execute();
        }else{
            $this->stm->execute($data);
        }
    }

    //return result set
    public function resultSet(){
        $this->execute();
        $this->stm->setFetchMode(PDO::FETCH_CLASS, $this->className);
        return $this->stm->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    //result set array
    public function resultSetArray(){
        $this->execute();
        return $this->stm->fetchAll();
    }
    
    //return single result
    public function singleResult(){
        $this->execute();
        $this->stm->setFetchMode(PDO::FETCH_CLASS, $this->className);
        return $this->stm->fetch(PDO::FETCH_CLASS);
    }

    //Return the row count
    public function rowCount() : int{
        return $this->stm->rowCount();
    }

    //Return the lastInsertedId
    public function lastInsertId() : int{
        return $this->pdo->lastInsertId();
    }

}
