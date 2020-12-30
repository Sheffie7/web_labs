<?php

namespace app\modules\v1\controllers;
use app\modules\v1\models\Ticket;
use yii\db\Query;

class TicketsController extends ApiController {

    public function actionUser_tickets($userId) {
        return Ticket::find()
            ->where(['userId' => $userId])
            ->all();
    }

    public function actionTrip_empty_seats($tripId){
        return Ticket::find()
            ->with('trip')
            ->where(['tripId' => $tripId, 'userId' => '1'])
            ->all();
    }

    public function actionTrip_tickets($tripId) {
        return Ticket::find()
            ->where(['tripId' => $tripId])
            ->all();
    }

    public function actionTickets() {
        return Ticket::find()
            ->all();
    }

//    public function actionBuy(){
        //TODO :(
//    }
}