<?php

class Register extends Controller
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
                }else{
                    $validation->addError("There is an error at your username or password.");
                }
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('Register/login');
    }
}
