<?php

use yii\db\Migration;

/**
 * Class m200309_073811_create_table_rubric
 */
class m200309_073811_create_table_rubric extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rubric}}', [
            'id'    => $this->primaryKey(),
            'tree'  => $this->integer()->notNull(),
            'lft'   => $this->integer()->notNull(),
            'rgt'   => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'position'   => $this->integer()->notNull()->defaultValue(0),
            'name'  => $this->string()->notNull(),
        ]);

        // fill rubric table test data
        $this->execute('
            INSERT INTO rubric (id, tree, lft, rgt, depth, name)
            VALUES
                (DEFAULT, 1, 1, 30, 0, 0, \'root 1\'),
                (DEFAULT, 1, 2, 15, 1, 0, \'node 1\'),
                (DEFAULT, 1, 3, 8, 2, 0, \'node 1.1\'),
                (DEFAULT, 1, 4, 5, 3, 0, \'node 1.1.1\'),
                (DEFAULT, 1, 6, 7, 3, 0, \'node 1.1.2\'),
                (DEFAULT, 1, 9, 14, 2, 0, \'node 1.2\'),
                (DEFAULT, 1, 10, 11, 3, 0, \'node 1.2.1\'),
                (DEFAULT, 1, 12, 13, 3, 0, \'node 1.2.2\');
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%rubric}}');
    }
}
