<?php

namespace api\modules\v1\models;

use api\modules\v1\models\base\CompanyRubric;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Company Model
 *
 */
class Company extends \api\modules\v1\models\base\Company
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'negotiator' => [
                'class'   => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
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
        $query = \api\modules\v1\models\base\Company::find();

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
            'id' => $this->id,
            'deletion_mark' => $this->deletion_mark,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'latitude', $this->latitude])
            ->andFilterWhere(['ilike', 'longitude', $this->longitude]);

        return $dataProvider;
    }
}
