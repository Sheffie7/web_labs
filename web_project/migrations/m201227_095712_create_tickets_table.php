<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tickets}}`.
 */
class m201227_095712_create_tickets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tickets}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull()->comment('ID пассажира? Если ID = 1 - значит пассажира нет.'),
            'tripId' => $this->integer()->notNull()->comment('ID маршрута'),
            'seat' => $this->integer()->notNull()->comment('номер места в автобусе'),

            'createdAt' => $this->dateTime()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->dateTime()->comment('Дата изменения')
        ]);
        $this->addForeignKey('fk_userId', '{{%tickets}}', 'userId', '{{%users}}', 'id');
        $this->addForeignKey('fk_tripId', '{{%tickets}}', 'userId', '{{%trips}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_userId', '{{%tickets}}');
        $this->dropForeignKey('fk_tripId', '{{%tickets}}');
        $this->dropTable('{{%tickets}}');
    }
}
