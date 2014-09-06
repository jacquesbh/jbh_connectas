<?php
/**
 * This file is part of Jbh_ConnectAs for Magento.
 *
 * @license MIT (https://raw.github.com/jacquesbh/jbh_connectas/master/LICENSE)
 * @category Jbh
 * @package Jbh_ConnectAs
 * @copyright Copyright (c) 2012 Jacques Bodin-Hullin <jacques@bodin-hullin.net>
 */

/**
 * Adminhtml_Index Controller
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Log the admin on the customer's account
     * @access public
     * @return void
     */
    public function indexAction()
    {
        // We retrieve the customer
        $customer = Mage::getModel('customer/customer')->load($this->getRequest()->getParam('id', null));

        try {
            // Doesn't exist?
            if (!$customer->getId()) {
                Mage::throwException('User not found.');
            }

            $request = Mage::getModel('jbh_connectas/request');
            $request
                ->setCustomerId($customer->getId())
                ->setHash(hash('sha1', uniqid('customer_') . $customer->getId()))
                ->setCreatedAt(Mage::getSingleton('core/date')->gmtDate())
                ->save();

            // The store
            $preferedStoreViewId = $customer->getPreferedStoreViewId();
            if (!$preferedStoreViewId) {
                $preferedStoreView = Mage::app()
                        ->getWebsite($customer->getWebsiteId())
                        ->getDefaultStore();
                $preferedStoreViewId = $preferedStoreView->getStoreId();
            } else {
                $preferedStoreView = Mage::app()->getStore($customer->getPreferedStoreViewId());
            }

            // We redirect to the login front controller
            $url = $preferedStoreView->getUrl('jbh_connectas/customer/login', [
                'id' => $request->getId(),
                'hash' => $request->getHash(),
            ]);
            $this->_redirectUrl($url);

        } catch (Mage_Core_Exception $e) {

            // Error :)
            $this->_getSession()->addError($this->__($e->getMessage()));
            $this->_redirectReferer();
        }
    }

    /**
     * Is allowed?
     * @access protected
     * @return bool
     */
    protected function _isAllowed()
    {
        switch ($this->getRequest()->getActionName()) {
            case 'index':
                return Mage::getSingleton('admin/session')->isAllowed('customer/jbh_connectas');
                break;
            default:
                return false;
                break;
        }
    }

}