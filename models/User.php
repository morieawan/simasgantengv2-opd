<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Model;
use yii\base\InvalidParamException;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $status
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $password;
    public $password2;
    public $tcari;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbluser}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            
            ['username', 'trim'],
            ['username', 'required','message' => 'Username tidak boleh kosong...'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Username sudah ada.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
        
            ['pengguna', 'required','message' => 'Nama Pengguna tidak boleh kosong.'],
            ['pengguna', 'string', 'max' => 128],
            [['namapengguna', 'namaopd'], 'string', 'max' => 255],
            ['nipBaru', 'string', 'max' => 18],
            ['tablok', 'string', 'max' => 10],
            
            ['updateby', 'string', 'max' => 128],

            ['role','required', 'message' => 'Role tidak boleh kosong.'],
            [['role', 'token_expired'], 'safe'],

            [['tcari', 'token_id'], 'string'],

            [['foto'],'file','skipOnEmpty'=>TRUE,'extensions'=>'jpg, png, jpeg, gif, bmp', 'maxSize'=>1024 * 200],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password' => 'Password',
            'password_hash' => 'Password Hash',
            'status' => 'Status',
            'pengguna' => 'Nama Pengguna',
            'namapengguna' => 'Nama',
            'tablok' => 'Tablok',
            'namaopd' => 'Nama OPD',
            'nipBaru' => 'NIP',
            'role' => 'Roles',
            'created' => 'Created',
            'modified' => 'Modified',
            'foto' => 'Foto Profil',
            'tcari' => 'Teks Pencarian',
            'updateby' => 'Diubah Oleh',
        ];
    }
    
    public static function getAllRoles($x)
    {
        $roles = explode(',', $x);
        //for($i=0; $i<=count($roles); $i++){
           //return $roles[$i];//Tipes::findOne($role)['namatipe'].', ';
        //}

        return $roles[0];
    }

    public function getUserTipe()
    {
        return $this->hasOne(Tipes::className(), ['tipe' => 'role']);
    }

    public function resetPassword()
    {
        $user = User::findOne($this->id);
        $user->setPassword($this->password);
        $user['modified'] = date('Y-m-d H:i:s');
        return $user->save(false);
    }

    public static function ubahPassword($id, $password)
    {
        $user = User::findOne($id);
        $user->setPassword($password);
        $user['modified'] = date('Y-m-d H:i:s');
        return $user->save(false);
    }

    public static function defaultPassword($id)
    {
        $user = User::findOne($id);
        $user->setPassword(substr($user['nipBaru'],0,8));
        $user['modified'] = date('Y-m-d H:i:s');
        $user['updateby'] = Yii::$app->session['nip'].'-'.Yii::$app->session['namapengguna'];
        $user->username = $user['nipBaru'];

        return $user->save(false);
    }
}
