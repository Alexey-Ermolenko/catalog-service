<?php

namespace api\modules\v1\models\base;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property bool|null $deletion_mark
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CompanyRubric[] $companyRubrics
 * @property Rubric[] $rubrics
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['deletion_mark'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'latitude', 'longitude'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'deletion_mark' => Yii::t('app', 'Deletion Mark'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[CompanyRubrics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyRubrics()
    {
        return $this->hasMany(CompanyRubric::className(), ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Rubrics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRubrics()
    {
        return $this->hasMany(Rubric::className(), ['id' => 'rubric_id'])->viaTable('company_rubric', ['company_id' => 'id']);
    }
}
