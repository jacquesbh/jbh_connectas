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
 * Customer Controller
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_CustomerController extends Mage_Core_Controller_Front_Action
{

    /**
     * short_description_here
     * @return 
     */
    public function loginAction()
    {
        // Get the request
        $request = Mage::getModel('jbh_connectas/request')->load($this->getRequest()->getParam('id', null));

        if (!$request->getId() || $request->getHash() !== $this->getRequest()->getParam('hash', null)) {
            return $this->_forward('noroute');
        }

        // Logout the current customer
        Mage::getSingleton('customer/session')
            ->logout()
            ->renewSession();

        // Login the new customer
        $customer = Mage::getModel('customer/customer')->load($request->getCustomerId());
        Mage::getSingleton('customer/session')->setCustomerAsLoggedIn($customer);

        // Remove the request
        $request->delete();

        // Set the cookie
        Mage::helper('jbh_connectas')->putCookie($customer);

        // Redirect to the account
        return $this->_redirect('customer/account/index');
    }

}
