<?php
return array(
//	'onBeginRequest'=>create_function('$event', 'return ob_start("ob_gzhandler");'),
//	'onEndRequest'=>create_function('$event', 'return ob_end_flush();'),
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Naseem Exchange',
	'timeZone' => 'Asia/Tehran',
	'theme' => 'abound',
	'sourceLanguage' => '00',
	'language' => 'fa_ir',
	// preloading 'log' component
	'preload'=>array('log','userCounter'),

	// autoloading model and component classes
	'import'=>array(
		'application.vendor.*',
		'application.models.*',
		'application.components.*',
		'ext.yiiSortableModel.models.*',
		'ext.dropZoneUploader.*',
		'application.modules.pages.models.*',
		'application.modules.setting.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admins',
		'users',
		'setting',
		'pages',
		'places',
        'contact',
        'map',
	),

	// application components
	'components'=>array(
		'request'=>array(
			'enableCsrfValidation'=>true,
		),
		'userCounter' => array(
			'class' => 'application.components.UserCounter',
			'tableUsers' => 'ym_counter_users',
			'tableSave' => 'ym_counter_save',
			'autoInstallTables' => true,
			'onlineTime' => 10, // min
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
			'loginUrl'=>array('/login'),
		),
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'connectionID'=>'db',
		),
		// uncomment the following to enable URLs in path-format
		// @todo change rules in projects
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'appendParams'=>true,
			'rules'=>array(
				'/page/<title:(.*)>'=>'/pages/manage/view',
				'/pages/<id:\d+>'=>'/pages/manage/view',
				'<action:(about|contact|help|terms|search|faq)>' => 'site/<action>',
				'<action:(logout|dashboard|googleLogin|login|register|changePassword|forgetPassword|profile|notifications|recoverPassword|bookmarks)>' => 'users/public/<action>',
				'<module:\w+>/<id:\d+>'=>'<module>/public/view',
				'<module:\w+>/<controller:\w+>'=>'<module>/<controller>/index',
				'<controller:\w+>/<action:\w+>/<id:\d+>/<title:(.*)>'=>'<controller>/<action>',
				'<controller:\w+>/<id:\d+>/<title:(.*)>'=>'<controller>/view',
				'<module:\w+>/<controller:\w+>/<id:\d+>/<title:\w+>'=>'<module>/<controller>/view',
				'<module:\w+>/<action:\w+>/<id:\d+>/<title:(.*)>'=>'<module>/manage/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>/view',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<title:\w+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class' => 'CFileLogRoute',
					'levels'=>'error, warning, trace, info',
					'categories'=>'application.*',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class' => 'CWebLogRoute',
					'enabled' => YII_DEBUG,
					'levels'=>'error, warning, trace, info',
					'categories'=>'application.*',
					'showInFireBug' => true,
				),
			),
		),
		'clientScript'=>array(
			'class'=>'ext.minScript.components.ExtMinScript',
			'coreScriptPosition' => CClientScript::POS_HEAD,
			'defaultScriptFilePosition' => CClientScript::POS_END,
		),
	),
	'controllerMap' => array(
		'min' => array(
			'class' =>'ext.minScript.controllers.ExtMinScriptController',
		),
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// @todo change webmail of emails
		'adminEmail'=>'info@afra841.ir',
		'noReplyEmail' => 'noreply@afra841.ir',
		'SMTP' => array(
			'Host' => 'mail.afra841.ir',
			'Secure' => 'ssl',
			'Port' => '465',
			'Username' => 'noreply@afra841.ir',
			'Password' => 'd(&u,zpGBjax',
		)
	),
);