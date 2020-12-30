<?php

namespace app\modules\v1\models;

use app\modules\v1\models\BaseModel;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $name Имя пассажира
 * @property string|null $email email пассажира
 * @property string|null $password Пароль пассажира
 * @property string|null $phone Номер телефона пассажира
 * @property string $createdAt Дата создания
 * @property string|null $updatedAt Дата изменения
 *
 * @property Ticket[] $tickets
 */
class User extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdAt', 'updatedAt'], 'safe'],
            [['name', 'email', 'phone'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 32],
        ];
    }

    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
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

    public function checkPass($password)
    {
        return $this->password == $password;
    }

    public function getUser()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'accessToken' => md5(microtime(null))
        ];
    }
}

