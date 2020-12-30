<?php

namespace app\modules\v1\models;

use app\modules\v1\models\BaseModel;
use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int $userId ID пассажира? Если ID = 1 - значит пассажира нет.
 * @property int $tripId ID маршрута
 * @property int $seat номер места в автобусе
 * @property string $createdAt Дата создания
 * @property string|null $updatedAt Дата изменения
 *
 * @property User $user
 * @property Trip $trip
 * @property User $user0
 */
class Ticket extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'tripId', 'seat', 'createdAt'], 'required'],
            [['userId', 'tripId', 'seat'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::className(), 'targetAttribute' => ['userId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'tripId' => 'Trip ID',
            'seat' => 'Seat',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        $res = [
            'id' => $this->id,
            'user' => $this->user,
            'seat' => $this->seat,
            'trip' => $this->trip,
        ];
        return [
            'trip' => $res['trip'],
            'tripname' => $res['trip']['name'],
            'seat' => $res['seat'],
        ];
    }

    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Trip::className(), ['id' => 'userId']);
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'tripId']);
    }


}