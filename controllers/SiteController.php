<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\service\SignupService;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignup()
    {
        $form = new SignupForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $signupService = new SignupService();
            try{
                $user = $signupService->signup($form);
                Yii::$app->session->setFlash('success', 'Check your email to confirm the registration.');
                $signupService->sentEmailConfirm($user);
            }
            catch (\RuntimeException $e)
            {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->render('signup', [
                'model' => $form,
            ]);
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post())) {
            try{
                if($form->login()){
                    return $this->goBack();
                }
            } catch (\DomainException $e){
                Yii::$app->session->setFlash('error', $e->getMessage());
                return $this->goHome();
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    public function actionSignupConfirm($token)
    {
        $signupService = new SignupService();

        try{
            $signupService->confirmation($token);
            Yii::$app->session->setFlash('success', 'You have successfully confirmed your registration.');
        } catch (\Exception $e){
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->goHome();
    }

    public function actionLogout()
    {
        if (!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }
}
