<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string|null $auth_key
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * Заблокирован
     * @var int
     */
    const STATUS_BLOCKED = 0;
    /**
     * Заблокирован
     * @var int
     */
    const STATUS_ACTIVE = 1;

    /**
     * Ожидает подтверждения
     * @var int
     */
    const STATUS_WAIT = 2;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * Могут понадобиться при редактировании пользователя
     * 
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => self::className(), 'message' => 'Это имя пользователя уже занято'],
            ['username', 'string', 'min' => 3, 'max' => 20],
            ['username', 'match', 'pattern' => '#^[a-z]|[0-9]{3,}$#i'],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'Это email address уже занято.'],
            ['email', 'string', 'max' => 255],

            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_WAIT],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлён',
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'status' => 'Статус',
        ];
    }

    /**
     * Возвращаем имя статуса
     *
     * @return string
     */
    public function getStatusName(): string
    {
        return (string) ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }
 
    /**
     * Получаем массив имен статусов
     *
     * @return void
     */
    public static function getStatusesArray(): array
    {
        return [
            self::STATUS_BLOCKED => 'Заблокирован',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_WAIT => 'Ожидает подтверждения',
        ];
    }

   /**
     * @see IdentityInterface
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

   /**
     * @see IdentityInterface
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    /**
     * @see IdentityInterface
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

   /**
     * @see IdentityInterface
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @see IdentityInterface
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Кастомная валидация пароля
     *
     * @param string $password
     * @return void
     */
    public function validatePassword(string $password)
    {
        $user = User::findByUsername($this->username);

        if ($user && Yii::$app->security->validatePassword($password, $this->password_hash)) {
          
            return true;
        }

        return false;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * После сохранения
     *
     * @param [type] $insert
     * @return void
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }

            return true;
        }

        return false;
    }
}
