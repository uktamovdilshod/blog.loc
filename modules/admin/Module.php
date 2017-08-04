<?php

namespace app\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->viewPath =  '@app/modules/admin/views';
//        !Yii::$app->user->can("admin")?\Yii::$app->errorHandler->errorAction = '/admin/default/error':\Yii::$app->errorHandler->errorAction = '/site/error';

    }
}
