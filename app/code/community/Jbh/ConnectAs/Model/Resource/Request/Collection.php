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
 * Collection of Request
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Model_Resource_Request_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Request Collection Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('jbh_connectas/request');
    }

// Monsieur Biz Tag NEW_METHOD

}