<?php declare(strict_types=1);

namespace Product\Controller;

include_once 'config/config.php';

use PHPUnit\Framework\TestCase;
use Geekbrains\Product\Controller\Product;
use Geekbrains\Product\Controller\NoIdException;

/**
 * 
 */
class ProductTest extends TestCase
{
  
  private $object;

  protected function setUp() : void
  {
    $this->object = new Product([]);
  }

  // Проверяем, что есть исключение, если не передан ID
  function testNoIdProductAction()
  {
    $this->expectException(NoIdException::class);
    $this->expectExceptionMessage('ID of product was not specified');
    $this->object->productAction();
   
  }

  // Проверяем, что есть кнопка добавить в корзину
  public function testNoItemProductAction()
  {
    $_GET['id'] = 10;
    $this->expectOutputRegex('/Add to cart/');
    $this->object->productAction();
    $this->assertNull(
      $this->object->productAction()
    );
  }

  public function testIsHtmlProductAction()
  {
    $_GET['id'] = 38;
    $this->expectOutputRegex('/^<html>.*/');
    $this->object->productAction();
  }


  public function tearDown() : void 
  {
    unset($_GET['id']);
  }
}