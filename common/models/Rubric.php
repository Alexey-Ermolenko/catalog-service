<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\helpers\Url;

class Rubric extends base\Rubric
{
    const ROOT_RUBRIC = 1;

    /**
     * @return ActiveQuery
     */
    public function getRubricsWithSortByName()
    {
        return $this->hasMany(Rubric::className(), ['parent_id' => 'id'])->orderBy('name');
    }

    /**
     * @return array
     */
    private static function getMenuItems()
    {
        $items = [];
        $resultAll = self::find()->where(['=', 'id', 1])->all();



       // $resultAll = self::findAll()->where(['!=', 'id', static::ROOT_RUBRIC]);

        //$resultAll = self::findAll(['!=', 'id', static::ROOT_RUBRIC]);

        foreach ($resultAll as $result) {
            if (empty($items[$result->parent_id])) {
                $items[$result->parent_id] = [];
            }

            $items[$result->parent_id][] = [
                'id'            => $result->id,
                'name'          => $result->name,
                'parent_id'     => $result->parent_id,
                'company_count' => $result->getCompanies()->count(),
            ];
        }

        return $items;
    }

    /**
     * @param int $parent_id
     *
     * @return array
     */
    public static function viewMenuItems($parent_id = 0)
    {
        $arrItems = self::getMenuItems();

        if (empty($arrItems[$parent_id])) {
            return [];
        }

        $itemCount = count($arrItems[$parent_id]);

        for ($i = 0; $i < $itemCount; $i++) {
//            if ($arrItems[$parent_id][$i]['company_count'] > 0) {
//                $label = $arrItems[$parent_id][$i]['name'] . ' <span class="badge badge-secondary">' . $arrItems[$parent_id][$i]['company_count'] . '</span>';
//                $url   = Url::to(['company/index/',
//                    'CompanySearch' => [
//                        'rubric_id' => $arrItems[$parent_id][$i]['id'],
//                    ],
//                ]);
//            } else {
//                $label = null;
//                $url   = null;
//            }

            $label = $arrItems[$parent_id][$i]['name'] . ' <span class="badge badge-secondary">' . $arrItems[$parent_id][$i]['company_count'] . '</span>';
            $url   = Url::to(['company/index/',
                'CompanySearch' => [
                    'rubric_id' => $arrItems[$parent_id][$i]['id'],
                ],
            ]);

            $result[] = [
                'company_count' => $arrItems[$parent_id][$i]['company_count'],
                'label'         => $label,
                'url'           => $url,
                'linkOptions'   => ['title' => $arrItems[$parent_id][$i]['name']],
                'items'         => self::viewMenuItems($arrItems[$parent_id][$i]['id']),
                'options'       => ['class' => $arrItems[$parent_id][$i]['class']],
            ];
        }


        return $result;
    }
}