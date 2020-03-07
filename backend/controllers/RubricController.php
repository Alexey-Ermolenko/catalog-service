<?php


namespace backend\controllers;

use Yii;
use common\models\Rubric;
use yii\web\NotFoundHttpException;

/**
 * RubricController implements the CRUD actions for Rubric model.
 */
class RubricController extends AppController
{
    /**
     * Lists all Rubric models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new Rubric();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'model'        => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rubric model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rubric model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rubric();

        if (!empty(Yii::$app->request->post('Rubric'))) {
            $post            = Yii::$app->request->post('Rubric');
            $model->name     = $post['name'];
            $model->position = $post['position'];
            $parent_id       = $post['parentId'];

            if (empty($parent_id)) {
                $model->makeRoot();
            } else {
                $parent = Rubric::findOne($parent_id);
                $model->appendTo($parent);
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rubric model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!empty(Yii::$app->request->post('Rubric'))) {
            $post = Yii::$app->request->post('Rubric');

            $model->name     = $post['name'];
            $model->position = $post['position'];
            $parent_id       = $post['parentId'];

            if ($model->save()) {
                if (empty($parent_id)) {
                    if (!$model->isRoot()) {
                        $model->makeRoot();
                    }
                } else {
                    if ($model->id != $parent_id) {
                        $parent = Rubric::findOne($parent_id);
                        $model->appendTo($parent);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rubric model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->isRoot()) {
            $model->deleteWithChildren();
        } else {
            $model->delete();
        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the Rubric model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Rubric the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rubric::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
