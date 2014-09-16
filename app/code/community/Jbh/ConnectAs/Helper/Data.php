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
 * Data Helper
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * Put the cookie to say "Hey, you're connected as somebody else!"
     */
    public function putCookie(Mage_Customer_Model_Customer $customer)
    {
        Mage::getSingleton('core/cookie')->set(
            'connectas',
            $customer->getEmail()
        );
    }

    /**
     * Delete the cookie
     */
    public function deleteCookie()
    {
        Mage::getSingleton('core/cookie')->delete('connectas');
    }

    /**
     * Get the name in the cookie
     * @return string | false (FALSE if no cookie...)
     */
    public function getCookieValue()
    {
        $customerName = Mage::getSingleton('core/cookie')->get('connectas');
        if (!$customerName) {
            return false;
        }
        return $customerName;
    }

}