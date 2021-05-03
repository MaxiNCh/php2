<?php 
namespace Geekbrains\Order\Controller;

use Geekbrains\Core\Controller\AbstractController;
use Geekbrains\Order\View\Orders as OrdersView;
use Geekbrains\Order\Model\Orders as OrdersModel;

/**
 *  
 */
class Orders extends AbstractController
{
  
  public function ordersAction()
  {
    $ordersModel = new OrdersModel();
    $orders = $ordersModel->fetchOrders(true)->getOrders();

    $view = new OrdersView();
    $view->setData(['orders' => $orders ])->show();
  }

  public function setStatusAction()
  {
    $orderId = isset($_POST['id']) ? $_POST['id'] : null;
    $newStatus = isset($_POST['status']) ? $_POST['status'] : null;
    if (isset($orderId) && isset($newStatus)) {
      $ordersModel = new OrdersModel();
      $ordersModel->setStatus($orderId, $newStatus);
    }
  }
}
?>
