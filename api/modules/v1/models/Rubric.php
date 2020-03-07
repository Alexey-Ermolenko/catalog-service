<?php

namespace api\modules\v1\models;

use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Rubric Model
 *
 */
class Rubric extends \api\modules\v1\models\base\Rubric
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rubric';
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



    public function fields()
    {
       // parent::fields();
        return ['id', 'name'];
    }

    public function extraFields()
    {
        return ['name'];
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
        $query = \api\modules\v1\models\base\Rubric::find();

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
            'id'    => $this->id,
            'tree'  => $this->tree,
            'lft'   => $this->lft,
            'rgt'   => $this->rgt,
            'depth' => $this->depth,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
