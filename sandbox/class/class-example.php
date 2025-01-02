<?php
// Пример класса
class Car
{
    public $brand; // Свойство для хранения бренда машины
    public $color; // Свойство для хранения цвета машины

    // Конструктор вызывается при создании объекта
    public function __construct($brand, $color)
    {
        $this->brand = $brand; // Устанавливаем бренд
        $this->color = $color; // Устанавливаем цвет
    }

    // Метод для описания машины
    public function describe()
    {
        return "Это $this->color $this->brand.";
    }
}

// Создаем объект класса Car
$myCar = new Car("Toyota", "красный");

// Выводим информацию о машине
echo $myCar->describe(); // Выведет: Это красный Toyota.
