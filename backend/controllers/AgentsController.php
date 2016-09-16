<?php

namespace backend\controllers;

use Yii;
use common\models\Agents;
use common\models\AgentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;
use common\models\TarifOrder;
use common\models\MeraTarif;
use common\models\MeraUsersAccessControl;
use common\models\Sagent;
use common\models\ManagerComments;

/**
 * AgentsController implements the CRUD actions for Agents model.
 */
class AgentsController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'create', 'update', 'delete', 'view', 'comment', 'delcomment'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'comment'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ROLE_MANAGER,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'comment', 'delcomment'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            User::ROLE_MANAGER,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['delete', 'index', 'create', 'update', 'delete', 'view', 'comment', 'delcomment'],
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
     * Lists all Agents models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AgentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agents model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->redirect(['/agents']);
    }

    /**
     * Creates a new Agents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $st = true;
        $model = new Agents();
        $last_id = Agents::find()
                ->orderBy('id desc')
                ->one();
        $new_id = $last_id->id + 1;
        $model->username = $new_id;
        $model->password = date('d', time()) . date('m', time()) . date('Y', time()) . date('H', time()) . date('i', time()) . date('s', time());
        $model->objects_rent_limit_phones_daily = 90;
        $model->objects_rent_limit_phones_daily_archive = 300;
        $model->xml_feed_count_max = 500;


        $tarifOrderR = new TarifOrder;
        $tarif = MeraTarif::find()
                ->where(['on_off' => 1])
                ->all();
        //mera
        $MeraUsersAccessControl = new MeraUsersAccessControl;
        $MeraUsersAccessControl->id_system = 1;
        $MeraUsersAccessControl->date_end_object = time() + 24 * 3 * 60 * 60;

        //vitrina        
        $MeraUsersAccessControl2 = new MeraUsersAccessControl;
        $MeraUsersAccessControl2->id_system = 2;
        $Sagent = new Sagent;

        if ($model->load(Yii::$app->request->post()) && $MeraUsersAccessControl->load(Yii::$app->request->post()) && $MeraUsersAccessControl->load(Yii::$app->request->post()) && $MeraUsersAccessControl2->load(Yii::$app->request->post()) && $Sagent->load(Yii::$app->request->post())) {
            $model->who_created = Yii::$app->user->identity->id;
            $model->calls_module = 1;
            $model->id_type = 1;
            $model->xml_feed_max = 1000;
            if ($model->validate()) {
                if (!isset($model->username) || !$model->username) {
                    $model->username = $new_id;
                }
                $model->who_created = Yii::$app->user->identity->id;
                $model->calls_module = 1;
                $model->id_type = 1;
                $model->xml_feed_max = 1000;
                $model->save(false);
                $MeraUsersAccessControl->id_user = $model->id;
                $MeraUsersAccessControl2->id_user = $model->id;
                $Sagent->id_user = $model->id;
                if ($MeraUsersAccessControl->validate() && $MeraUsersAccessControl2->validate() && $Sagent->validate()) {
                    $MeraUsersAccessControl->save(false);
                    $MeraUsersAccessControl2->save(false);
                    $Sagent->save(false);
                    return $this->redirect(['/agents']);
                } else {
                    $st = false;
                }
            } else {
                $st = false;
            }
//            echo '<pre>';
//            var_dump($model->getErrors());
//            var_dump($MeraUsersAccessControl->getErrors());
//            var_dump($MeraUsersAccessControl2->getErrors());
//            var_dump($Sagent->getErrors());
//            exit;
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'tarif' => $tarif,
                        'tarifOrder' => $tarifOrder,
                        'MeraUsersAccessControl' => $MeraUsersAccessControl,
                        'MeraUsersAccessControl2' => $MeraUsersAccessControl2,
                        'Sagent' => $Sagent,
            ]);
        }
        if (!$st) {
            return $this->render('create', [
                        'model' => $model,
                        'tarif' => $tarif,
                        'tarifOrder' => $tarifOrder,
                        'MeraUsersAccessControl' => $MeraUsersAccessControl,
                        'MeraUsersAccessControl2' => $MeraUsersAccessControl2,
                        'Sagent' => $Sagent,
            ]);
        }
    }

    /**
     * Updates an existing Agents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $UserInfo = Yii::$app->user->identity;
        if ($model->who_created == $UserInfo->id || $UserInfo->role == "30") {

            //tarifs
            $tarifOrderR = TarifOrder::find()
                    ->where(['id_user' => $id])
                    ->andWhere(['not in', 'status', [1, 4]])
                    ->orderBy('data_answer desc')
                    ->all();
            $tarif = MeraTarif::find()
                    ->where(['on_off' => 1])
                    ->all();
            if (count($tarifOrderR)) {
                foreach ($tarifOrderR as $t) {
                    $t_id = $t->id;
                    break;
                }
                $tarifOrder = TarifOrder::findOne($t_id);
            } else {
                $tarifOrder = new TarifOrder;
            }

            //mera
            $MeraUsersAccessControl = MeraUsersAccessControl::find()
                    ->where(['id_user' => $model->id])
                    ->andWhere(['id_system' => 1])
                    ->one();
            if (!isset($MeraUsersAccessControl->id) || !$MeraUsersAccessControl->id) {
                $MeraUsersAccessControl = new MeraUsersAccessControl;
            }

            //vitrina
            $MeraUsersAccessControl2 = MeraUsersAccessControl::find()
                    ->where(['id_user' => $model->id])
                    ->andWhere(['id_system' => 2])
                    ->one();
            if (!isset($MeraUsersAccessControl2->id) || !$MeraUsersAccessControl2->id) {
                $MeraUsersAccessControl2 = new MeraUsersAccessControl;
            }
            $Sagent = Sagent::find()
                    ->where(['id_user' => $model->id])
                    ->one();
            if (!isset($Sagent->id) || !$Sagent->id)
                $Sagent = new Sagent;


            if ($model->load(Yii::$app->request->post()) && $MeraUsersAccessControl->load(Yii::$app->request->post()) && $MeraUsersAccessControl->load(Yii::$app->request->post()) && $MeraUsersAccessControl2->load(Yii::$app->request->post()) && $Sagent->load(Yii::$app->request->post())) {

                if ($model->validate() && $MeraUsersAccessControl->validate() && $MeraUsersAccessControl2->validate() && $Sagent->validate()) {
                    $model->save();
                    $MeraUsersAccessControl->save(false);
                    $MeraUsersAccessControl2->save(false);
                    $Sagent->save();
                }

//                echo '<pre>';
//                var_dump($model->getErrors());
//                var_dump($MeraUsersAccessControl->toArray());
//                var_dump($MeraUsersAccessControl2->toArray());
//                var_dump($Sagent->toArray());
//                exit;
                return $this->redirect(['/agents']);
            } else {
                $ManagerComments = ManagerComments::find()
                        ->where(['id_user' => $UserInfo->id, 'id_agent' => $model->id])
                        ->orderBy('date_add DESC')
                        ->all();
                return $this->render('update', [
                            'model' => $model,
                            'tarif' => $tarif,
                            'tarifOrder' => $tarifOrder,
                            'MeraUsersAccessControl' => $MeraUsersAccessControl,
                            'MeraUsersAccessControl2' => $MeraUsersAccessControl2,
                            'Sagent' => $Sagent,
                            'UserInfo' => $UserInfo,
                            'ManagerComments' => $ManagerComments,
                ]);
            }
        } else {
            return $this->redirect(['/agents']);
        }
    }

    public function actionComment() {
        if (!Yii::$app->request->isAjax) {
            echo 2; // bad
            exit();
        }
        $id_agent = (int) strip_tags($_POST['id_agent']);
        $text = strip_tags($_POST['text']);
        if (!$id_agent || !$text) {
            echo 2; // bad
            exit();
        }
        $UserInfo = Yii::$app->user->identity;
        $model = new ManagerComments;
        $model->id_agent = $id_agent;
        $model->id_user = $UserInfo->id;
        $model->comment = $text;
        if ($model->save()) {
            echo $model->id; // ok
            exit();
        } else {
            echo 2; // bad
            exit();
        }
    }
    
    public function actionDelcomment(){
        if (!Yii::$app->request->isAjax) {
            echo 2; // bad
            exit();
        }
        $id = (int) strip_tags($_POST['id']);
        if (!$id) {
            echo 2; // bad
            exit();
        }
        $UserInfo = Yii::$app->user->identity;
        $ManagerComment = ManagerComments::find()
                ->where(['id'=>$id])
                ->andWhere(['id_user'=>$UserInfo->id])
                ->one();
        if(!isset($ManagerComment) || !$ManagerComment->id){
            echo 2; // bad
            exit();
        }
        if($ManagerComment->delete()){
            echo 1;
            exit();
        }else{
            echo 2; // bad
            exit();
        }
        
    }

    /**
     * Deletes an existing Agents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $UserInfo = Yii::$app->user->identity;
        if ($model->who_created == $UserInfo->id || $UserInfo->role == "30") {
            $model = $this->findModel($id);
            MeraUsersAccessControl::deleteAll(['id_user' => $model->id]);
            Sagent::deleteAll(['id_user' => $model->id]);
            $model->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Agents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Agents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
