<?php
//200

namespace app\modules\v1\controllers;

use app\modules\v1\models\User;
use yii\web\NotAcceptableHttpException;

class UsersController extends ApiController {
    public function actionLogin($phone, $password) {
        $form = User::find()
            ->where(['phone' => $phone])
            ->one();
        if ($form != null or $form != ''){
            if ($form->checkPass($password))
                return $form->getUser();
        }
        throw new NotAcceptableHttpException('Пожалуйста, проверьте правильность написания логина и пароля.'); //406
    }

    public function actionRegister() {
        $data = \Yii::$app->request->getBodyParams();
        if (User::find()
                ->where(['phone' => $data['phone']])
                ->one() != null){
            throw new NotAcceptableHttpException('Номер телефона занят.');   //406
        }

        $user = new User();
        $user->load($data, '');
        $str = strpos($user->getAttribute('phone'), "@");
        $user->setAttribute('name', substr($user->getAttribute('phone'), 0, $str));
        $user->save();
        return $user;
    }
}
