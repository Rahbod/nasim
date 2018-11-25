<?php

class CustomersManageController extends Controller
{
    public static function actionsType()
    {
        return array(
            'backend' => array(
                'view',
                'create',
                'update',
                'admin',
                'delete'
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'views' page.
     */
    public function actionCreate()
    {
        $this->pageTitle = 'افزودن مشتری جدید';
        $model = new Customers('create');

        $this->performAjaxValidation($model);

        if (isset($_POST['Customers'])) {
            $model->attributes = $_POST['Customers'];
            $criteria=new CDbCriteria;
            $criteria->select='max(id) AS id';
            $res = Customers::model()->find($criteria);
            $model->code = 'CO-'.(101 + ($res->id ?: 0));
            $model->creator_id = Yii::app()->user->getId();
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'عملیات با موفقیت انجام شد.');
                $this->redirect(array('admin'));
            } else
                Yii::app()->user->setFlash('failed', 'درخواست با خطا مواجه است. لطفا مجددا سعی نمایید.');
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'views' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $this->pageTitle = 'ویرایش مشتری';
        $model = $this->loadModel($id);
        $model->setScenario('update');

        if (isset($_POST['Customers'])) {
            $model->attributes = $_POST['Customers'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'عملیات با موفقیت انجام شد.');
                $this->redirect(array('admin'));
            } else
                Yii::app()->user->setFlash('failed', 'درخواست با خطا مواجه است. لطفا مجددا سعی نمایید.');
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if($id != Yii::app()->user->id)
            $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid views), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    public function actionAdmin()
	{
        $model = new Customers('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Customers']))
            $model->attributes = $_GET['Customers'];
        $this->render('admin', array(
            'model' => $model,
        ));
	}

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Customers the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Customers::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Customers $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='customers-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}