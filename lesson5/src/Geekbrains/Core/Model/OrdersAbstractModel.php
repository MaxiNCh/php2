<?php

namespace Geekbrains\Core\Model;

use DB;

abstract class OrdersAbstractModel
{

  protected $db;
  protected $tableName;
  protected $params;

  public function __construct()
  {
      $this->db = DB::getDbConnection();
  }

  public function fetchOrders(bool $desc) : self
  {
    $order_by = $desc ? 'ORDER BY `date` DESC' : '';
    $tableName = $this->tableName;
    $columns = "
      (@rownum := @rownum + 1) as num,
      $tableName.id as `order id`,
      users.name,
      $tableName.address,
      $tableName.phone,
      $tableName.date,
      $tableName.status";
    $result = $this->db->query("SELECT $columns FROM $tableName JOIN users ON $tableName.user_id = users.id JOIN (SELECT @rownum := 0) r {$order_by}");
    $this->params = $result->fetchAll();
    return $this;
  }

}