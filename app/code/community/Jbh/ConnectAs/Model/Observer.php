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
 * Observer Model
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Model_Observer extends Mage_Core_Model_Abstract
{

    /**
     * Add the "connect as" button in admin :)
     * @param Varien_Event_Observer $observer The observer
     * @access public
     * @return void
     */
    public function addOurCoolButton(Varien_Event_Observer $observer)
    {
        // We add the button if the admin is allowed and if we have the block :)
        if (Mage::getSingleton('admin/session')->isAllowed('customer/jbh_connectas') && ($block = Mage::app()->getLayout()->getBlock('customer_edit'))) {
            $stores = Mage::app()->getStores();
            foreach ($stores as $store) {
                $block->addButton('jbh_connectas_store_' . $store->getId(), [
                    'label'   => Mage::helper('jbh_connectas')->__('Connect As') . sprintf(' (%s)', $store->getCode()),
                    'onclick' => 'window.open(\'' . Mage::helper('adminhtml')->getUrl('adminhtml/connectas',
                        ['id' => Mage::registry('current_customer')->getId(), 'store_id' => $store->getId()]) . '\')',
                    'class'   => 'go'
                ]);
            }
        }
    }

    /**
     * Remove the connact as cookie
     */
    public function removeCookie()
    {
        Mage::helper('jbh_connectas')->deleteCookie();
    }

}
