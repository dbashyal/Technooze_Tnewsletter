<?php

class Technooze_Tnewsletter_Model_Subscriber extends Mage_Newsletter_Model_Subscriber
{

    public function getCouponCode()
    {
        if (!Mage::getStoreConfig('newsletter/tnewsletter/isactive') && !Mage::getStoreConfig('newsletter/tnewsletter/sendcoupon'))
            return '';

        $model = Mage::getModel('salesrule/rule');
        $model->load(Mage::getStoreConfig('newsletter/tnewsletter/roleid'));
        $massGenerator = $model->getCouponMassGenerator();
        $massGenerator->setData(array(
            'rule_id' => Mage::getStoreConfig('newsletter/tnewsletter/roleid'),
            'qty' => 1,
            'length' => Mage::getStoreConfig('newsletter/tnewsletter/length'),
            'format' => Mage::getStoreConfig('newsletter/tnewsletter/format'),
            'prefix' => Mage::getStoreConfig('newsletter/tnewsletter/prefix'),
            'suffix' => Mage::getStoreConfig('newsletter/tnewsletter/suffix'),
            'dash' => Mage::getStoreConfig('newsletter/tnewsletter/dash'),
            'uses_per_coupon' => 1,
            'uses_per_customer' => 1
        ));
        $massGenerator->generatePool();
        $generated = $massGenerator->getGeneratedCount();
        $latestCoupon = max($model->getCoupons());
        $couponData = $latestCoupon->getData();
        if ($generated != 1)
            Mage::throwException($this->__('There was a problem with coupon generation.'));

        return $couponData['code'];
    }
}