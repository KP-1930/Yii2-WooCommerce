<?php

use Yii;

namespace app\models;
use yii\web\IdentityInterface;


class User extends \yii\db\ActiveRecord implements IdentityInterface
{   
    public $password;
    public $confirm_password;
    public $authKey;
    

    public static function tableName()
        {
            return 'users';
        }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username','email','phone','role'],'required','message' => '{attribute} is required'],
            [['username','email'],'unique'],
            [['email'],'email'],
            [['gender'],'required','message'=>'Please Select Gender'],
            ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => ' Your password must contain at least one lower and upper case character and a digit.'],
            [['password', 'confirm_password'], 'string', 'min' => 2],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            [['username', 'email', 'phone','password_hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'UserName',
            'email' => 'Email',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'role' => 'Role',
        ];
    }
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (isset($this->password)) {
                $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }else {
            return false;
        }
    }
    

    
    public function getId() {
        return $this->getPrimaryKey();
    }

     public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    
   public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }


    


    
}


    

    





?>