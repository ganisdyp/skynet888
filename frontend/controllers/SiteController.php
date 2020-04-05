<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\EnquiryForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Safe Box Siam is a new company that aims at providing high quality safes and technical services to its clients. We will also be the one stop office solution to your business by providing a full comprehensive range of equipments'
        ]);
        $this->view->title = 'Skynet888Studios';

        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    /*   public function actionContact()
       {
           $model = new ContactForm();
           if ($model->load(Yii::$app->request->post()) && $model->validate()) {
               if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                   Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
               } else {
                   Yii::$app->session->setFlash('error', 'There was an error sending your message.');
               }

               return $this->refresh();
           } else {
               return $this->render('contact', [
                   'model' => $model,
               ]);
           }
       }*/
    public function actionAboutUs()
    {
        $this->view->title = 'About Us';
        return $this->render('about-us');
    }
    public function actionContactUs()
    {
        $this->view->title = 'Contact Us';
            return $this->render('contact-us');
    }

    public function actionCareers()
    {
        $this->view->title = 'Careers';
        return $this->render('careers');

    }
    public function actionEnquiry()
    {
        $model = new EnquiryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail('safeboxsiam@gmail.com') && $model->sendEmail('info@safeboxasia.com')) {
         //   if ($model->sendEmail('ganis.dyp@gmail.com')) {
                Yii::$app->session->setFlash('successEnquiry');
                return $this->redirect('character-view?id='.$model->character_id);
            } else {
                Yii::$app->session->setFlash('errorEnquiry');
                return $this->refresh();
            }
        } else {
            return $this->render('enquiry', [
                'model' => $model,
                'character_id' => Yii::$app->request->get('character_id')
            ]);
        }
    }


    /**
     * Displays character categories page.
     *
     * @return mixed
     */
    public function actionCharacterCategory()
    {
        return $this->render('characterCategory');
    }

    /**
     * Displays project list page.
     *
     * @return mixed
     */
    public function actionProjects()
    {
        $this->view->title = 'Projects';
        return $this->render('project-list');
    }

    /**
     * Displays project detail page.
     *
     * @return mixed
     */
    public function actionProjectDetail()
    {
        $this->view->title = 'Project Details';
        return $this->render('project-detail');
    }

    /**
     * Displays character view page.
     *
     * @return mixed
     */
    public function actionCharacterModel()
    {
        return $this->render('characterModel');
    }

    /**
     * Displays character view page.
     *
     * @return mixed
     */
    public function actionCharacterView()
    {
        return $this->render('characterView');
    }

    /**
     * Displays study trip categories page.
     *
     * @return mixed
     */
    public function actionNews()
    {
        $this->view->title = 'News';
        return $this->render('news');
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
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

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
