<?php

namespace app\controllers;

use yii\data\Pagination;
use app\models\News;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $datasport = News::find()->where(['category' =>'Спорт'])->orderBy('id desc')->limit(5)->all();
        $datapolitic = News::find()->where(['category' =>'Политика'])->orderBy('id desc')->limit(5)->all();
        $dataanalitic = News::find()->where(['analityc' =>1])->orderBy('id desc')->limit(5)->all();
        $dataslider = News::find()->orderBy('id desc')->limit(3)->all();

        return $this->render('index', compact('datasport', 'datapolitic', 'dataanalitic', 'dataslider'));
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSport(){
        $query = News::find()->where(['category' => 'Спорт']);
        $post = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'pageSizeParam' => false,
            'forcePageParam' => false]);
        $pages = $query->offset($post->offset)->limit($post->limit)->all();

        return $this->render('sport', compact('post', 'pages'));
    }

    public function actionPolitic(){
        $query = News::find()->where(['category' => 'Политика']);
        $post = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'pageSizeParam' => false,
            'forcePageParam' => false]);
        $pages = $query->offset($post->offset)->limit($post->limit)->all();

        return $this->render('politic', compact('post', 'pages'));
    }

    public function actionAnalitic(){
        $query = News::find()->where(['analityc' => 1]);
        $post = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'pageSizeParam' => false,
            'forcePageParam' => false]);
        $pages = $query->offset($post->offset)->limit($post->limit)->all();

        return $this->render('analitic', compact('post', 'pages'));
    }

    public function actionView(){
        $id = \Yii::$app->request->get('id');
        $page = News::findOne($id);
        return $this->render('view', compact('page'));
    }
    public function actionList(){
        $tags = \Yii::$app->request->get('id');
        $query = News::find()->where(['tags2' => $tags])->orWhere(['tags1' => $tags]);
        $post = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'pageSizeParam' => false,
            'forcePageParam' => false]);
        $pages = $query->offset($post->offset)->limit($post->limit)->all();

        return $this->render('list', [
            'post' => $post,
            'pages' => $pages
        ]);
    }

    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        if(!$q) return $this->render('search');
        $query = News::find()->where(['like', 'tags1', $q])->orWhere(['like', 'tags2', $q]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 5,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $page = $query->orderBy('id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('search', compact('page','pages'));
    }


}
