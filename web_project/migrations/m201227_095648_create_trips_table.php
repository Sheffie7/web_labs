<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%trisp}}`.
 */
class m201227_095648_create_trips_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%trips}}', [
            'id' => $this->primaryKey(),
            'busId' => $this->integer()->notNull()->comment('ID автобуса'),
            'routeId' => $this->integer()->comment('ID маршрута'),
            'departureTime' => $this->dateTime()->notNull()->comment('Дата и время отправления из населенного пункта'),
            'destinationTime' => $this->dateTime()->notNull()->comment('Дата и время прибытия в пункт назначения'),

            'createdAt' => $this->dateTime()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->dateTime()->comment('Дата изменения')
        ]);
        $this->addForeignKey('fk_busId', '{{%trips}}', 'busId', '{{%buses}}', 'id');
        $this->addForeignKey('fk_routeId', '{{%trips}}', 'routeId', '{{%routes}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_busId', '{{%trips}}');
        $this->dropForeignKey('fk_routeId', '{{%trips}}');
        $this->dropTable('{{%trips}}');
    }
}
