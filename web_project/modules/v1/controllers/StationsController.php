<?php
//200

namespace app\modules\v1\controllers;

use app\modules\v1\models\Station;

class StationsController extends ApiController
{
    public function actionStation($id)
    {
        return Station::find()
        ->where(['id' => $id])
        ->one();
    }
    public function actionAll_departures()
    {
        return Station::find()
        ->orderBy(['name' => SORT_ASC])
        ->all();
    }
    public function actionAll_destinations()
    {
        return Station::find()
        ->orderBy(['name' => SORT_ASC])
        ->all();
    }
}