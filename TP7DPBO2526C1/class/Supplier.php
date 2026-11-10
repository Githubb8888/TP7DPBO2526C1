<?php

class Supplier
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM suppliers ORDER BY id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM suppliers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $phone, $email)
    {
        $stmt = $this->db->prepare("INSERT INTO suppliers (name, phone, email) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $phone, $email]);
    }

    public function update($id, $name, $phone, $email)
    {
        $stmt = $this->db->prepare("UPDATE suppliers SET name = ?, phone = ?, email = ? WHERE id = ?");
        return $stmt->execute([$name, $phone, $email, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM suppliers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
