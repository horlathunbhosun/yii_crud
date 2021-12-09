<?php

class SiteController extends Controller
{

	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'


        $_POST = json_decode(file_get_contents('php://input'),true);
            if(isset($_POST)) {
                $model = new UserInformation();

                $model->first_name = $_POST['first_name'];
                $model->last_name = $_POST['last_name'];
                $model->college = $_POST['college'];
                $model->city = $_POST['city'];
                $model->branch = $_POST['branch'];
                $model->save();
            }


//        $this->render('create',array(
//            'model'=>$model,
//        ));

		$this->render('index');
	}

    public function actionUser()
    {
        $all_user = new UserInformation();
        $user_data = $all_user->findAll();
       echo json_encode($user_data,JSON_PRETTY_PRINT);
;
    }


    public function actionDelete($id)
    {
        $model = new UserInformation();
        $model = $model->find($id);
        // $id not found in database
        if($model === null){
            $data = ['message'=>'The requested user does not exist.'];
            echo json_encode($data,JSON_PRETTY_PRINT);
        }

        // delete record
        $model->delete();
        echo  json_encode('user deleted successfully',JSON_PRETTY_PRINT);

    }

    /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
//	public function actionLogin()
//	{
//		$model=new LoginForm;
//
//		// if it is ajax validation request
//		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
//		{
//			echo CActiveForm::validate($model);
//			Yii::app()->end();
//		}
//
//		// collect user input data
//		if(isset($_POST['LoginForm']))
//		{
//			$model->attributes=$_POST['LoginForm'];
//			// validate user input and redirect to the previous page if valid
//			if($model->validate() && $model->login())
//				$this->redirect(Yii::app()->user->returnUrl);
//		}
//		// display the login form
//		$this->render('login',array('model'=>$model));
//	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
//	public function actionLogout()
//	{
//		Yii::app()->user->logout();
//		$this->redirect(Yii::app()->homeUrl);
//	}
}
