<?php

/**
 * This is the model class for table "p_mediabrokers".
 *
 * The followings are the available columns in table 'p_mediabrokers':
 * @property integer $mbroker_id
 * @property integer $wlabel_id
 * @property integer $user_id
 * @property string $ref
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property PAdvertisers[] $pAdvertisers
 * @property PUsers $user
 * @property PWhitelabel $wlabel
 * @property PMediabrokersClicks[] $pMediabrokersClicks
 * @property PWhitelabel[] $pWhitelabels
 */
class Mediabroker extends CActiveRecord
{
	public $clicks;
	public $comm_pending;
	public $comm_approved;
	public $comm_paid;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Mediabroker the static model class
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
		return 'p_mediabrokers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wlabel_id, promocode', 'required'),
			array('wlabel_id, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('mbroker_id, wlabel_id, user_id, promocode', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'p_advertisers' => array(self::HAS_MANY, 'Advertiser', 'mbroker_id'),
			'p_users' => array(self::BELONGS_TO, 'User', 'user_id'),
			'p_whitelabel' => array(self::BELONGS_TO, 'Whitelabel', 'wlabel_id'),
			'p_mediabrokers_clicks' => array(self::HAS_MANY, 'MediabrokerClick', 'mbroker_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mbroker_id' => 'ID',
			'wlabel_id' => 'Wlabel',
			'user_id' => 'User',
			'date_created' => 'Date Created',
			'promocode' => 'Promocode',
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

		$criteria->compare('mbroker_id',$this->mbroker_id);
		$criteria->compare('wlabel_id',$this->wlabel_id);

		if($userStatus !== null) {
			$criteria->compare('p_users.status',$userStatus);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function getStatsData($mediabrokerIds) {
	    $clickData = $this->getClicksThisMonth($mediabrokerIds);

		$sql = "SELECT sum(amount) as amount, status, paystatus, mbroker_id FROM p_mediabrokers_commissions";

		if(is_array($mediabrokerIds)) {
			$sql .= " WHERE mbroker_id in (".implode(',', $mediabrokerIds).")";
		} else {
			$sql .= " WHERE mbroker_id=".$mediabrokerIds; 
		}
				
		$sql .= " GROUP BY status, paystatus, mbroker_id";

		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		$data = array();
		if(is_array($mediabrokerIds)) {
			foreach($mediabrokerIds as $id) {
				$data[$id]['clicks'] = (isset($clickData[$id]) ? $clickData[$id] : 0);
				$data[$id]['comm_pending'] = 0;
				$data[$id]['comm_approved'] = 0;
				$data[$id]['comm_paid'] = 0;
			}
		} else {
			$data[$mediabrokerIds]['clicks'] = (isset($clickData[$mediabrokerIds]) ? $clickData[$mediabrokerIds] : 0);
			$data[$mediabrokerIds]['comm_pending'] = 0;
			$data[$mediabrokerIds]['comm_approved'] = 0;
			$data[$mediabrokerIds]['comm_paid'] = 0;
		}

		foreach($results as $row) {
			if($row['paystatus'] == CommissionPayStatus::STATUS_PAID) {
				$data[$row['mbroker_id']]['comm_paid'] += $row['amount'];
				continue;
			}
			
			if($row['status'] == CommissionStatus::STATUS_PENDING) {
				$data[$row['mbroker_id']]['comm_pending'] += $row['amount'];
			} else { // approved
				$data[$row['mbroker_id']]['comm_approved'] += $row['amount'];
			}
		}

	    return $data;
	}	

	private function getClicksThisMonth($mediabrokerIds) {
		$sql = "SELECT mbroker_id, count(mbclicks_id) as count FROM p_mediabrokers_clicks".
				" WHERE date_created >=".date("m/d/Y", strtotime(date('m').'/01/'.date('Y').' 00:00:00'));
		
		if(is_array($mediabrokerIds)) {
			$sql .= " AND mbroker_id in (".implode(',', $mediabrokerIds).")";
		} else {
			$sql .= " AND mbroker_id=".$mediabrokerIds; 
		}
				
		$sql .= " GROUP BY mbroker_id";
				
		$dbCommand = Yii::app()->db->createCommand($sql);
		$results = $dbCommand->queryAll();

		$data = array();
		foreach($results as $row) {
			$data[$row['mbroker_id']] = $row['count'];
		}
		
		return $data;
	}
	
	public function getApprovedMediabrokersWithStats() {
		$criteria = new CDbCriteria;

		$criteria->compare('p_users.status',UserStatus::STATUS_APPROVED);
		
		$results = $this->with('p_users')->findAll($criteria);
		
		$rawData = array();

		$mbrokerIds = array();
		foreach($results as $row) {
			$mbrokerIds[] = $row->mbroker_id;
		}
		
		if(count($mbrokerIds) > 0) {
			$statsData = $this->getStatsData($mbrokerIds);
		}

		foreach($results as $row) {
			$row->clicks = $statsData[$row->mbroker_id]['clicks'];
			$row->comm_pending = '$ '.$statsData[$row->mbroker_id]['comm_pending'];
			$row->comm_approved = '$ '.$statsData[$row->mbroker_id]['comm_approved'];
			$row->comm_paid = '$ '.$statsData[$row->mbroker_id]['comm_paid'];
			$rawData[] = $row;
			
		}

		$dataProvider=new CArrayDataProvider($rawData, array(
			    'id'=>'mediabroker',
			    'keys'=>array('user_id', 'mbroker_id', 'wlaccount_id','name','icon','sort_order'), 
			));

		return $dataProvider;		
	}
	
	public function findByPromocode($promocode) {
		return $this->findByAttributes(array('promocode' => $promocode));
	}
}