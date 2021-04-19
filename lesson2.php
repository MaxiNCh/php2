<?php
/**
 * Интерфес для товаров, которые можно посчитать.
 * Т.е. Кроме цифровых товаров.
 */
interface CountableGood
{
  public function getQuantity();
  public function setQuantity(int $qty);
}

/**
 * Абстрактный базовый класс для товаров.
 */
abstract class Good {
  protected int $costPrice;
  protected int $amount;
  protected int $quantity = 1;

  public function __construct(int $costPrice)
  {
    $this->costPrice = $costPrice;
  }

  abstract protected function getPrice();

  // Рассчитываем прибыль всего количества товара
  private function calculateMargin() : int
  {
    return $this->amount - $this->costPrice * $this->quantity;
  }

  // Считаем стоимость всего количества
  public function calculateAmount() : void
  {
    $this->amount = $this->getPrice() * $this->quantity;
  }

  public function printAmount() : void
  {
    echo 'Amount: ' . $this->amount . ' rub<br>';
  }

  public function printMargin() : void 
  {
    echo 'Margin: ' . $this->calculateMargin() . ' rub<br>';
  }
}

/**
 * Класс цифрового товара
 */
class DigitalGood extends Good {
  public function __construct(int $costPrice)
  {
    parent::__construct($costPrice);
  }

  protected function getPrice() : int
  {
    return $this->costPrice * 1.5;
  }
}

/**
 * Класс штучного товара
 */
class RegularGood extends Good implements CountableGood
{
  public function __construct(int $costPrice)
  {
    parent::__construct($costPrice);
  }

  protected function getPrice() : int
  {
    return $this->costPrice * 3;
  }

  public function getQuantity() : int
  {
    return $this->quantity;
  }

  public function setQuantity(int $qty) : void
  {
    $this->quantity = $qty;
  }
}

/**
 * Класс весового товара
 */
class WeightGood extends Good implements CountableGood
{
  public function __construct(int $costPrice)
  {
    parent::__construct($costPrice);
  }

  protected function getPrice() : int
  {
    if ($this->quantity < 2.5)
      return $this->costPrice * 3;
    elseif ($this->quantity >= 2.5 && $this->quantity < 20)
      return $this->costPrice * 3 * 0.8;
    else 
      return $this->costPrice * 3 * 0.4;
  }

  public function getQuantity() : int
  {
    return $this->quantity;
  }

  public function setQuantity(int $qty) : void
  {
    $this->quantity = $qty;
  }
}

$eBook = new DigitalGood(300);
$eBook->calculateAmount();
$eBook->printAmount();
$eBook->printMargin();
echo '<br>';

$book = new RegularGood(300);
$book->setQuantity(5);
$book->calculateAmount();
$book->printAmount();
$book->printMargin();
echo '<br>';

$apple = new WeightGood(80);
$apple->setQuantity(19);
$apple->calculateAmount();
$apple->printAmount();
$apple->printMargin();
$apple->setQuantity(20);
$apple->calculateAmount();
$apple->printAmount();
$apple->printMargin();

?>
