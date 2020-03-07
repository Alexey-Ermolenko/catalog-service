<?php

namespace common\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use yii\data\ActiveDataProvider;

class Rubric extends base\Rubric
{
    const FIRST_LEVEL = 1;
    const LAST_LEVEL  = 4;

    /**
     * @param int $n
     *
     * @return string
     */
    public static function label($n = 1)
    {
        return $n == 1 ? Yii::t('app', 'Rubric') : Yii::t('app', 'Rubrics');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'tree' => [
                'class'          => NestedSetsBehavior::class,
                'treeAttribute'  => 'tree',
                'leftAttribute'  => 'lft',
                'rightAttribute' => 'rgt',
                'depthAttribute' => 'depth',
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['position'], 'default', 'value' => 0],
            [['tree', 'lft', 'rgt', 'depth', 'position'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new RubricQuery(get_called_class());
    }

    /**
     * Get parent's ID
     * @return \yii\db\ActiveQuery
     */
    public function getParentId()
    {
        $parent = $this->parent;

        return $parent ? $parent->id : null;
    }

    /**
     * Get parent's node
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->parents(1)->one();
    }

    /**
     * Get a full tree as a list, except the node and its children
     *
     * @param integer $node_id node's ID
     *
     * @return array array of node
     */
    public static function getTree($node_id = 0)
    {
        $children = [];

        if (!empty($node_id)) {
            $children = array_merge(
                self::findOne($node_id)->children()->column(),
                [$node_id]
            );
        }

        $rows = self::find()
            ->select('id, name, depth')
            ->where(['NOT IN', 'id', $children])
            ->orderBy('tree, lft, position')
            ->all();

        $return = [];

        foreach ($rows as $row) {
            $return[$row->id] = str_repeat('-', $row->depth) . ' ' . $row->name;
        }

        return $return;
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
        $query = Rubric::find();

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