<?php

namespace Geekbrains\Product\Model;

use Geekbrains\Core\Model\AbstractModel;

class Products extends AbstractModel
{
  protected $tableName = 'products';
  protected $DIR = "C:/Users/Maxim/Pictures/Saved Pictures/";

  public function setUrl() : self
  {
    $url = $this->DIR . $this->getData('name');
    $this->setData('url', $url);
    return $this;
  }
}