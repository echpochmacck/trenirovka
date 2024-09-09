<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $authKey
 * @property string $phone
 * @property int $id
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'email', 'login', 'password',  'phone'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'login', 'password', 'authKey', 'phone'], 'string', 'max' => 255],
            [['login'], 'unique'],
            [['email'], 'unique'],
            ['email', 'email'],
            ['password', 'string', 'min' => 4],
            ['phone', 'match', 'pattern' => '/^\+[0-9]{12}$/', 'message' => 'В формате телефона']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамиля',
            'patronymic' => 'Очтество',
            'email' => 'Почта',
            'login' => 'Login',
            'password' => 'Пароль',
            'authKey' => 'Auth Key',
            'phone' => 'Телефон',
            'id' => 'ID',
        ];
    }

    public static function findByUsername($login)
    {

        return self::findOne(['login' => $login]);
    }

    public function validatePassword($password)
    {
        // var_dump(Yii::$app->security->generatePasswordHash($password));die;
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function setAuth($save = false)
    {
        $this->authKey = Yii::$app->security->generateRandomString();
        $save && $this->save(false);
    }

    public function register()
    {
        $this->password = Yii::$app->security->generatePasswordHash($this->password);
        $this->setAuth();
        return $this->save(false);
    }
}
