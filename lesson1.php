<?php 

///////////////////
// Задания 1 - 4 //
///////////////////


/**
 * Класс футбольного игрка. Есть свойства скорость и максимальная скорость.
 */
class FootballPlayer 
{
  private $speed;
  private $maxSpeed;

  function __construct($maxSpeed)
  {
    $this->maxSpeed = $maxSpeed;
  }

  public function run() :void
  {
    $this->speed = $this->maxSpeed;
  }

  public function getSpeed() : Int
  {
    return $this->speed;
  }

}

/**
 * Создаем наследуемый класс Голкипера.
 * У которого добавляются свойста прыжка и максимального прыжка.
 */
class Goalkeeper extends FootballPlayer
{
  private $jumpHeight;
  private $maxJumpHeight;

  function __construct($maxSpeed, $maxJumpHeight)
  {
    parent::__construct($maxSpeed);
    $this->maxJumpHeight = $maxJumpHeight;
  }
  public function jump() :void
  {
    $this->jumpHeight = $this->maxJumpHeight;
  }
  public function getJumpHeight() : Int
  {
    return $this->jumpHeight;
  }
}

$max = new Goalkeeper(10, 20);
$max->jump();
echo $max->getJumpHeight() . "<br>";


///////////////
// Задание 5 //
///////////////


class C {
  public function foo() {
    static $x = 0;
    echo ++$x;
  }
}
$a1 = new C(); // создание объекта a1
$a2 = new C(); // создание второго объекта a2
$a1->foo(); // 1 
$a2->foo(); // 2
$a1->foo(); // 3
$a2->foo(); // 4 
echo "<br>";

// Будет выведено 1, 2, 3, 4,
// потому что в методе foo идет обращение к статической переменной класса.
// Поэтому при обращении к методу foo разных объектов инкрементируется одна переменная.
// 
// Но на самом деле мне непонятно следующее:
// По идее мы каждый раз присваиваем переменной значение 0,
// а потом она уже должна инкрементироваться. Т.е. логично было бы 1 1 1 1
// Или в PHP начальное значение присваевается один раз,
// когда переменная в первый раз декларируется...

/////////////////
//  Задание 6  //
/////////////////

class A {
  public function foo() {
    static $x = 0;
    echo ++$x;
  }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2
echo "<br>";

// В данном случае две статитеческие переменные $x,
// которые принадлежат к разным классам, поэтому они по очереди инкрементся. 

/////////////////
//  Задание 7  //
/////////////////

class D {
  public function foo() {
    static $x = 0;
    echo ++$x;
  }
}
class E extends D {
}
$a1 = new D;
$b1 = new E;
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2

// Результат такой же, как в предыдущем задании. Если конструктор не трубует входящих параметров,
// то скобочки при создании объекта класса можно опустить.

?>