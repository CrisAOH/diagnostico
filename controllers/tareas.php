<?php
require_once(__DIR__."/sistema.php");
class Tarea extends Sistema
{
    public function get($id = null)
    {
        $this->db();
        if (is_null($id)) {
            $sql = "select * from tarea t join estado_tarea ed on t.id_estado = ed.id_estado";
            $st = $this->db->prepare($sql);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $sql = "select * from tarea t join estado_tarea ed on t.id_estado = ed.id_estado where id_tarea = :id";
            $st = $this->db->prepare($sql);
            $st->bindParam(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $data = $st->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function new($data)
    {
        $this->db();
        $sql = "insert into tarea (descripcion, id_estado) 
        values (:descripcion, :id_estado)";
        $st = $this->db->prepare($sql);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":id_estado", $data['id_estado'], PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function edit($id, $data)
    {
        $this->db();
        $sql = "update tarea set descripcion = :descripcion, id_estado = :id_estado
        where id_tarea = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":descripcion", $data['descripcion'], PDO::PARAM_STR);
        $st->bindParam(":id_estado", $data['id_estado'], PDO::PARAM_INT);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }

    public function delete($id)
    {
        $this->db();
        $sql = "delete from tarea where id_tarea = :id";
        $st = $this->db->prepare($sql);
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $rc = $st->rowCount();
        return $rc;
    }
}
$tarea = new Tarea;
?>