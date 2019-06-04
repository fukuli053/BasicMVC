<?php

class Home extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        print_r($_COOKIE);
        $this->view->render("Home/index");
    }
}
