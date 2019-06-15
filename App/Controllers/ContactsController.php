<?php

class ContactsController extends Controller {

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->view->setLayout('default');
        $this->load_model('Contacts');
    }

    public function indexAction()
    {
        $contacts = $this->ContactsModel->findAllByUserId(currentUser()->id,["order" => "fname, lname"]);
        $this->view->contacts = $contacts;
        $this->view->render("Contact/index");
    }

    public function addAction()
    {   
        $contact = new Contacts();
        $validation = new Validate();
        if($_POST){
            $contact->assign($_POST);
            $validation->check($_POST, Contacts::$addValidation);
            if($validation->isPassed()){
                $contact->user_id = currentUser()->id;
                $contact->deleted = 0;
                $contact->save();
                Router::redirect('contacts/index');
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render("Contact/add");
    }

}