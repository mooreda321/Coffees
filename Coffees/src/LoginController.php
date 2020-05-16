<?php


namespace Tudublin;


class LoginController extends Controller
{
    public function loginForm()
    {
        $template = 'loginForm.html.twig';
        $args = [];
        $html = $this->twig->render($template,$args);
        print $html;
    }

    public function processLogin()
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $role = $this->checkCredentials($username,$password);

        if(!empty($role)) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $maincontroller = new MainController();
            $maincontroller->home();
        }else{
            $coffeeController = new CoffeeController();
            $coffeeController->error('Bad Username or Password');
        }
    }

    public function checkCredentials($username,$password)
    {
        $userRepository = new UserRepository();
        $user = $userRepository->getUserByUserName($username);

        if($user) {
            $passwordFromDatabase = $user->getPassword();
            $role = $user->getRole();
            if(password_verify($password, $passwordFromDatabase)) {
                return $role;
            }
        }
                return '';
    }

    public function logout()
    {
        $_SESSION = [];
        $mainController = new MainController();
        $mainController->home();
    }

    public function isLoggedIn()
    {
        if(isset($_SESSION['username'])){
            return true;
        }
        return false;
    }

    public function roleFromSession()
    {
        if(isset($_SESSION['role'])){
            return $_SESSION['role'];
        }
        return '';
    }

    public function isGranted($role)
    {
        if ($this->isLoggedIn()){
            $roleInSession = $this->roleFromSession();
            if ($role == $roleInSession) {
                return true;
            }
        }
        return false;
    }

}