<?php

namespace App\Models;
use Core\Model;
use Core\Session;
use Core\Cookie;
use Core\Validators\RequiredValidator;
use Core\Validators\MinimumValidator;
use Core\Validators\EmailValidator;
use Core\Validators\Unique;
use Core\Validators\MatchesValidator;
use App\Models\UserSessions;
use App\Models\Users;

class Users extends Model
{
    public $id, $username, $email, $password, $fname, $lname, $telephone, $acl, $deleted = 0;
    private $_isLoggedIn, $_sessionName, $_cookieName, $_confirm;
    public static $currentLoggedInUser = null;

    public function __construct($user = '')
    {
        $table = 'users';
        parent::__construct($table);
        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_softDelete = true;
        if ($user != '') {
            if (is_int($user)) {
                $u = $this->_db->findFirst($table, ['conditions' => 'id = ?', 'bind' => [$user]], 'App\Models\Users');
            } else {
                $u = $this->_db->findFirst($table, ['conditions' => 'username = ?', 'bind' => [$user]], 'App\Models\Users');
            }
            if ($u) {
                foreach ($u as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function validator()
    {
        $this->runValidation(new MinimumValidator($this ,['field' => 'username', 'rule' => 4, 'message' => 'Kullanıcı adı minimum 6 karakter olmalıdır.']));
        $this->runValidation(new RequiredValidator($this ,['field' => 'username', 'message' => 'Kullanıcı adı boş bırakılmaz']));
        $this->runValidation(new Unique($this, ['field' => 'username', 'message' => 'Bu kullanıcı adı zaten alınmış. Başka bir kullanıcı adı deneyin.']));
        
        $this->runValidation(new EmailValidator($this ,['field' => 'email', 'message' => 'Lütfen geçerli bir e-posta adresi giriniz.']));
        $this->runValidation(new RequiredValidator($this ,['field' => 'email', 'message' => 'E-posta adresi boş bırakılmaz']));

        $this->runValidation(new RequiredValidator($this, ['field' => 'password', "message" => "Lütfen şifre alanını boş bırakmayınız."]));
        $this->runValidation(new MatchesValidator($this, ['field' => 'password', "rule" => $this->_confirm, "message" => "Girdiğiniz şifreler eşleşmiyor."]));
        $this->runValidation(new MinimumValidator($this ,['field' => 'password', 'rule' => 6, 'message' => 'Şifreniz minimum 6 karakter olmalıdır.']));
    }

    public function beforeSave()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function findByUsername($username)
    {
        return self::findFirst(['conditions' => 'username = ?', 'bind' => [$username]]);
    }

    public function login($rememberMe = false)
    {
        Session::set($this->_sessionName, $this->id);
        if ($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->_db->insert('user_sessions', $fields);
        }
    }

    public static function currentUser()
    {
        if (!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $U = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentLoggedInUser = $U;
        }
        return self::$currentLoggedInUser;
    }

    public static function loginUserFromCookie()
    {
        $userSession = UserSessions::getFromCookie();
        if ($userSession->user_id != '') {
            $user = new self((int)$userSession->user_id);
        }
        if ($user) {
            $user->login();
        }
        return $user;
    }

    public function logout()
    {
        $userSession = UserSessions::getFromCookie();
        if ($userSession) $userSession->delete();
        Session::delete(CURRENT_USER_SESSION_NAME);
        if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        return true;
    }

    public function acls()
    {
        if(empty($this->acl)) return [];
        return json_decode($this->acl, true);
    }

    public function setConfirm($value)
    {
        $this->_confirm = $value;
    }

    public function getConfirm()
    {
        return $this->_confirm;
    }

}
