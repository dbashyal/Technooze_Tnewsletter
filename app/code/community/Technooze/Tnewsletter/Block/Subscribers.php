<?php
class Technooze_Tnewsletter_Block_Subscribers extends Mage_Core_Block_Template
{
    public function isActive()
    {
        return Mage::getStoreConfig('newsletter/tnewsletter/isactive');
    }
}