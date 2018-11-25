<?php

class AdminsDashboardController extends Controller
{
    /**
     * @return array actions type list
     */
    public static function actionsType()
    {
        return array(
            'backend' => array(
                'index'
            )
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'checkAccess - index', // perform access control for CRUD operations
        );
    }

    public function actionIndex()
    {
        if(in_array(Yii::app()->user->roles, ['transfer_admin', 'branch']))
            $this->redirect(['/transfer/manage/admin']);

        Yii::app()->getModule('contact');

        $messagesCriteria = new CDbCriteria();
        $messagesCriteria->compare('t.seen', 0);

        $statistics = [
            'messages' => ContactMessages::model()->count($messagesCriteria),
        ];

        $this->render('index', compact('statistics'));
    }
}