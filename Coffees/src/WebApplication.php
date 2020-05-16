<?php


namespace Tudublin;


class WebApplication
{
    private $mainController;
    private $coffeeController;
    private $loginController;
    private $adminController;

    public function __construct()
    {
        $this->mainController = new MainController();
        $this->coffeeController = new CoffeeController();
        $this->loginController = new LoginController();
        $this->adminController = new AdminController();

    }

    public function run()
    {
        $action = filter_input(INPUT_GET, 'action');
        if (empty($action)) {
            $action = filter_input(INPUT_POST, 'action');
        }

        $module = filter_input(INPUT_POST, 'module');
        if (empty($module)) {
            $module = filter_input(INPUT_POST, 'module');
        }

        switch ($module) {
            case 'admin' :
                if ($this->loginController->isGranted('ROLE_ADMIN')) {
                    $this->adminFunctions($action);
                } else {
                    $this->coffeeController->error('you are not authorized for this action');
                }
                break;

            default:
                $this->defaultFunctions($action);
        }
    }

    public function adminFunctions($action)
    {
        switch ($action) {

            case 'processUser' :
                $this->adminController->processNewUser();
                break;

            case 'newUserForm' :
                $this->adminController->newUserForm();
                break;

            default:
                $this->mainController->home();

        }
    }

    public function defaultFunctions($action)
    {
        switch ($action) {

            case 'processLogin' :
                $this->loginController->processLogin();
                break;

            case 'login' :
                $this->loginController->loginForm();
                break;

            case 'logout' :
                $this->loginController->logout();
                break;

            case 'editCoffee' :
                $this->coffeeController->edit();
                break;

            case  'processEditCoffee' :
                if ($this->loginController->isLoggedIn()) {
                    $this->coffeeController->processUpdateCoffee();
                } else {
                    $this->coffeeController->error('You are not authroised for this action');
                }
                break;

            case 'newCoffeeForm':
                $this->coffeeController->createForm();
                break;

            case 'processNewCoffee' :
                if ($this->loginController->isLoggedIn()) {
                    $this->coffeeController->processNewCoffee();
                } else {
                    $this->coffeeController->error('You are not authroised for this action');
                }
                break;

            case 'deleteCoffee':
                if ($this->loginController->isLoggedIn()) {
                    $this->coffeeController->delete();
                } else {
                    $this->coffeeController->error('You are not authroised for this action');
                }
                break;

            case 'about':
                $this->mainController->about();
                break;

            case 'contact':
                $this->mainController->contact();
                break;

            case 'map':
                $this->mainController->map();
                break;

            case 'coffeeList':
                $this->coffeeController->coffeeList();
                break;

            default:
                $this->mainController->home();
        }

    }
}