<?php 

class RestrictedController extends Controller{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        $this->view->render('Restricted/index');
    }

    public function badTokenAction()
    {
        $this->view->render('Restricted/badToken');
    }

}
