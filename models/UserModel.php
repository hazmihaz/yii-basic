<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $password
 * @property string|null $username
 * @property string|null $accessToken
 * @property int|null $role_id
 * @property string|null $name
 * @property string|null $nik
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $date_of_birth
 * @property string|null $level
 *
 * @property Role $role
 */
class UserModel extends \yii\db\ActiveRecord
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
            [['role_id'], 'integer'],
            [['password', 'username', 'accessToken', 'name', 'nik', 'phone', 'address', 'date_of_birth', 'level'], 'string', 'max' => 255],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password' => 'Password',
            'username' => 'Username',
            'accessToken' => 'Access Token',
            'role_id' => 'Role ID',
            'name' => 'Name',
            'nik' => 'Nik',
            'phone' => 'Phone',
            'address' => 'Address',
            'date_of_birth' => 'Date Of Birth',
            'level' => 'Level',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery|RoleQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
