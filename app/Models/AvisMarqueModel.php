<?php

class AvisMarqueModel extends Model{

    public function insert($data)
    {
        $this->connect();
        $request = $this->connection->prepare("INSERT INTO avis_marque(user_id,marque_id,valide,note,avis,appreciation) VALUES (?,?,?,?,?,?)");
        $request->execute(array($data['user_id'], $data['marque_id'], $data['valide'],$data['note'], $data['avis'], $data['appreciation']));
        $this->disconnect();
    }

    public function delete($id)
    {
        $this->connect();
        $this->request($this->connection,"delete from avis_marque where avis_marque_id = $id");
        $this->disconnect();
    }

    public function update($data)
    {
        $this->connect();
        $request = $this->connection->prepare("UPDATE avis_marque SET  user_id = :user_id, marque_id = :marque_id, valide = :valide,note = :note, avis = :avis, appreciation = :appreciation WHERE (avis_marque_id = :avis_marque_id)");
        $request->bindValue(':user_id', $data['user_id']);
        $request->bindValue(':marque_id', $data['marque_id']);
        $request->bindValue(':valide', $data['valide']);
        $request->bindValue(':note', $data['note']);
        $request->bindValue(':avis', $data['avis']);
        $request->bindValue(':appreciation', $data['appreciation']);
        $request->bindValue(':avis_marque_id', $data['avis_marque_id']);
        $request->execute();
        $this->disconnect();
    }

    public function get($id)
    {
        $this->connect();
        $data = $this->request($this->connection,"select * from avis_marque where avis_marque_id = $id");
        $this->disconnect();
        return $data[0];
    }

    public function getAll()
    {
        $this->connect();
        $data = $this->request($this->connection,"select * from avis_marque");
        $this->disconnect();
        return $data;
    }

    public function getAllWithUsernames(){
        $this->connect();
        $data = $this->request($this->connection,"select a.*,u.nom,u.prenom from avis_marque as a join user as u on u.user_id = a.user_id");
        $this->disconnect();
        return $data;
    }

    public function getAllWithUsernamesForMarque($id){
        $this->connect();
        $data = $this->request($this->connection,"select a.*,u.nom,u.prenom from avis_marque as a join user as u on u.user_id = a.user_id where a.marque_id = $id");
        $this->disconnect();
        return $data;
    }
}

