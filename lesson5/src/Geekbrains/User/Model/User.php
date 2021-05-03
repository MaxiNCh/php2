<?php

namespace Geekbrains\User\Model;

use Geekbrains\Core\Model\AbstractModel;

class User extends AbstractModel
{
    public $authorized = false;
    public $tableName = 'users';

    public function getNameById(int $id) : string
    {
        return $this->getById($id)->getData('name');
    }

    public function getUserExists(int $id) : bool
    {
        return !empty($this->getById($id)->getData('id'));
    }

    public function authorizeUser(string $login, string $password): bool
    {
        $this->getByLogin($login);
        
        if (!empty($this->getData()) && password_verify($password, $this->getData('password'))) {
            $this->authorized = true;
        } else {
            $this->authorized = false;
        }
        return $this->authorized;
    }
}