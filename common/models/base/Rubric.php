<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "rubric".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 *
 * @property CompanyRubric[] $companyRubrics
 * @property Company[] $companies
 * @property Rubric $parent
 * @property Rubric[] $rubrics
 */
class Rubric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rubric';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'default', 'value' => null],
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubric::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * Gets query for [[CompanyRubrics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyRubrics()
    {
        return $this->hasMany(CompanyRubric::className(), ['rubric_id' => 'id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['id' => 'company_id'])->viaTable('company_rubric', ['rubric_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Rubric::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Rubrics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRubrics()
    {
        return $this->hasMany(Rubric::className(), ['parent_id' => 'id']);
    }
}
