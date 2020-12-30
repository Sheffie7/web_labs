<?php
//200

namespace app\modules\v1\models;

use app\modules\v1\models\BaseModel;

/**
 * This is the model class for table "buses".
 *
 * @property int $id
 * @property string $driver_name ФИО водителя
 * @property string $plate_num Государственный номер автобуса
 * @property int $seats_amount Количество мест всего
 *
 * @property Trip[] $trips
 */
class Bus extends BaseModel
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

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return [
            'id' => $this->id,
            'driver_name' => $this->driver_name,
            'plate_num' => $this->plate_num,
            'seats_amount' => $this->seats_amount
        ];
    }

    /**
     * Gets query for [[Trips]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrips()
    {
        return $this->hasMany(Trip::className(), ['busId' => 'id']);
    }
}
