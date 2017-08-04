<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 * @property string $description
 * @property string $content
 * @property integer $image
 * @property integer $count_view
 * @property string $status
 * @property string $category_id
 * @property string $created_at
 *
 * @property User $user
 * @property TagAssign[] $tagAssigns
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    public $tag;
    public $translate_title;
    public $translate_description;
    public $translate_content;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'content', 'status'], 'required'],
            [['user_id', 'count_view','category_id'], 'integer'],
            [['content', 'status'], 'string'],
            [['created_at','tag'], 'safe'],
            [['count_view'], 'default','value'=>0],
            [['user_id'], 'default','value'=>Yii::$app->user->id],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['image'], 'file',  'extensions' => ['png','jpg','jpeg']],

            [['translate_title','translate_description','translate_content'], 'safe']

        ];
    }

    public function upload()
    {
        if ($this->validate() and $this->image->baseName) {
            $this->image->saveAs(Yii::$app->basePath.'/web/uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Sarlavha',
            'translate_title' => Yii::t('yii','Title'),
            'user_id' => 'Muallif',
            'description' => Yii::t('yii','Description'),
            'translate_description' => Yii::t('yii','Description'),
            'content' => 'Mazmuni',
            'translate_content' => Yii::t('yii','Content'),
            'category_id' => 'Kategoriya',
            'count_view' => 'Ko\'rishlar soni',
            'status' => 'Holati',
            'tag' => 'Kalit so\'zlar',
            'image' => 'Rasm',
            'created_at' => 'Sana',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagAssigns()
    {
        return $this->hasMany(TagAssign::className(), ['post_id' => 'id']);
    }

    public function getTitle($language=null)
    {
        $title = json_decode($this->title,true);

        if ($language) {
            if (isset($title[$language])) {
                return $title[$language];
            }else {
                return null;
            }
        }
        if (isset($title[Yii::$app->language])) {
            if ($title[Yii::$app->language]!='') {
                return $title[Yii::$app->language];
            }
            $a = null;
            foreach ($title as $value) {
                if ($value!='') {
                    $a = $value;
                    break;
                }
            }
            return $a;
        }else{
            $a = null;
            foreach ($title as $value) {
                if ($value!='') {
                    $a = $value;
                    break;
                }
            }
            return $a;
        }
    }
    public function getDescription($language=null)
    {
        $title = json_decode($this->description,true);

        if ($language) {
            if (isset($title[$language])) {
                return $title[$language];
            }else {
                return null;
            }
        }
        if (isset($title[Yii::$app->language])) {
            if ($title[Yii::$app->language]!='') {
                return $title[Yii::$app->language];
            }
            $a = null;
            foreach ($title as $value) {
                if ($value!='') {
                    $a = $value;
                    break;
                }
            }
            return $a;
        }else{
            $a = null;
            foreach ($title as $value) {
                if ($value!='') {
                    $a = $value;
                    break;
                }
            }
            return $a;
        }
    }
    public function getContent($language=null)
    {
        $title = json_decode($this->content,true);

        if ($language) {
            if (isset($title[$language])) {
                return $title[$language];
            }else {
                return null;
            }
        }
        if (isset($title[Yii::$app->language])) {
            if ($title[Yii::$app->language]!='') {
                return $title[Yii::$app->language];
            }
            $a = null;
            foreach ($title as $value) {
                if ($value!='') {
                    $a = $value;
                    break;
                }
            }
            return $a;
        }else{
            $a = null;
            foreach ($title as $value) {
                if ($value!='') {
                    $a = $value;
                    break;
                }
            }
            return $a;
        }
    }
}
