<?php

namespace Geekbrains\Order\Model;

use Geekbrains\Core\Model\OrdersAbstractModel;

class Orders extends OrdersAbstractModel
{
    public $tableName = 'orders';

    public function getOrders() : array
    {
        return $this->params;
    }

    public function setStatus($id, $newStatus) : void
    {
      $sql = "UPDATE $this->tableName SET status = '$newStatus' WHERE id = '$id'";
      $this->db->query($sql);
    }
    
}