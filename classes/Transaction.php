<?php
require_once __DIR__ . '/../config/Database.php';

class Transaction {
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function create(string $type, string $title, float $amount, string $date): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO transactions (type, title, amount, transaction_date)
             VALUES (:type, :title, :amount, :transaction_date)"
        );
        return $stmt->execute([
            ':type' => $type, ':title' => $title,
            ':amount' => $amount, ':transaction_date' => $date
        ]);
    }

    public function all(): array {
        return $this->db->query(
            "SELECT * FROM transactions ORDER BY transaction_date DESC, id DESC"
        )->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function update(int $id, string $type, string $title, float $amount, string $date): bool {
        $stmt = $this->db->prepare(
            "UPDATE transactions
             SET type=:type, title=:title, amount=:amount, transaction_date=:date
             WHERE id=:id"
        );
        return $stmt->execute([
            ':id'=>$id, ':type'=>$type, ':title'=>$title,
            ':amount'=>$amount, ':date'=>$date
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM transactions WHERE id = :id");
        return $stmt->execute([':id'=>$id]);
    }
}
