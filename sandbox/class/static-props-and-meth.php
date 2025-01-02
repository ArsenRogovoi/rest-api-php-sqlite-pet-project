<?php
// example of using static property in class:

// class User
// {
//     public static $userCount = 0; // Статическое свойство для подсчета пользователей

//     public function __construct()
//     {
//         self::$userCount++; // Увеличиваем счетчик при создании объекта
//     }

//     public static function getUserCount()
//     {
//         return self::$userCount; // Возвращаем количество пользователей
//     }
// }

// $user1 = new User();
// $user2 = new User();
// $user3 = new User();

// echo User::getUserCount(); // Результат: 3

//------------------------

// static methods let in the class let us to use them without creating class object:

// class Calculator
// {
//     public static function add($a, $b)
//     {
//         return $a + $b;
//     }
//     public static function subtract($a, $b)
//     {
//         return $a - $b;
//     }
// }

// echo Calculator::add(1, 2);
// echo '<br>';
// echo Calculator::subtract(3, 4);
