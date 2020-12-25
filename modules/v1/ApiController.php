<?php

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
                'class' => Cors::class
            ]
        ];
    }
}
//        $behaviors = parent::behaviors();

//        // remove authentication filter
//        $auth = $behaviors['authenticator'];
//        unset($behaviors['authenticator']);
//
//        // add CORS filter
//        $behaviors['corsFilter'] = [
//            'class' => \yii\filters\Cors::className(),
//        ];
//
//        // re-add authentication filter
//        $behaviors['authenticator'] = $auth;
//        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
//        $behaviors['authenticator']['except'] = ['options'];
//
//        return $behaviors;

//        return[
//            'corsFilter'  => [
//                'class' => Cors::className(),
//                'cors'  => [
//                    // restrict access to domains:
//                    'Origin'                           => static::allowedDomains(),
//                    'Access-Control-Request-Method'    => ['*'],
//                    'Access-Control-Allow-Credentials' => true,
//                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
//                ],
//            ],
//        ];

//        $behaviors = parent::behaviors();
//
//        $behaviors['corsFilter'] = [
//            'class' => \yii\filters\Cors::class,
//            'cors' => [
//                // restrict access to
//                'Origin' => ['http://vue.home'],
//                // Allow only POST and PUT methods
//                'Access-Control-Request-Methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
//                // Allow only headers 'X-Wsse'
//                'Access-Control-Request-Headers' => ['Content-Type', 'Authorization'],
//                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
//                'Access-Control-Allow-Credentials' => true,
//                // Allow OPTIONS caching
//                'Access-Control-Max-Age' => 3600,
//                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
//                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
//            ],
//        ];
//
//        unset($behaviors['authenticator']);
//        $behaviors['authenticator'] = [
//            'class' =>  HttpBearerAuth::class,
//            'except' => ['options'],
//        ];
//        $behaviors['authenticator']['except'] = ['login'];
//
//        $behaviors['access'] = [
//            'class' => AccessControl::class,
//            'rules' => [
//                [
//                    'allow' => true,
//                    'roles' => ['@'],
//                ],
//                [
//                    'allow' => true,
//                    'actions' => ['login'],
//                    'roles' => ['?']
//                ]
//            ],
//        ];
//
//        return $behaviors;
//    }
