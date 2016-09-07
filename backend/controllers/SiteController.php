<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\components\AccessRule;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller {

    public $layout = "main_1";
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
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MANAGER,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['index', 'update'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            User::ROLE_MANAGER,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['delete'],
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
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',                
                'view' => '@yiister/gentelella/views/error',
            ],
            'captcha' => [
                'class' => 'common\components\MyCaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,                
                'maxLength'=>4,
                'minLength'=>4,
                'height'=>'35px',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {        
        $this->layout = 'main';
        return $this->render('index');
    }

    public function actionAa(){
        echo 1;
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        $this->layout = 'main_1';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function beforeAction($action)
    {
        if ($action->id == 'error')
            $this->layout = Yii::$app->user->isGuest?'main_1':'main';

        return parent::beforeAction($action);
    }

}
