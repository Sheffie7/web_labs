<?php
//200?

namespace app\modules\v1\models;

use yii\db\ActiveRecord;

class LoginForm extends ActiveRecord {
    public $phone;
    public $password;

    public function rules() {
        return [
            [['phone', 'password'], 'required'],
            [['phone'], 'phone', 'message' => 'Некорректный номер телефона.'],
            [['phone', 'password'], 'string', 'max' => 64, 'min' => 3]
        ];
    }

    public function getUser() {
        $str = strpos($this->phone, "@");
        return [
            'name' => substr($this->phone, 0, $str),
            'phone' => $this->phone,
            'accessToken' => md5(microtime(null))
        ];
    }
}