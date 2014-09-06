<?php
/**
 * This file is part of Jbh_ConnectAs for Magento.
 *
 * @license All rights reserved
 * @author Jacques Bodin-Hullin <@jacquesbh> <j.bodinhullin@monsieurbiz.com>
 * @category Jbh
 * @package Jbh_ConnectAs
 * @copyright Copyright (c) 2014 Monsieur Biz (http://monsieurbiz.com/)
 */

/**
 * Customer Controller
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_CustomerController extends Mage_Core_Controller_Front_Action
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

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

        // Redirect to the account
        return $this->_redirect('customer/account/index');
    }

// Monsieur Biz Tag NEW_METHOD

}