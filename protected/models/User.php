<?php

/**
 * This is the model class for table "p_users".
 *
 * The followings are the available columns in table 'p_users':
 * @property integer $user_id
 * @property integer $wlabel_id
 * @property string $username
 * @property string $password
 * @property integer $type
 * @property integer $status
 * @property string $date_created
 * @property string $date_lastlogin
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $country
 * @property string $phone
 * @property string $alt_phone
 * @property string $fax
 * @property string $email
 */
class User extends CActiveRecord
{
	public $confirm_password;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'p_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wlabel_id, username, password, type, status, date_created', 'required'),
			array('wlabel_id', 'in', 'range'=>array_keys(CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id', 'name')), 'allowEmpty'=>false),
			array('username, password, confirm_password, first_name, last_name, city', 'length', 'max'=>50),
			array('address', 'length', 'max'=>100),
			array('username', 'checkUsernameIsUniqueAndCorrect'),
			array('state, zipcode, country, phone, alt_phone, fax, email', 'length', 'max'=>40),
			array('date_lastlogin', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, wlabel_id, username, password, type, status, date_created, date_lastlogin, first_name, last_name, address, city, state, zipcode, country, phone, alt_phone, fax, email', 'safe', 'on'=>'search'),
		);
	}

	public function checkUsernameIsUniqueAndCorrect($attribute,$params) {
		$code_entities_match = array('\'',' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','='); 
		$code_entities_replace = array('', '-','-','','','','','','','','','','','','','','','','','','','','','','','',''); 
		$username = str_replace($code_entities_match, $code_entities_replace, $this->username);
		
		if($username != $this->username) {
			$this->addError($attribute, 'Username contains unallowed characters. It cannot contain spaces or special chars!');
			return false;
		}
		
		// check the domain is unique in the account
		$users = User::model()->findAllByAttributes(array('username'=>$this->username));
		if($users != null) {
			if($this->isNewRecord) {
				$this->addError($attribute, 'There already exists user with the same username, please use different one!');
				return;
			}
			
			foreach($users as $user) {
				if($user->user_id != $this->user_id) {
					// found other user with the same subdomain
					$this->addError($attribute, 'There already exists user with the same username, please use different one!');
					return;
				}
			}
		}
		
		return true;
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
                'p_whitelabel' => array(self::BELONGS_TO, 'WhiteLabel', 'wlabel_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'wlabel_id' => 'Whitelabel Account',
			'username' => 'Username',
			'password' => 'Password',
			'confirm_password' => 'Confirm Password',
			'type' => 'Type',
			'status' => 'Status',
			'date_created' => 'Added',
			'date_lastlogin' => 'Date Last Login',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'address' => 'Address',
			'city' => 'City',
			'state' => 'State',
			'zipcode' => 'Zipcode',
			'country' => 'Country',
			'phone' => 'Phone',
			'alt_phone' => 'Alt Phone',
			'fax' => 'Fax',
			'email' => 'Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('wlabel_id',$this->wlabel_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_lastlogin',$this->date_lastlogin,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('alt_phone',$this->alt_phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchAdmins()
	{

		$criteria=new CDbCriteria;
		$criteria->compare('type',array(UserType::TYPE_SUPERADMIN, UserType::TYPE_WHITELABELADMIN));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected $_oldPassword;

	protected function getHash($password) {
		return md5($password);
	}

	function afterFind() {
		if ($this->date_created == '0000-00-00') {
			$this->date_created = '';
		} else {
			$this->date_created = date("j.n.Y", strtotime($this->date_created));
		}

		//$this->type = 'aaa';

		$this->_oldPassword = $this->password;
		$this->password = '*****';

		return parent::afterFind();
	}

	function beforeSave() {
		if (strtotime($this->date_created)) {
			$this->date_created = date("Y-m-d", strtotime($this->date_created));
		} else {
			$this->date_created = '0000-00-00';
		}

		if ($this->password == '*****') {
			$this->password = $this->_oldPassword;
		} else {
			if ($this->_oldPassword != $this->password) $this->password = $this->getHash($this->password);
		}

		return parent::beforeSave();
	}

	public function matchesPassword($password) {
		return ($this->getHash($password) == $this->_oldPassword);
	}

	public function getType($type) {
		return UserType::getType($type);
	}
	
	public function getStatus($status) {
		return UserStatus::getStatus($status);
	}

	public function hasAttribute($name)
    {
		if($name == 'confirm_password') return true;

		return parent::hasAttribute($name);
    }	
}