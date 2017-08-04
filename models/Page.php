<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $count_view
 * @property string $status
 * @property string $created_at
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status'], 'required'],
            [['content', 'status'], 'string'],
            [['count_view'], 'integer'],
            [['created_at'], 'safe'],
            [['count_view'], 'default','value'=>0],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Sarlavha',
            'content' => 'Mazmuni',
            'count_view' => 'Ko\'rishlar soni',
            'status' => 'Holati',
            'created_at' => 'Sana',
        ];
    }
}
