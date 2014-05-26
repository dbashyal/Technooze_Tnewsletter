<?php
require_once Mage::getModuleDir('controllers','Acidgreen_Newsletter').DS.'SubscriberController.php';
class Technooze_Tnewsletter_SubscriberController extends Acidgreen_Newsletter_SubscriberController
{

    /**
     * Subscription confirm action
     */
    public function confirmAction()
    {
        $id    = (int) $this->getRequest()->getParam('id');
        $code  = (string) $this->getRequest()->getParam('code');

        if ($id && $code) {
            $subscriber = Mage::getModel('newsletter/subscriber')->load($id);
            $session = Mage::getSingleton('core/session');

            if($subscriber->getId() && $subscriber->getCode()) {
                $subscriberPreConfirmed = clone $subscriber;
                if($subscriber->confirm($code)) {
                    $session->addSuccess($this->__('Your subscription has been confirmed.'));
                    $this->sendCouponEmail($subscriberPreConfirmed);
                } else {
                    $session->addError($this->__('Invalid subscription confirmation code.'));
                }
            } else {
                $session->addError($this->__('Invalid subscription ID.'));
            }
        }

        $this->_redirectUrl(Mage::getBaseUrl());
    }

    private function sendCouponEmail(Mage_Newsletter_Model_Subscriber $subscriber){
        // if user have never been confirmed before.
        if($subscriber->getData('subscriber_status') == Mage_Newsletter_Model_Subscriber::STATUS_UNCONFIRMED){
            $coupon = Mage::getModel('tnewsletter/subscriber')->getCouponCode();
            if($coupon){
                $transactionEmailId = Mage::getStoreConfig('newsletter/tnewsletter/email_template');
                $mailTemplate = Mage::getModel('core/email_template');
                // sendTransactional($templateId, $sender, $email, $name, $vars=array(), $storeId=null)
                $mailTemplate
                  ->setDesignConfig(array('area' => 'frontend'))
                  ->sendTransactional(
                      $transactionEmailId,
                      array(
                        'name' => Mage::getStoreConfig('trans_email/ident_general/name'),
                        'email' => Mage::getStoreConfig('trans_email/ident_general/email')
                      ),
                      $subscriber->getData('subscriber_email'),
                      Mage::getStoreConfig('general/store_information/name') . ' Subscriber',
                      array(
                        'couponCode' => $coupon
                      )
                  );

                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }
            }
        }
        return $this;
    }
}
