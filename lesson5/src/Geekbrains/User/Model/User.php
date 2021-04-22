<?php

namespace Geekbrains\User\Model;

use Geekbrains\Core\Model\AbstractModel;

class User extends AbstractModel
{
    public $tableName = 'user';

    public function getNameById(int $id) : string
    {
        return $this->getById($id)->getData('name');
    }

    public function getUserExists(int $id) : bool
    {
        return !empty($this->getById($id)->getData('id'));
    }
}