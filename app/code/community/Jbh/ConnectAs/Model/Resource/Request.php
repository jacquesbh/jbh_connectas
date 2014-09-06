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
 * Resource Model of Request
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Model_Resource_Request extends Mage_Core_Model_Resource_Db_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

    /**
     * Request Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('jbh_connectas/request', 'request_id');
    }

// Monsieur Biz Tag NEW_METHOD

}