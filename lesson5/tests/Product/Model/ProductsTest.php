<?php declare(strict_types=1);

namespace Product\Model;

include_once 'config/config.php';

use PHPUnit\Framework\TestCase;
use Geekbrains\Product\Model\Products;

class ProductsTest extends TestCase
{
  private $object;

  function setUp() : void
  {
    $this->object = new Products();
  }

  public function testGetById()
  {
    $this->expectException(\Exception::class);
    $this->object->getById(-1);
  }

  public function testIsArrayGetById()
  {
    $this->assertIsObject(
      $this->object->getById(38)
    );
    $this->assertTrue(
      $this->object->getById(38)->getData('title') !== ''
    );
    $this->assertTrue(
      $this->object->getById(38)->getData('price') > 0
    );
  }

  public function testIsImageExistsGetById()
  {
    $this->assertFileExists(
      'C:/xampp/htdocs/' . $this->object->getById(38)->setUrl()->getData('url')
    );
  }

}


