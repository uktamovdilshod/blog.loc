<?php

namespace app\modules\admin\controllers;

use app\models\Tag;
use app\models\TagAssign;
use Yii;
use app\models\Post;
use app\models\search\PostSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => 'app\components\AccessRule'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {

            $model->title = json_encode($model->translate_title,JSON_UNESCAPED_UNICODE);
            $model->description = json_encode($model->translate_description,JSON_UNESCAPED_UNICODE);
            $model->content = json_encode($model->translate_content,JSON_UNESCAPED_UNICODE);

            if ($model->save()) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image and $model->upload()) {
                    $model->image = $model->image->baseName.'.'.$model->image->extension;
                    $model->save();
                }
                if (isset($model->tag) and !empty($model->tag)) {
                    $tags = explode(',',$model->tag);
                    foreach ($tags as $tag) {
                        $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                        if($check_tag!==null){
                            $model2 = new TagAssign();
                            $model2->post_id = $model->id;
                            $model2->tag_id = $check_tag->id;
                            $model2->save(false);
                        }else{
                            $model3 = new Tag();
                            $model3->name = $tag;
                            $model3->save(false);

                            $model2 = new TagAssign();
                            $model2->post_id = $model->id;
                            $model2->tag_id = $model3->id;
                            $model2->save(false);
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }


        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->image;

        if ($model->load(Yii::$app->request->post())) {

            $model->title = json_encode($model->translate_title,JSON_UNESCAPED_UNICODE);
            $model->description = json_encode($model->translate_description,JSON_UNESCAPED_UNICODE);
            $model->content = json_encode($model->translate_content,JSON_UNESCAPED_UNICODE);

            if ($model->save()) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image and $model->upload()) {
                    $model->image = $model->image->baseName.'.'.$model->image->extension;
                    $model->save();
                }else{
                    $model->image = $image;
                    $model->save();
                }
                if (isset($model->tag) and !empty($model->tag)) {
                    TagAssign::deleteAll(['post_id'=>$model->id]);
                    $tags = explode(',',$model->tag);
                    foreach ($tags as $tag) {
                        $check_tag = Tag::find()->where(['like', 'name', $tag])->one();
                        if($check_tag!==null){
                            $model2 = new TagAssign();
                            $model2->post_id = $model->id;
                            $model2->tag_id = $check_tag->id;
                            $model2->save(false);
                        }else{
                            $model3 = new Tag();
                            $model3->name = $tag;
                            $model3->save(false);

                            $model2 = new TagAssign();
                            $model2->post_id = $model->id;
                            $model2->tag_id = $model3->id;
                            $model2->save(false);
                        }
                    }
                }else{
                    TagAssign::deleteAll(['post_id'=>$model->id]);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->translate_title = json_decode($model->title,true);
                $model->translate_description = json_decode($model->description,true);
                $model->translate_content = json_decode($model->content,true);
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {

            $model->translate_title = json_decode($model->title,true);
            $model->translate_description = json_decode($model->description,true);
            $model->translate_content = json_decode($model->content,true);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
