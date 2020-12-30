<?php
//200


namespace app\modules\v1\models;

use app\modules\v1\models\BaseModel;

/**
 * This is the model class for table "stations".
 *
 * @property int $id
 * @property string $name Название населенного пункта
 *
 * @property Route[] $routes
 * @property Route[] $routes0
 */
class Station extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Routes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoutes()
    {
        return $this->hasMany(Route::className(), ['departureId' => 'id']);
    }

    /**
     * Gets query for [[Routes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoutes0()
    {
        return $this->hasMany(Route::className(), ['destinationId' => 'id']);
    }
}
