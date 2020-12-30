<?php
//200

namespace app\modules\v1\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

//use yii\filters\auth\HttpBearerAuth;
//use yii\filters\AccessControl;

class ApiController extends Controller
{
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
            ],
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                ]
            ]
        ];
    }
}

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//
//        // add CORS filter
//        $behaviors['corsFilter'] = [
//            'class' => \yii\filters\Cors::className(),
//            'cors' => [
//                'Origin' => ['*'],
//                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
//                'Access-Control-Allow-Credentials' => true,
//            ],
//
//        ];
//
//
//        unset($behaviors['authenticator']);
//        $behaviors['authenticator'] = [
//            'class' =>  HttpBearerAuth::className(),
//        ];
//
//        $behaviors['access'] = [
//            'class' => AccessControl::className(),
//            'rules' => [
//                [
//                    'allow' => true,
//                    'roles' => ['@'],
//                ],
//            ],
//        ];
//
//        return $behaviors;
//    }
//}