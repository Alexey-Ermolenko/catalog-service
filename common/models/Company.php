<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class Company extends base\Company
{
    public $rubric_id;
    public $rubric_name;

    /**
     * @param int $n
     *
     * @return string
     */
    public static function label($n = 1)
    {
        return $n == 1 ? Yii::t('app', 'Company') : Yii::t('app', 'Companies');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => new Expression('NOW()'),
            ],
        ]);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name'], 'default', 'value' => ''],
            [['rubric_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubric::className(), 'targetAttribute' => ['rubric_id' => 'id'],],
        ]);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Company::find();
        $query->joinWith(['rubrics']);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'company.id'            => $this->id,
            'company.deletion_mark' => $this->deletion_mark,
            'company.created_at'    => $this->created_at,
            'company.updated_at'    => $this->updated_at,
            'rubric.id'             => $this->rubric_id,
            'rubric.name'           => $this->rubric_name,
        ]);

        $query->andFilterWhere(['ilike', 'company.name', $this->name])
            ->andFilterWhere(['ilike', 'company.latitude', $this->latitude])
            ->andFilterWhere(['ilike', 'company.longitude', $this->longitude]);

        return $dataProvider;
    }
}