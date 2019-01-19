<?php

class CustomersManageController extends Controller
{
    public $attachmentPath = 'uploads/customers';
    public $tempPath = 'uploads/temp';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'checkAccess - upload, deleteUpload, fetchAccounts',
        );
    }

    public static function actionsType()
    {
        return array(
            'backend' => array(
                'view',
                'create',
                'update',
                'admin',
                'clearing',
                'delete',
                'accounts',
                'addAccount',
                'deleteAccount',
            )
        );
    }

    public function actions()
    {
        return array(
            'upload' => array( // list image upload
                'class' => 'ext.dropZoneUploader.actions.AjaxUploadAction',
                'attribute' => 'attachment',
                'rename' => 'random',
                'validateOptions' => array(
                    'acceptedTypes' => array('png', 'jpg', 'jpeg', 'doc', 'docx', 'pdf', 'zip')
                )
            ),
            'deleteUpload' => array( // delete list image uploaded
                'class' => 'ext.dropZoneUploader.actions.AjaxDeleteUploadedAction',
                'modelName' => 'Customers',
                'attribute' => 'attachment',
                'uploadDir' => "/$this->attachmentPath/",
                'storedMode' => 'field'
            ),
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
        $accModel = new CustomerAccounts('quick');

        $this->performAjaxValidation($model);
        
        if (isset($_POST['Customers'])) {
            $model->attributes = $_POST['Customers'];
            $criteria=new CDbCriteria;
            $criteria->select='max(id) AS id';
            $res = Customers::model()->find($criteria);
            $model->code = 'CO-'.(101 + ($res->id ?: 0));
            $model->creator_id = Yii::app()->user->getId();
            $attachment = new UploadedFiles($this->tempPath, $model->attachment);
            if ($model->save()) {
                $attachment->move($this->attachmentPath);
                if (isset($_POST['CustomerAccounts'])) {
                    $accModel->attributes = $_POST['CustomerAccounts'];
                    $accModel->customer_id = $model->id;
                    @$accModel->save();
                }
                if(isset($_POST['ajax'])) {
                    echo json_encode([
                        'status' => true,
                        'message' => 'عملیات با موفقیت انجام شد.',
                        'id' => $model->id,
                        'name' => $model->name,
                    ]);
                    Yii::app()->end();
                }
                Yii::app()->user->setFlash('success', 'عملیات با موفقیت انجام شد.');
                $this->redirect(array('admin'));
            } else {
                if(isset($_POST['ajax'])) {
                    echo json_encode(['status' => false, 'message' => 'درخواست با خطا مواجه است. لطفا مجددا سعی نمایید.']);
                    Yii::app()->end();
                }
                Yii::app()->user->setFlash('failed', 'درخواست با خطا مواجه است. لطفا مجددا سعی نمایید.');
            }
        }

        $this->render('create', array(
            'model' => $model,
            'accModel' => $accModel,
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

        $attachment = new UploadedFiles($this->attachmentPath, $model->attachment);

        if (isset($_POST['Customers'])) {
            $oldAttachment = $model->attachment;
            $model->attributes = $_POST['Customers'];
            if ($model->save()) {
                $attachment->update($oldAttachment, $model->attachment, $this->tempPath);
                Yii::app()->user->setFlash('success', 'عملیات با موفقیت انجام شد.');
                $this->refresh();
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
        $sendTransfers = new Transfer();
        $sendTransfers->unsetAttributes();
        if (isset($_GET['Transfer']) && $_GET['ajax'] == 'send-grid') {
            $sendTransfers->attributes = $_GET['Transfer'];
        }

        $receiveTransfers = new Transfer();
        $receiveTransfers->unsetAttributes();
        if (isset($_GET['Transfer']) && $_GET['ajax'] == 'receive-grid') {
            $receiveTransfers->attributes = $_GET['Transfer'];
        }

        $debtorTransfers = new Transfer();
        $debtorTransfers->unsetAttributes();
        if (isset($_GET['Transfer']) && $_GET['ajax'] == 'debtor-grid') {
            $debtorTransfers->attributes = $_GET['Transfer'];
        }

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'sendTransfers' => $sendTransfers,
            'receiveTransfers' => $receiveTransfers,
            'debtorTransfers' => $debtorTransfers,
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

    public function actionClearing($id)
    {
        $this->pageTitle = 'تسویه بدهی';
        $model = Transfer::model()->findByPk($id);
        $model->setScenario('clearing');
        $model->payment_status = Transfer::PAYMENT_STATUS_PAID;
        $model->modified_date = time();
        if ($model->save())
            Yii::app()->user->setFlash('success', 'عملیات با موفقیت انجام شد.');
        else
            Yii::app()->user->setFlash('failed', 'درخواست با خطا مواجه است. لطفا مجددا سعی نمایید.');

        if (isset($_REQUEST['returnUrl']))
            $this->redirect($_REQUEST['returnUrl']);
        $this->redirect(array('/transfer/manage/admin'));
    }


    /***************************  Accounts Action  *****************************/
    public function actionAccounts($id)
    {
        $model = new CustomerAccounts('search');
        $model->unsetAttributes();
        if(isset($_GET['CustomerAccounts'])){
            $model->attributes = $_GET['CustomerAccounts'];
        }
        $model->customer_id = $id;

        $this->render('accounts',compact('model'));
    }

    public function actionAddAccount($id = false)
    {
        $model = new CustomerAccounts();
        if ($id)
            $model->customer_id = $id;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'account-customer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['CustomerAccounts'])) {
            $model->attributes = $_POST['CustomerAccounts'];
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    echo json_encode([
                        'status' => true,
                        'message' => 'عملیات با موفقیت انجام شد.',
                        'id' => $model->id,
                        'name' => "<div>{$model->bank_name} - {$model->account_number}</div>
                                <small>(" . CustomerAccounts::$numberTypeLabels[$model->number_type] . ")</small>",
                    ]);
                    Yii::app()->end();
                }
                Yii::app()->user->setFlash('success', 'عملیات با موفقیت انجام شد.');
                $this->refresh();
            } else {
                if (Yii::app()->request->isAjaxRequest) {
                    echo json_encode(['status' => false, 'message' => 'درخواست با خطا مواجه است. لطفا مجددا سعی نمایید.']);
                    Yii::app()->end();
                }
                Yii::app()->user->setFlash('failed', 'درخواست با خطا مواجه است. لطفا مجددا سعی نمایید.');
            }
        }

        $this->render('add_account', compact('model'));
    }

    public function actionDeleteAccount($id)
    {
        CustomerAccounts::model()->findByPk($id)->delete();

        // if AJAX request (triggered by deletion via admin grid views), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * @param int $id brandID
     * @return string
     */
    public function actionFetchAccounts($id)
    {
        $output = "<option value=''>شماره حساب موردنظر را انتخاب کنید...</option>";
        $empty = "<option value=''>برای این کاربر شماره حسابی ثبت نشده است...</option>";
        if ($accounts = CustomerAccounts::getList($id))
            foreach ($accounts as $account)
                $output .= "<option value='{$account->id}'>
                                <div>{$account->bank_name} - {$account->account_number}</div>
                                <small>(".CustomerAccounts::$numberTypeLabels[$account->number_type].")</small>
                            </option>";
        echo $accounts ? $output : $empty;
        return;
    }
}