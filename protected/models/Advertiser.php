<?php

/**
 * This is the model class for table "p_advertisers".
 *
 * The followings are the available columns in table 'p_advertisers':
 * @property integer $advertiser_id
 * @property integer $wlabel_id
 * @property integer $user_id
 */
class Advertiser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Advertiser the static model class
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
		return 'p_advertisers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wlabel_id', 'numerical', 'integerOnly'=>true),
			//array('wlabel_id', 'in', 'range'=>array_keys(CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id', 'name')), 'allowEmpty'=>false),
			array('user_id, mbroker_id', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
                'p_whitelabel' => array(self::BELONGS_TO, 'WhiteLabel', 'wlabel_id'),
                'p_users' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'advertiser_id' => 'Advertiser',
			'wlabel_id' => 'Whitelabel Account',
			'user_id' => 'User Id',
			'mediabroker_id' => 'Media Broker Id',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($userStatus = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.advertiser_id',$this->advertiser_id);
		$criteria->compare('t.wlabel_id',Yii::app()->user->getWhiteLabelId());

		if($userStatus !== null) {
			$criteria->compare('p_users.status',$userStatus);
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function afterDelete() {
		User::model()->findByPk($this->user_id)->delete();
	}
	
	public function getAdvertisers() {
		$advertisers = array();
		
		$criteria = new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		
		$results = $this->with('p_users')->findAll($criteria);

		foreach($results as $row) {
			$name = 
			$advertisers[$row->advertiser_id] = $row->p_users->first_name.' '.$row->p_users->last_name.' ['.$row->p_users->username.']';
		}
		
		return $advertisers;
	}	
	
	public function delete() {
		if($this->wlabel_id != Yii::app()->user->getWhiteLabelId()) {
			return false;
		}
		
		return parent::delete();
	}	
	
	public function verifyDelete() {
		$advertiserId = $this->advertiser_id;
		
		if(Employee::model()->findByAttributes(array('advertiser_id'=>$this->advertiser_id))) {
			throw new CHttpException(400,'You cannot delete advertiser that contains some employees!');
		}

		if(PurchasedPlan::model()->findByAttributes(array('advertiser_id'=>$this->advertiser_id))) {
			throw new CHttpException(400,'You cannot delete advertiser that has some purchased plans!');
		}
		
		return true;
	}	
}