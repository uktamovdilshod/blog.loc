<?php

namespace app\components;

use Yii;

class AccessRule extends \yii\filters\AccessRule
{
    protected function matchRole($user)
    {

        if (!Yii::$app->user->isGuest and Yii::$app->user->identity->role=='user' and
            Yii::$app->controller->module->id=='hello-it-is-me'
        ) {
            header('location:'.Yii::$app->homeUrl);
            exit;
        }

        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?' && $user->getIsGuest()) {
                return true;
            } elseif ($role === '@' && !$user->getIsGuest()) {
                return true;
            } elseif (!$user->getIsGuest()) {
                // user is not guest, let's check his role (or do something else)
                $roleOwn = Yii::$app->user->identity->role;
//                if ($role === $user->identity->role) {
                if ($role === $roleOwn) {
                    return true;
                }
            }
        }
        return false;
    }
}