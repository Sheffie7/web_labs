<?php
//200

namespace app\modules\v1\models;

use app\modules\v1\models\BaseModel;

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
 * @property Ticket[] $tickets
 * @property Bus $bus
 * @property Route $route
 */
class Trip extends BaseModel
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
            [['busId'], 'exist', 'skipOnError' => true, 'targetClass' => Bus::className(), 'targetAttribute' => ['busId' => 'id']],
            [['routeId'], 'exist', 'skipOnError' => true, 'targetClass' => Route::className(), 'targetAttribute' => ['routeId' => 'id']],
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

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        $res = [
            'route' => $this->route,
            'bus' => $this->bus,
            'departureTime' => $this->departureTime,
            'destinationTime' => $this->destinationTime
        ];

        return [
            'id' => $this->id,
            'name' => $res['route']['name'],
            'departure' => $res['route']['departure']['name'],
            'destination' => $res['route']['destination']['name'],
            'departureTime' => $this->departureTime,
            'destinationTime' => $this->destinationTime,
            'price' => $this ->route['price'],
            'emptySeats' =>  $this -> getEmptySeats()
        ];
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['userId' => 'id']);
    }

    /**
     * Gets query for [[Bus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBus()
    {
        return $this->hasOne(Bus::className(), ['id' => 'busId']);
    }

    public function getName()
    {
        $tmp = ['route' => $this->route];
        return $tmp['route']['name'];
    }

    public function getEmptySeats(){
        return count(Ticket::find()
            ->with('trip')
            ->where(['tripId' => $this->id, 'userId' => '1'])
            ->all());
    }

    /**
     * Gets query for [[Route]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(Route::className(), ['id' => 'routeId']);
    }
}
