# Internship Project Report

## Project Title
OOP Income & Expense Tracker

## Introduction
The OOP Income & Expense Tracker is a web-based application developed using Object-Oriented PHP. It helps users manage their income and expense transactions in a simple and organized way.

## Objective
The main objective of this project is to create a basic financial management system using PHP, MySQL and Object-Oriented Programming concepts.

## Features
- Add income transactions
- Add expense transactions
- View all transactions
- Edit transactions
- Delete transactions
- Calculate total income
- Calculate total expense
- Calculate current balance
- MySQL database integration
- Responsive user interface

## Technologies Used
- PHP 8+
- Object-Oriented PHP
- MySQL
- PDO
- HTML5
- CSS3
- JavaScript

## Database
The project uses a MySQL database named `income_expense`.

The `transactions` table stores:
- Transaction ID
- Transaction Type
- Title
- Amount
- Transaction Date
- Created Date

## OOP Implementation
The project uses a PHP class named `Transaction` to handle database operations such as:

- Create
- Read
- Update
- Delete

PDO is used for secure database communication and prepared statements are used for database queries.

## Project Structure
```text
classes/
    Transaction.php

config/
    Database.php

database.sql
index.php
style.css
README.md
REPORT.md
