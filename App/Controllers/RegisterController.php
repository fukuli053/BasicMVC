<?php

class RegisterController extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function loginAction()
    {
        $validation = new Validate();
        if ($_POST) {
            //form validation
            $validation->check($_POST, [
                'username' => [
                    'display' => 'Kullanıcı Adı',
                    'required' => true
                ],
                'password' => [
                    'display' => 'Password',
                    'required' => true,
                    'min' => 6,
                    'max' => 8
                ]
            ]);
            if ($validation->isPassed()) {
                $user = $this->UsersModel->findByUserName($_POST['username']);
                if ($user && password_verify(Input::get('password'), $user->password)) {
                    $remember = (isset($_POST["rememberMe"]) && Input::get('rememberMe')) ? true : false;
                    $user->login($remember);
                    Router::redirect('');
                } else {
                    $validation->addError("There is an error at your username or password.");
                }
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('Register/login');
    }

    public function logoutAction()
    {
        if (currentUser()) {
            currentUser()->logout();
        }
        Router::redirect('register/login');
    }

    public function registerAction()
    {
        $validation = new Validate();
        if ($_POST) {
            $posted_values = posted_values($_POST);
            $validation->check($_POST, [
                'fname' => [
                    'display' => 'First Name',
                    'required' => true
                ],
                'lname' => [
                    'display' => 'Last Name',
                    'required' => true
                ],
                'username' => [
                    'display' => 'Username',
                    'required' => true,
                    'unique' => 'users',
                    'min' => 4,
                    'max' => 30
                ],
                'password' => [
                    'display' => 'Şifre',
                    'required' => true,
                    'min' => 6,
                    'max' => 20
                ],
                'confirm' => [
                    'display' => 'Onaylı Şifre',
                    'required' => true,
                    'matches' => 'password'
                ],
                'email' => [
                    'display' => 'Email',
                    'required' => true,
                    'unique' => 'users',
                    'max' => 150,
                    'valid_email' => true
                ]
            ]);

            if ($validation->isPassed()) {
                $newUser = new Users();
                $newUser->registerNewUser($_POST);
                Router::redirect('register/login');
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('Register/register');
    }
}
