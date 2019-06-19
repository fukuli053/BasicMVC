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
        $contacts = $this->ContactsModel->findAllByUserId(Users::currentUser()->id,["order" => "fname, lname"]);
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
                $contact->user_id = Users::currentUser()->id;
                $contact->save();
                Router::redirect('contacts');
            }
        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render("Contact/add");
    }

    public function detailsAction($id)
    {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);
        if(!$contact){
            Router::redirect('contacts');
        }
        $this->view->contact = $contact;
        $this->view->render('contact/details');
    }

    public function deleteAction($id)
    {
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);
        if($contact){
            $contact->delete();
        }
        Router::redirect('contacts');
    }

    public function editAction($id){
        $contact = $this->ContactsModel->findByIdAndUserId((int)$id, Users::currentUser()->id);
        if(!$contact){
            Router::redirect('contacts');
        }

        $validation = new Validate();
        
        if($_POST){
            $contact->assign($_POST);
            $validation->check($_POST,Contacts::$addValidation);
            if($validation->isPassed()){
                $contact->save();
                Router::redirect('contacts');
            }
        }

        $this->view->displayErrors = $validation->displayErrors();
        $this->view->contact = $contact;
        $this->view->postAction = SROOT . 'contacts' . DS . 'edit' . DS . $contact->id;
        $this->view->render('contact/edit');
    }

}