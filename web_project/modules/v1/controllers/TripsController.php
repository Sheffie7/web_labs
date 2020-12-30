<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Trip;

class TripsController extends ApiController
{
    public function actionTrip_from_id($id){
        return Trip::find()
            ->where(['id' => $id])
            ->one();
    }

    public function actionTrips($departureId, $destinationId, $departureTime){
        return Trip::find()
            ->joinWith('route')
            ->where(['departureId' => $departureId,
                'destinationId' => $destinationId])
            ->andWhere(['like', 'departureTime', $departureTime])
            ->all();
    }
}