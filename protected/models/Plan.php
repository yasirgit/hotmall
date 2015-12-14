<?php

/**
 * This is the model class for table "p_plans".
 *
 * The followings are the available columns in table 'p_plans':
 * @property integer $plan_id
 * @property integer $wlabel_id
 * @property integer $type
 * @property string $name
 * @property integer $duration
 * @property string $price
 */
class Plan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Plan the static model class
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
		return 'p_plans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, duration, price', 'required'),
			array('wlabel_id, type, duration', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('wlabel_id', 'in', 'range'=>array_keys(CHtml::listData(WhiteLabel::model()->findAll(), 'wlabel_id', 'name')), 'allowEmpty'=>false),
			array('name', 'length', 'max'=>100),
			array('price', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('plan_id, wlabel_id, type, name, duration, price', 'safe', 'on'=>'search'),
		);
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
			'plan_id' => 'Plan',
			'wlabel_id' => 'Wlabel',
			'type' => 'Type',
			'name' => 'Plan Name',
			'duration' => 'Duration (In Days)',
			'price' => 'Price',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($planType)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('plan_id',$this->plan_id);
		$criteria->compare('wlabel_id',$this->wlabel_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('price',$this->price,true);

		if(!Yii::app()->user->isSuperadmin()) {
			$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		}
		
		$criteria->compare('type',$planType);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function findAllByType($planType) {
		$criteria=new CDbCriteria;
		$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		
		if($planType != 0) {
			$criteria->compare('type',$planType);
		}
		
		return $this->findAll($criteria);
	}
	
	public function findPlansWithText($planType) {
		$accounts = array();
		
		$criteria=new CDbCriteria;
		if($planType == PlanType::ADVERTISER_PLAN) {
			$criteria->compare('t.wlabel_id', Yii::app()->user->getWhiteLabelId());
		}
		$criteria->compare('type',$planType);
		
		$results = $this->findAll($criteria);

		foreach($results as $row) {
			$accounts[$row->plan_id] = $row->name.' for '.$row->duration.' days. Price: $'.$row->price;
		}
		
		return $accounts;
	}	
	
	public function verifyDelete() {
		
		if(PlanLimit::model()->findByAttributes(array('plan_id'=>$this->plan_id))) {
			throw new CHttpException(400,'You cannot delete plan that has some limits, delete limits first!');
		}

		if(PurchasedPlan::model()->findByAttributes(array('plan_id'=>$this->plan_id))) {
			throw new CHttpException(400,'You cannot delete a plan that was already purchased!');
		}

		return true;
	}	
}