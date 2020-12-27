<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "routes".
 *
 * @property int $id
 * @property int $departureId ID пункта отправления
 * @property int $destinationId ID пункта прибытия
 * @property string $name Название маршрута
 * @property float $price Стоимость маршрута
 * @property string $createdAt Дата создания
 * @property string|null $updatedAt Дата изменения
 *
 * @property Stations $departure
 * @property Stations $destination
 * @property Trips[] $trips
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'routes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['departureId', 'destinationId', 'name', 'price', 'createdAt'], 'required'],
            [['departureId', 'destinationId'], 'integer'],
            [['price'], 'number'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name'], 'string', 'max' => 65],
            [['departureId'], 'exist', 'skipOnError' => true, 'targetClass' => Stations::className(), 'targetAttribute' => ['departureId' => 'id']],
            [['destinationId'], 'exist', 'skipOnError' => true, 'targetClass' => Stations::className(), 'targetAttribute' => ['destinationId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'departureId' => 'Departure ID',
            'destinationId' => 'Destination ID',
            'name' => 'Name',
            'price' => 'Price',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Departure]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeparture()
    {
        return $this->hasOne(Stations::className(), ['id' => 'departureId']);
    }

    /**
     * Gets query for [[Destination]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestination()
    {
        return $this->hasOne(Stations::className(), ['id' => 'destinationId']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trips::className(), ['routeId' => 'id']);
    }
}
