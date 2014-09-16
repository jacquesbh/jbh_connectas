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
 * Resource Model of Request
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Model_Resource_Request extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Request Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('jbh_connectas/request', 'request_id');
    }

}
