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
class Jbh_ConnectAs_Adminhtml_ConnectasController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Log the admin on the customer's account
     * @access public
     * @return void
     */
    public function indexAction()
    {
        // We retrieve the customer
        /* @var $customer Mage_Customer_Model_Customer */
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
            if (null !== ($storeId = (int) \Mage::app()->getRequest()->get('store_id'))) {
                $preferedStoreView = Mage::app()->getStore($storeId);
            } elseif (!$preferedStoreViewId = $customer->getPreferedStoreViewId()) {
                if (!$customer->getStoreId()) {
                    $preferedStoreView = Mage::app()
                        ->getWebsite($customer->getWebsiteId())
                        ->getDefaultStore();
                } else {
                    $preferedStoreViewId = $customer->getStoreId();
                }
            }
            if (!isset($preferedStoreView)) {
                $preferedStoreView = Mage::app()->getStore($preferedStoreViewId);
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
