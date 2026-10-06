<?php
require_once __DIR__ . '/classes/Transaction.php';
$transaction = new Transaction();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    try {
        if ($action === 'create' || $action === 'update') {
            $type = $_POST['type'] ?? '';
            $title = trim($_POST['title'] ?? '');
            $amount = (float)($_POST['amount'] ?? 0);
            $date = $_POST['transaction_date'] ?? '';

            if (!in_array($type, ['income','expense'], true) || $title === '' || $amount <= 0 || $date === '') {
                throw new Exception('Please enter valid transaction details.');
            }

            if ($action === 'create') {
                $transaction->create($type, $title, $amount, $date);
            } else {
                $transaction->update((int)$_POST['id'], $type, $title, $amount, $date);
            }
            header('Location: index.php');
            exit;
        }

        if ($action === 'delete') {
            $transaction->delete((int)$_POST['id']);
            header('Location: index.php');
            exit;
        }
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}

$edit = null;
if (isset($_GET['edit'])) {
    $edit = $transaction->find((int)$_GET['edit']);
}
$rows = $transaction->all();
$income = 0;
$expense = 0;

foreach ($rows as $row) {
    if ($row['type'] === 'income') {
        $income += (float)$row['amount'];
    } else {
        $expense += (float)$row['amount'];
    }
}

$balance = $income - $expense;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>OOP Income & Expense Tracker</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Income & Expense Tracker</h1>
<p class="subtitle">Week 2 — Object-Oriented PHP</
