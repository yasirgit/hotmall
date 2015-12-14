<?php 

class CouponManager extends TabularInputManager
{
 
    protected $class='Coupon';
 
    public function getItems()
    {
        if (is_array($this->_items))
            return ($this->_items);
        else 
            return array(
                //'n0'=>new Coupon,
            );
    }
 
 
    public function deleteOldItems($model, $itemsPk)
    {
        $criteria=new CDbCriteria;
        $criteria->addNotInCondition('coupon_id', $itemsPk);
        $criteria->addCondition("listing_id= {$model->primaryKey}");
 
        Coupon::model()->deleteAll($criteria); 
    }
 
 
    public static function load($model)
    {
        $return= new CouponManager;
        foreach ($model->p_coupons as $item)
            $return->_items[$item->primaryKey]=$item;
        return $return;
    }
 
 
    public function setUnsafeAttribute($item, $model)
    {
        $item->listing_id=$model->primaryKey;
 
    }
 
 
}

?>