<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\AccessRule;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'create', 'update', 'delete', 'settings', 'view', 'profile'],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            //User::ROLE_USER,
                            User::ROLE_MANAGER,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['settings', 'profile'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            User::ROLE_MANAGER,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['create', 'delete', 'index', 'view', 'update', 'fileUploadGeneral', 'settings', 'profile'],
                        'allow' => true,
                        // Allow admins to delete
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        if ($model->role == "30" || Yii::$app->user->identity->role != 30) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single User model.    
     * @return mixed
     */
    public function actionProfile() {
        $model = $this->findModel(\Yii::$app->user->identity->id);
        return $this->render('view', [
                    'model' => $model,
                    'profile' => 1,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();

        if (Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {                
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);                
            }
        }
       
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->role == "30") {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if (Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {                
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);                
            }
        }
        
        $photo = $model->main_photo;
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->main_photo = $photo;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionSettings() {
        $model = $this->findModel(\Yii::$app->user->identity->id);
        if (Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {                
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);                
            }
        }
        $photo = $model->main_photo;
        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $model->main_photo = $photo;
            if ($model->save()) {
                return $this->redirect(['profile']);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFileUploadGeneral() {

        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post("id");
            if (isset($id) && $id) {
                $model = User::findOne($id);
                $model->scenario = 'photo';
            } else {
                echo 'false';
                return false;
            }
            $path = Yii::getAlias("@backend/web/user_images");
            BaseFileHelper::createDirectory($path);

            $file = UploadedFile::getInstance($model, 'main_photo');
            if (!isset($file) || !$file) {
                echo 'false';
                return false;
            }
            $name = md5($file->name . time()) . '.' . $file->extension;
            $file->saveAs($path . DIRECTORY_SEPARATOR . $name);

            $image = $path . DIRECTORY_SEPARATOR . $name;

            $model->main_photo = '/user_images/' . $name;
            $model->save();

            return true;
        }
    }

}
