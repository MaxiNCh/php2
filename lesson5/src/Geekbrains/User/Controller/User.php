<?php

namespace Geekbrains\User\Controller;

use Geekbrains\Core\Controller\AbstractController;
use Geekbrains\User\View\Authorization;
use Geekbrains\User\View\Message;
use Geekbrains\User\View\Profile;
use Geekbrains\User\Model\User as UserModel;
use Geekbrains\User\View\User as UserView;

class User extends AbstractController
{
    public function indexAction()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header('Location: ../profile/');
        } else {
            $view = new Authorization();
            $view->show();
        }
    }

    public function authorizationAction()
    {
        session_start();
        $user = new UserModel();
        if (isset($_POST['login'])
            && isset($_POST['password'])
            && $user->authorizeUser($_POST['login'], $_POST['password'])
        ) {
            $_SESSION['login'] = $user->getData('login');
            header('Location: ../profile/');

        } else {
            echo 'Login or password is invalid';
        }
    }

    public function profileAction()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            $user = new UserModel();
            $view = new Profile();
            $userData = $user->getByLogin($_SESSION['login'])->getData();
            $view->setData(['userData' => [
                'Name' => $userData['name'],
                'Login' => $userData['login'],
                'Email' => $userData['email'],
                'Admin rights' => $userData['admin'] === '1' ? 'Yes' : 'No'
            ]])->show();
        } else {
            header('Location: ../index/');
        }
    }

    public function signOutAction()
    {
        session_start();
        unset($_SESSION['login']);
        header('Location: ../index/');
    }

    public function showNameAction()
    {
        if (!isset($_GET['id'])) {
            throw new \Exception("No id!");
        }
        $userId = (int) $_GET['id'];
        $view = new Message();
        if (!$userId) {
            $view->setData(['message' => 'Не получили ID'])->show();
            return;
        }
        $user = new UserModel();
        $view->setData(
            [
                'message' =>
                    $user->getUserExists($userId) ?
                    $user->getNameById($userId)
                    : 'Пользователь не найден'
            ]
        )->show();
    }

    public function showUserAction()
    {
        if (!isset($_GET['id'])) {
            throw new \Exception("No id!");
        }
        $userId = (int) $_GET['id'];
        if ($userId) {
            $user = new UserModel();
            echo new UserView(['user' => $user->getById($userId)->getData()]);
        }
    }

    public function addUserAction()
    {
        if (!isset($_GET['name'])) {
            throw new \Exception("No name!");
        }
        $userName = $_GET['name'];
        $view = new Message();
        if (!$userName) {
            $view->setData(['message' => 'Данные неполные'])->show();
            return;
        }
        $user = new UserModel();
        $user->setData('name', $userName)->save();
        $view->setData(['message' => 'Пользователь добавлен'])->show();
    }
}