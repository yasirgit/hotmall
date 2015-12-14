<?php

/**
 * This is the model class for table "p_plans_limits".
 *
 * The followings are the available columns in table 'p_plans_limits':
 * @property integer $plimit_id
 * @property integer $resource_type
 * @property integer $limit_amount
 * @property integer $plan_id
 */
class PlanLimit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PlanLimit the static model class
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
		return 'p_plans_limits';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_type, limit_amount', 'required'),
			array('resource_type, limit_amount, plan_id', 'numerical', 'integerOnly'=>true),
			array('plan_id', 'in', 'range'=>array_keys(CHtml::listData(Plan::model()->findAllByType(0), 'plan_id', 'name')), 'allowEmpty'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('plimit_id, resource_type, limit_amount, plan_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
                'p_plans' => array(self::BELONGS_TO, 'Plan', 'plan_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'plimit_id' => 'Plimit',
			'resource_type' => 'Resource Type',
			'limit_amount' => 'Limit Amount',
			'plan_id' => 'Plan',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($planType)
	{
		return new CActiveDataProvider($this, array(
			    'criteria'=>array(
			        'condition'=>'t.plan_id in (select plan_id from p_plans where type='.$planType.' and wlabel_id='.Yii::app()->user->getWhiteLabelId().')',
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function getLimits($planId)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('plan_id',$planId);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getType($type) {
		return PlanResourceType::getType($type);
	}
}