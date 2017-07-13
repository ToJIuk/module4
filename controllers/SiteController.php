<?php

namespace app\controllers;

use app\models\AddComments;
use app\models\Comments;
use app\models\CommentsFields;
use app\models\Signup;
use yii\data\Pagination;
use app\models\News;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Login;
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
        $comments = Comments::find()->select('username, COUNT(username)')
            ->groupBy('username')->orderBy(' COUNT(username) DESC')->limit(5)->all();
        $top3 = Comments::find()->select('subject, COUNT(subject)')
            ->groupBy('subject')->orderBy(' COUNT(text) DESC')->limit(3)->all();
        return $this->render('index', compact('datasport', 'datapolitic',
            'dataanalitic', 'dataslider', 'comments', 'top3'));
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest){

            return $this->goHome();
        }
        $login_model = new Login();
        if (\Yii::$app->request->post('Login')){
            $login_model->attributes = \Yii::$app->request->post('Login');
            if ($login_model->validate()){
                \Yii::$app->user->login($login_model->getUser());
                if (\Yii::$app->user->identity->name == 'admin' ){
                    return $this->redirect(['admin/default/index']);
                }
                return $this->goHome();
            }
        }
        return $this->render('login', compact('login_model'));
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

    public function actionSignup()
    {
        $model = new Signup();
        if (isset($_POST['Signup'])){
            $model->attributes = \Yii::$app->request->post('Signup');
            if ($model->validate() && $model->signup()){
                return $this->goHome();
            }
        }
        return $this->render('signup', compact('model'));
    }

    public function actionView(){
        $id = \Yii::$app->request->get('id');
        if (is_numeric($id)){
            $page = News::findOne($id);
        }else {
            $page = News::find()->where(['name' => $id])->one();
        }
        $model = new Comments();
        if (isset($_POST['Comments'])){
            $model->date = date('j F Y h:i:s');
            $model->username = Yii::$app->user->identity->name;
            $model->subject = $page->name;
            $model->text = $_POST['Comments']['text'];
            $model->insert();
        }
        $comment = Comments::find()->where(['subject' => $page->name]);
        $post = new Pagination(['totalCount' => $comment->count(), 'pageSize' => 5, 'pageSizeParam' => false,
            'forcePageParam' => false]);
        $comments = $comment->offset($post->offset)->limit($post->limit)->all();


        return $this->render('view', compact('page', 'model', 'comments', 'post'));
    }

    public function actionCommentator(){
        $name = \Yii::$app->request->get('id');
        $comment = Comments::find()->where(['username' => $name]);
        $post = new Pagination(['totalCount' => $comment->count(), 'pageSize' => 5, 'pageSizeParam' => false,
            'forcePageParam' => false]);
        $comments = $comment->offset($post->offset)->limit($post->limit)->all();
        return $this->render('commentator', compact('comments', 'post'));
    }

}
