<?php

class BabaController extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
    }

    public function indexAction()
    {
        $this->view->render('Tools/index');
    }

    public function firstAction()
    {
        $this->view->render('Tools/first');
    }

    public function secondAction()
    {
        $this->view->render('Tools/secon');
    }
}
