<?php

use yii\db\Migration;

/**
 * Class m200303_035520_create_table_rubric
 */
class m200303_035520_create_table_rubric extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rubric}}', [
            'id'        => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull()->defaultValue(0),
            'name'      => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk_rubric_parent_id', 'rubric', 'parent_id', 'rubric', 'id', 'RESTRICT', 'CASCADE');
        $this->createIndex('index_rubric_parent_id', 'rubric', 'parent_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rubric}}');

    }
}
