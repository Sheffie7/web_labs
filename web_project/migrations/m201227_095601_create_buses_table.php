<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%buses}}`.
 */
class m201227_095601_create_buses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%buses}}', [
            'id' => $this->primaryKey(),
            'driver_name' => $this->string(45)->notNull()->comment('ФИО водителя'),
            'plate_num' => $this->string()->notNull()->comment('Государственный номер автобуса'),
            'seats_amount' => $this->integer()->notNull()->comment('Количество мест всего'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%buses}}');
    }
}
