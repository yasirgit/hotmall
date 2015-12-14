<?php 

class AutoresponderManager extends TabularInputManager
{
 
    protected $class='Autoresponder';
 
    public function getItems()
    {
        if (is_array($this->_items))
            return ($this->_items);
        else 
            return array(
            );
    }
 
 
    public function deleteOldItems($model, $itemsPk)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('wlabel_id', Yii::app()->user->getWhiteLabelId());
        
        Autoresponder::model()->deleteAll($criteria); 
    }
 
 
    public static function load($model)
    {
        $return= new AutoresponderManager;
        foreach ($model->p_autoresponders as $item)
            $return->_items[$item->primaryKey]=$item;
        return $return;
    }
 
 
    public function setUnsafeAttribute($item, $model)
    {
    	$item->wlabel_id = Yii::app()->user->getWhiteLabelId();
    }
 
	/**
	 * saves the tags on db and delete not needed tags
	 * @param photograph the photograph on wich tags belongs to
	 */
	public function save($model)
	{
		$itemOk=array();
		foreach ($this->_items as $i=>$item)
		{
			$this->setUnsafeAttribute($item, $model);
			$item->save();
			$itemOk[]=$item->primaryKey;
		}
			
		return true;
	}    
}

?>