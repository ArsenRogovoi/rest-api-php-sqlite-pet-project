<?php

// Book class exr:

// class Book
// {
//     public $title;
//     public $author;
//     public $year;

//     public function __construct($title, $author, $year)
//     {
//         $this->title = $title;
//         $this->author = $author;
//         $this->year = $year;
//     }

//     public function getDescription()
//     {
//         return ("Название: $this->title, Автор: $this->author, Год: $this->year.");
//     }
// }

// $book = new Book("1984", "Джордж Оруэлл", 1949);
// echo $book->getDescription();

// ----------------------

// BankAccount class:

// class BankAccount
// {
//     public $accountHolder;
//     public $balance;

//     public function __construct($accountHolder)
//     {
//         $this->accountHolder = $accountHolder;
//         $this->balance = 0;
//     }

//     public function deposit($amount)
//     {
//         $this->balance = $this->balance + $amount;
//     }
//     public function withdraw($amount)
//     {
//         if ($amount <= $this->balance) {
//             $this->balance = $this->balance - $amount;
//             return "Now your balance is: " . $this->getBalance();
//         } else {
//             return "You don't have enough money";
//         }
//     }
//     public function getBalance()
//     {
//         return $this->balance;
//     }
// }

// $account = new BankAccount("Иван Иванов");
// $account->deposit(500); // Положить 500
// $account->withdraw(200); // Снять 200
// echo $account->getBalance(); // Результат: 300

// -------------------------------