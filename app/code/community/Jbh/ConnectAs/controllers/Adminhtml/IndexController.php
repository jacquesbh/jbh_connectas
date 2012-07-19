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
        // We retrive the customer
        $customer = Mage::getModel('customer/customer')->load($this->getRequest()->getParam('id', null));

        try {
            // Doesn't exist?
            if (!$customer->getId()) {
                Mage::throwException('User not found.');
            }

            // The store
            $preferedStoreViewId = $customer->getPreferedStoreViewId();
            if (!$preferedStoreViewId) {
                $preferedStoreViewId = Mage::app()
                        ->getWebsite($customer->getWebsiteId())
                        ->getDefaultStore()
                        ->getStoreId();
            }

            // Close the current session
            session_write_close();

            // Delete frontend's cookie
            $params = session_get_cookie_params();
            setcookie('frontend', '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

            // Create the new frontend's cookie :)
            session_name('frontend');
            session_start();
            $customer->setPreferedStoreViewId($preferedStoreViewId);

            // We set the customer and the store view
            Mage::app()->setCurrentStore(
                Mage::getModel('core/store')->load($preferedStoreViewId)
            );
            Mage::getSingleton('customer/session')->setCustomerAsLoggedIn($customer);

            // We redirect to the customer's account :)
            $this->_redirectUrl(Mage::helper('customer')->getAccountUrl());

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