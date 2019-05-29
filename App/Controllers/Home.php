<?php

class Home extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function indexAction()
    {
        $db = DB::getInstance();
        $za = [
            "conditions" => ['adi = ?', 'soyadi = ?'],
            'bind' => ['furkan', 'adam'],
            'order' => "adi, soyadi",
            'limit' => 5
        ];
        $contactsQ = $db->find('iletisim', $za);
        dnd($contactsQ);
        $this->view->render("Home/index");
    }
}
