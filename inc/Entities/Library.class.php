<?
class Library
{
    private $id;
    private $name;
    private $address;

    //gets
    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
    public function getAddress(){return $this->address;}

    //sets
    public function setId($id){$this->id = $id;}
    public function setName($name){$this->name = $name;}
    public function setAddress($address){$this->address = $address;}
}

?>