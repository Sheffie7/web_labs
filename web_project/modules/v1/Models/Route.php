<?php
//200

namespace app\modules\v1\models;

use app\modules\v1\models\BaseModel;

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
 * @property Station $departure
 * @property Station $destination
 * @property Trip[] $trips
 */
class Route extends BaseModel
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
            [['departureId'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['departureId' => 'id']],
            [['destinationId'], 'exist', 'skipOnError' => true, 'targetClass' => Station::className(), 'targetAttribute' => ['destinationId' => 'id']],
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
        return $this->hasOne(Station::className(), ['id' => 'departureId']);
    }

    /**
     * Gets query for [[Destination]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestination()
    {
        return $this->hasOne(Station::className(), ['id' => 'destinationId']);
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['routeId' => 'id']);
    }
}
