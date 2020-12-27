<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%routes}}`.
 */
class m201226_003005_create_routes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%routes}}', [
            'id' => $this->primaryKey(),
            'departureId' => $this->integer()->notNull()->comment('ID пункта отправления'),
            'destinationId' => $this->integer()->notNull()->comment('ID пункта прибытия'),
            'name' => $this->string(65)->notNull()->comment('Название маршрута'),
            'price' => $this->decimal(5, 2)->notNull()->comment('Стоимость маршрута'),

            'createdAt' => $this->dateTime()->notNull()->comment('Дата создания'),
            'updatedAt' => $this->dateTime()->comment('Дата изменения')
        ]);
        $this->addForeignKey('fk_departureId', '{{%routes}}', 'departureId', '{{%stations}}', 'id');
        $this->addForeignKey('fk_destinationId', '{{%routes}}', 'destinationId', '{{%stations}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_departureId', '{{%routes}}');
        $this->dropForeignKey('fk_destinationId', '{{%routes}}');
        $this->dropTable('{{%routes}}');
    }
}
