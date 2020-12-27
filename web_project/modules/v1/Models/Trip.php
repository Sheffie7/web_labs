<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trips".
 *
 * @property int $id
 * @property int $busId ID автобуса
 * @property int|null $routeId ID маршрута
 * @property string $departureTime Дата и время отправления из населенного пункта
 * @property string $destinationTime Дата и время прибытия в пункт назначения
 * @property string $createdAt Дата создания
 * @property string|null $updatedAt Дата изменения
 *
 * @property Tickets[] $tickets
 * @property Buses $bus
 * @property Routes $route
 */
class Trip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trips';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['busId', 'departureTime', 'destinationTime', 'createdAt'], 'required'],
            [['busId', 'routeId'], 'integer'],
            [['departureTime', 'destinationTime', 'createdAt', 'updatedAt'], 'safe'],
            [['busId'], 'exist', 'skipOnError' => true, 'targetClass' => Buses::className(), 'targetAttribute' => ['busId' => 'id']],
            [['routeId'], 'exist', 'skipOnError' => true, 'targetClass' => Routes::className(), 'targetAttribute' => ['routeId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'busId' => 'Bus ID',
            'routeId' => 'Route ID',
            'departureTime' => 'Departure Time',
            'destinationTime' => 'Destination Time',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['userId' => 'id']);
    }

    /**
     * Gets query for [[Bus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBus()
    {
        return $this->hasOne(Buses::className(), ['id' => 'busId']);
    }

    /**
     * Gets query for [[Route]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(Routes::className(), ['id' => 'routeId']);
    }
}
