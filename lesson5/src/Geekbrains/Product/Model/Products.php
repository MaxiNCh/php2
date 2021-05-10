<?php

namespace Geekbrains\Product\Model;

use Geekbrains\Core\Model\AbstractModel;

class Products extends AbstractModel
{
  protected $tableName = 'products';
  protected $URL = '/images/';
  protected $DIR = "C:/Users/Maxim/Pictures/Saved Pictures/";

  public function setUrl() : self
  {
    $url = $this->URL . $this->getData('name');
    $this->setData('url', $url);
    return $this;
  }

  public function getById(int $id) : self
  {
    $stm = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE id = ?");
    $stm->bindValue(1, $id);
    $stm->execute();
    $this->params = $stm->fetch();
    if ($this->params !== false) {
      return $this;
    } else {
      throw new \Exception('There is no product with such id');
    }
  }
} 