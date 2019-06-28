<?php 

class Login extends Model {
    public $username, $password, $rememberMe;

    public function __construct() {
        parent::__construct('tmp_fake');
    }

    public function validator()
    {
        $this->runValidation(new RequiredValidator($this, ['field' => 'username', "message" => "Lütfen kullanıcı adı alanını boş bırakmayınız."]));
        $this->runValidation(new RequiredValidator($this, ['field' => 'password', "message" => "Lütfen şifre alanını boş bırakmayınız."]));
    }
    
    public function getRememberMeChecked()
    {
        return $this->rememberMe == 'on';
    }
}