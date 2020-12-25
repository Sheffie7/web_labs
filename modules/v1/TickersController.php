<?php

namespace app\modules\v1\controllers;


class TicketsController extends ApiController {
    public function actionDeparture_stations() {
        return [
            ['text' => 'Губкин', 'value' => 'Губкин']
        ];
    }
    public function actionArrival_stations() {
        return [
            ['text' => 'Белгород', 'value' => 'Белгород'],
            ['text' => 'Воронеж', 'value' => 'Воронеж'],
            ['text' => 'Курск', 'value' => 'Курск'],
        ];
    }
    public function actionBuses() {
        return [
            [   'departure' => 'Губкин',
                'departureTime'=> '7:00',
                'destination'=> 'Белгород',
                'destinationTime' => '8:45',
                'Bus' => 'Губкин - Белгород №1',
                'Price' => '297 руб',
                'EmptySeats' => '20'
            ],

            [   'departure' => 'Губкин',
                'departureTime'=> '6:50',
                'destination'=> 'Воронеж',
                'destinationTime' => '9:25',
                'Bus' => 'Губкин - Воронеж №1',
                'Price' => '323 руб',
                'EmptySeats' => '40'
            ],

            [   'departure' => 'Губкин',
                'departureTime'=> '12:50',
                'destination'=> 'Курск',
                'destinationTime' => '15:35',
                'Bus' => 'Губкин - Курск №1',
                'Price' => '398 руб',
                'EmptySeats' => '20'
            ]
        ];
    }
}