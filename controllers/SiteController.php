<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PairsSearch;
use app\models\Razmechenie;
use app\models\RazmechenieSearch;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        return $this->render('index-blog');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        if (Yii::$app->request->isPost) {
            if (Yii::$app->session->has('check')) {
                if (Yii::$app->session->get('check') < 3) {
                    Yii::$app->session->set('check', Yii::$app->session->get('check') + 1);
                } else {
                    Yii::$app->session->setFlash('error', 'кончились попытки ввода');
                    return $this->goHome();
                }
            } else {
                Yii::$app->session->set('check', 1);
            }
        }


        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
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


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionRegister()
    {
        $model = new \app\models\User();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->register();
                Yii::$app->session->setFlash('success', 'ВЫ зареганыы');
                Yii::$app->user->login($model);
                return $this->goHome();
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }


    public function actionCheckFood()
    {
        if (!Yii::$app->user->isGuest) {
            $dataProvider = new ActiveDataProvider([
                'query' => Razmechenie::queryFood()
            ]);
            return $this->render('check-food', [
                'dataProvider' => $dataProvider
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionExportFood()
    {
        if (!Yii::$app->user->isGuest) {
            $data = Razmechenie::queryFood()
                ->all();
            $str = "КОличество еды;Комплекс\r\n";
            foreach ($data as $raw) {
                $str .= $raw['quantity_of_food'] . ';'
                    . $raw['title'] . "\r\n";
            }
            $str = iconv('utf-8', 'windows-1251', $str);
            Yii::$app->response->sendContentAsFile($str, 'ЕДа.csv')->send();
        } else {
            return $this->goHome();
        }
    }

    public function actionKarlik()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new RazmechenieSearch();

            $dataProvider = $searchModel->search($this->request->queryParams);
            return $this->render('check-karlik', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionExportKarlik()
    {
        if (!Yii::$app->user->isGuest) {
            $data = Razmechenie::queryKarlik()
                ->all();
            $str = "Вид;Количество животных;наличие воды;Комплекс\r\n";
            if (!empty($data)) {
                foreach ($data as $raw) {
                    $str .= $raw['kind_title'] . ';'
                        . $raw['room_quantity'] . ';'
                        . $raw['is_water'] . ';'
                        . $raw['room_title'] . "\r\n";
                }
            } else {
                $str  .= 'Ничего не найдено' . "\r\n";
            }
            $str = iconv('utf-8', 'windows-1251', $str);
            Yii::$app->response->sendContentAsFile($str, 'Карлики.csv')->send();
        } else {
            return $this->goHome();
        }
    }

    public function actionDog()
    {
        if (!Yii::$app->user->isGuest) {
            $dataProvider = new ActiveDataProvider([
                'query' => Razmechenie::queryDog()
            ]);
            return $this->render('check-dog', [
                'dataProvider' => $dataProvider
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionExportDog()
    {
        if (!Yii::$app->user->isGuest) {
            $data = Razmechenie::queryDog()
                ->all();
            $str = "Семейство;Количество животных;\r\n";
            if (!empty($data)) {
                foreach ($data as $raw) {
                    $str .= $raw['kind_title'] . ';'
                        . $raw['quantity'] . "\r\n";
                }
            } else {
                $str  .= 'Ничего не найдено' . "\r\n";
            }
            $str = iconv('utf-8', 'windows-1251', $str);
            Yii::$app->response->sendContentAsFile($str, 'Псовые.csv')->send();
        } else {
            return $this->goHome();
        }
    }

    public function actionPairs()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new PairsSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            return $this->render('check-pairs', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionExportPairs()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new PairsSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            $data = $dataProvider->query
                ->all();
            $str = "Пары;Комплекс;\r\n";
            if (!empty($data)) {
                foreach ($data as $raw) {
                    $str .= $raw['k1_title'] . ';'
                        . $raw['k2_title'] . ';'
                        . $raw['quantity'] . "\r\n";
                }
            } else {
                $str  .= 'Ничего не найдено' . "\r\n";
            }
            $str = iconv('utf-8', 'windows-1251', $str);
            Yii::$app->response->sendContentAsFile($str, 'Пары.csv')->send();
        } else {
            return $this->goHome();
        }
    }
}
