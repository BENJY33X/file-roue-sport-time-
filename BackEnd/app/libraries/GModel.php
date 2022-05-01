<?php
require_once "./Connection.php";
require_once "../config/Function.php";
class GlobalModel
{
    protected $connection;
    protected $Table;
    public function __construct($Table)
    {
        $con = new Connection();
        $this->connection = $con->db;
        $this->Table = $Table;
    }
    public function selectAll()
    {
        $conn = $this->connection;
        $requi = "SELECT * FROM `" . $this->Table . "`";
        $stm = $conn->prepare($requi);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function remove($id)
    {
        $conn = $this->connection;
        $requet = 'DELETE FROM ' . $this->Table . ' WHERE id=:id';
        $stm = $conn->prepare($requet);
        $stm->execute(["id" => $id]);
    }
    public function SelectOne($id)
    {
        $conn = $this->connection;
        $requet = 'SELECT * FROM ' . $this->Table . ' WHERE id=:id';
        $stm = $conn->prepare($requet);
        $stm->execute(["id" => $id]);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function insert($data)
    {
        $con = $this->connection;
        $requi = "INSERT INTO " . $this->Table . "(" . getval($data) . ") VALUES (" . getPlaceholders($data) . ") ";
        $stm = $con->prepare($requi);
        $stm->execute($data) or die($stm->errorCode());
    }
    public function fetchByRef($ref)
    {
        try {
            $conn = $this->connection;
            $requi = 'SELECT * FROM ' . $this->Table . ' WHERE IdUnique=:ref';
            $stm = $conn->prepare($requi);
            $stm->execute(["ref" => $ref]);
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            return false;
        }
    }
}

$mm = new GlobalModel("Clients");
$se = $mm->fetchByRef("halaURIHZERUH");
var_dump($se);

// $tt = new GlobalModel("Clients");
// $sel = $tt->insert($data);

// var_dump($sel);
