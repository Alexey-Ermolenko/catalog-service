<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_rubric}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%company}}`
 * - `{{%rubric}}`
 */
class m200303_050533_create_junction_table_for_company_and_rubric_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_rubric}}', [
            'company_id' => $this->integer(),
            'rubric_id'  => $this->integer(),
            'PRIMARY KEY(company_id, rubric_id)',
        ]);

        // creates index for column `company_id`
        $this->createIndex(
            '{{%idx-company_rubric-company_id}}',
            '{{%company_rubric}}',
            'company_id'
        );

        // add foreign key for table `{{%company}}`
        $this->addForeignKey(
            '{{%fk-company_rubric-company_id}}',
            '{{%company_rubric}}',
            'company_id',
            '{{%company}}',
            'id',
            'CASCADE'
        );

        // creates index for column `rubric_id`
        $this->createIndex(
            '{{%idx-company_rubric-rubric_id}}',
            '{{%company_rubric}}',
            'rubric_id'
        );

        // add foreign key for table `{{%rubric}}`
        $this->addForeignKey(
            '{{%fk-company_rubric-rubric_id}}',
            '{{%company_rubric}}',
            'rubric_id',
            '{{%rubric}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%company}}`
        $this->dropForeignKey(
            '{{%fk-company_rubric-company_id}}',
            '{{%company_rubric}}'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            '{{%idx-company_rubric-company_id}}',
            '{{%company_rubric}}'
        );

        // drops foreign key for table `{{%rubric}}`
        $this->dropForeignKey(
            '{{%fk-company_rubric-rubric_id}}',
            '{{%company_rubric}}'
        );

        // drops index for column `rubric_id`
        $this->dropIndex(
            '{{%idx-company_rubric-rubric_id}}',
            '{{%company_rubric}}'
        );

        $this->dropTable('{{%company_rubric}}');
    }
}
