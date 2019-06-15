<?php 

    class Contacts extends Model {

        public $deleted = 0;

        public function __construct() {
            $table = 'contacts';
            parent::__construct($table);
            $this->_softDelete = true;
        }

        public static $addValidation = [
            'fname' =>[
                "display" => "Ad",
                "required" => true
            ],
            "lname" => [
                "display" => "Soyad",
                "required" => true
            ],
            "email" => [
                "display" => "E-Posta",
                "valid_email" => true
            ]
        ];

        public function findAllByUserId($user_id, $params = [])
        {
            $conditions = [
                'conditions' => 'user_id = ?',
                'bind' => [$user_id]
            ];

            $conditions = array_merge($conditions, $params);
            return $this->find($conditions);
        }

        public function FullName()
        {
            return $this->fname . ' ' . $this->lname;
        }

    }