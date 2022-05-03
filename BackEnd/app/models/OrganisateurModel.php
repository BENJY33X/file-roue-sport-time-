<?php
// require_once "../libraries/GlobalModel.php";
// get_include_path("../libraries/GlobalModel.php");
class OrganisateurModel
{
    public function selectAll()
    {
        $ModelClients = new GlobalModel("Clients");
        $CLIENT = $ModelClients->selectAll();
        return json_encode($CLIENT);
    }
    public function SelectOne($id)
    {
        $ModelClients = new GlobalModel("Clients");
        $CLIENT = $ModelClients->SelectOne($id);
         json_encode($CLIENT);
    }
    public function remove($id)
    {
        $ModelClients = new GlobalModel("Clients");
        $CLIENTS = $ModelClients->remove($id);
        return $CLIENTS;
    }
    public function insert($data)
    {
        $ModelClients = new GlobalModel("Clients");
        $CLIENT = $ModelClients->insert($data);
        json_encode($CLIENT);
    }
    public function fetchByRef($Ref)
    {
        $ModelClients = new GlobalModel("organisateur");
        $CLIENT = $ModelClients->fetchByRef($Ref);
        return $CLIENT;
    }
    public function updateUser($data)
    {
        $conn = $this->db;
        $query = $conn->prepare("UPDATE `utilisateur` SET
                                `Nom`=?,
                                `Prenom`=?,
                                `Age`=?,
                                `Job`=?,
                                `CIN`=?
                                WHERE id=?");
        // var_dump($data);
        // $query->bindParam(':id', $id);
        // $query->bindParam(':Nom', $data[4]);
        // $query->bindParam(':Prenom', $data["Prenom"]);
        // $query->bindParam(':Age', $data["Age"]);
        // $query->bindParam(':Job', $data["Job"]);
        // $query->bindParam(':CIN', $data["CIN"]);
        $params = array($data["Nom"], $data["Prenom"], $data["Age"], $data["Job"], $data["CIN"], $data["id"]);
        return $query->execute($params);
    }
}



