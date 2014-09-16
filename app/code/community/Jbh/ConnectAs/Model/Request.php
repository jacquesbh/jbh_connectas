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
 * Request Model
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Model_Request extends Mage_Core_Model_Abstract
{

    /**
     * Prefix of model events names
     * @var string
     */
    protected $_eventPrefix = 'request';

    /**
     * Parameter name in event
     * In observe method you can use $observer->getEvent()->getObject() in this case
     * @var string
     */
    protected $_eventObject = 'request';

    /**
     * Request Constructor
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('jbh_connectas/request');
    }

}
