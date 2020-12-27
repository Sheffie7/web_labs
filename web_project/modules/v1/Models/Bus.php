<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buses".
 *
 * @property int $id
 * @property string $driver_name ФИО водителя
 * @property string $plate_num Государственный номер автобуса
 * @property int $seats_amount Количество мест всего
 *
 * @property Trips[] $trips
 */
class Bus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['driver_name', 'plate_num', 'seats_amount'], 'required'],
            [['seats_amount'], 'integer'],
            [['driver_name'], 'string', 'max' => 45],
            [['plate_num'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'driver_name' => 'Driver Name',
            'plate_num' => 'Plate Num',
            'seats_amount' => 'Seats Amount',
        ];
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trips::className(), ['busId' => 'id']);
    }
}
