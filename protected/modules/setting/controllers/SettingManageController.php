<?php

class SettingManageController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $defaultAction = 'changeSetting';
    public $tempPath = 'uploads/temp';
    public $bannerPath = 'uploads/banner';
    /**
     * @return array actions type list
     */
    public static function actionsType()
    {
        return array(
            'backend' => array(
                'gatewaySetting',
                'changeSetting',
                'socialLinks'
            )
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'checkAccess - upload, deleteUpload',
        );
    }
    public function actions()
    {
        return array(
            'upload' => array( // list image upload
                'class' => 'ext.dropZoneUploader.actions.AjaxUploadAction',
                'attribute' => 'banner',
                'rename' => 'random',
                'validateOptions' => array(
                    'acceptedTypes' => array('png', 'jpg', 'jpeg')
                )
            ),
            'deleteUpload' => array( // delete list image uploaded
                'class' => 'ext.dropZoneUploader.actions.AjaxDeleteUploadedAction',
                'modelName' => 'SiteSetting',
                'attribute' => 'value',
                'uploadDir' => '/uploads/banner/',
                'storedMode' => 'field'
            ),
            'uploadMap' => array( // list image upload
                'class' => 'ext.dropZoneUploader.actions.AjaxUploadAction',
                'attribute' => 'map_pic',
                'rename' => 'random',
                'validateOptions' => array(
                    'acceptedTypes' => array('png', 'jpg', 'jpeg')
                )
            ),
            'deleteMap' => array( // delete list image uploaded
                'class' => 'ext.dropZoneUploader.actions.AjaxDeleteUploadedAction',
                'modelName' => 'SiteSetting',
                'attribute' => 'value',
                'uploadDir' => '/uploads/map/',
                'storedMode' => 'field'
            ),
        );
    }

    /**
     * Change site setting
     */
    public function actionChangeSetting()
    {
        if (isset($_POST['SiteSetting'])) {
            foreach ($_POST['SiteSetting'] as $name => $value) {
                if ($name == 'keywords') {
                    $value = explode(',', $value);
                    SiteSetting::setOption($name, CJSON::encode($value));
                } elseif ($name == 'banner') {
                    $oldImage = SiteSetting::getOption($name);
                    $image = new UploadedFiles('uploads/banner', $oldImage);
                    SiteSetting::setOption($name, $value);
                    $image->update($oldImage, $value, $this->tempPath);
                } elseif ($name == 'map_pic') {
                    $oldImage = SiteSetting::getOption($name);
                    $image = new UploadedFiles('uploads/map', $oldImage);
                    SiteSetting::setOption($name, $value);
                    $image->update($oldImage, $value, $this->tempPath);
                } else
                    SiteSetting::setOption($name, $value);
            }
            Yii::app()->user->setFlash('success', 'اطلاعات با موفقیت ثبت شد.');
            $this->refresh();
        }
        $criteria = new CDbCriteria();
        $criteria->addCondition('name NOT REGEXP \'\\([^\\)]*gateway_.*\\)\'');
        $model = SiteSetting::model()->findAll($criteria);
        $this->render('_general', array(
            'model' => $model
        ));
    }



    public function actionChangePrice()
    {
        if (isset($_POST['SiteSetting']['price'])) {
            SiteSetting::setOption('price', $_POST['SiteSetting']['price']);
            Yii::app()->user->setFlash('success', 'اطلاعات با موفقیت ثبت شد.');
            $this->refresh();
        }
        $this->render('_price');
    }

    /**
     * Change site setting
     */
    public function actionSocialLinks()
    {
        $model = SiteSetting::getOption('social_links', false);
        if (isset($_POST['SiteSetting'])) {
            foreach ($_POST['SiteSetting']['social_links'] as $key => $link) {
                if ($link == '')
                    unset($_POST['SiteSetting']['social_links'][$key]);
                elseif ($key!='social_phone' && !preg_match("~^(?:f|ht)tps?://~i", $link))
                    $_POST['SiteSetting']['social_links'][$key] = 'http://' . $_POST['SiteSetting']['social_links'][$key];
            }
            if ($_POST['SiteSetting']['social_links'])
                $social_links = CJSON::encode($_POST['SiteSetting']['social_links']);
            else
                $social_links = null;
            SiteSetting::setOption('social_links', $social_links, 'شبکه های اجتماعی');
            Yii::app()->user->setFlash('success', 'اطلاعات با موفقیت ثبت شد.');
            $this->refresh();
        }
        $this->render('_social_links', array(
            'model' => $model
        ));
    }
}
