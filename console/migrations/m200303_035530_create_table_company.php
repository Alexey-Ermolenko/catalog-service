<?php

use yii\db\Migration;

/**
 * Class m200303_035530_create_table_company
 */
class m200303_035530_create_table_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string()->notNull(),
            'deletion_mark' => 'BOOLEAN DEFAULT FALSE',
            'latitude'      => $this->string()->defaultValue('0'),
            'longitude'     => $this->string()->defaultValue('0'),
            'created_at'    => 'datetime DEFAULT NOW()',
            'updated_at'    => 'datetime DEFAULT NOW()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
    }
}
