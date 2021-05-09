<?php

namespace Geekbrains\Product\Controller;

use Geekbrains\Product\Model\Products as ProductsModel;
use Geekbrains\Product\View\SingleProduct as ProductView;
use Geekbrains\Core\Controller\AbstractController;

/**
 *  
 */
class Product extends AbstractController
{
  
  public function productAction()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $productsModel = new ProductsModel();
      $product = $productsModel->getById($id)->setUrl()->getData();

      $view = new ProductView();
      $view->setData(['product' => $product])->show();

    } else {
      throw new Exception("ID of product was not specified", 1);
      
    }
  }
}

?>