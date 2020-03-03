<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "company_rubric".
 *
 * @property int $company_id
 * @property int $rubric_id
 *
 * @property Company $company
 * @property Rubric $rubric
 */
class CompanyRubric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_rubric';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'rubric_id'], 'required'],
            [['company_id', 'rubric_id'], 'default', 'value' => null],
            [['company_id', 'rubric_id'], 'integer'],
            [['company_id', 'rubric_id'], 'unique', 'targetAttribute' => ['company_id', 'rubric_id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['rubric_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubric::className(), 'targetAttribute' => ['rubric_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'company_id' => Yii::t('app', 'Company ID'),
            'rubric_id' => Yii::t('app', 'Rubric ID'),
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Rubric]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRubric()
    {
        return $this->hasOne(Rubric::className(), ['id' => 'rubric_id']);
    }
}
