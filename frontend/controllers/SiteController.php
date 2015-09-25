<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Form;
use common\models\Item;
use common\models\Field;
use common\models\ItemField;
use frontend\models\DForm;

/**
 * Site controller
 */
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionForm($id)
    {
        $model_form = $this->findModel($id);
        $model_fields = Field::find()->where(['form_id'=>$id])->orderBy(['order'=>SORT_ASC])->all();
        $fields = array_map(function($a){ return 'field_'.$a['id']; },$model_fields);
        $model = new DForm($fields);

        $fields_config = [];
        foreach($model_fields as $key=>$value){
            $arr = [];
            $arr['type'] = $value->type;
            $arr['label'] = $value->name;
            if($value->options){
                // 选项列表
                $items = [];
                $item = explode("\n",$value->options);
                foreach($item as $key => $v){
                    if(empty($v))
                        continue;
                    list($a,$b) = explode(',',trim($v));
                    $items[$a] = $b;
                }
                $arr['items'] = $items;
                // 选项参数
                if($value->type == "dropdownList")
                    $arr['options'] = ['prompt'=>"请选择"];
            }
            if($value->required){
                $model->addRule('field_'.$value->id,'required',['message'=>'不可为空']);
            }
            $fields_config['field_'.$value->id] = $arr;
        }

        if(Yii::$app->request->isPost){
            if (Yii::$app->request->post('DForm') && $model->load(Yii::$app->request->post()) && $model->validate()) {
                $post_data = Yii::$app->request->post('DForm');
                $model_item = new Item();
                $model_item->form_id = $id;
                $model_item->ip = Yii::$app->request->userIP;
                $model_item->save();
                foreach($post_data as $key => $value){
                    $model_item_field = new ItemField();
                    $model_item_field->item_id = $model_item->id;
                    $model_item_field->field_id = explode("_",$key)[1];
                    $model_item_field->value = $value;
                    $model_item_field->save();
                }
                Yii::$app->getSession()->setFlash('success', '报名成功!');
                return $this->goHome();
            }
        }

        return $this->render('form', [
            'model' => $model,
            'model_form' => $model_form,
            'fields_config' => $fields_config,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Form::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
