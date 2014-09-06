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
 * Request Model
 * @package Jbh_ConnectAs
 */
class Jbh_ConnectAs_Model_Request extends Mage_Core_Model_Abstract
{

// Monsieur Biz Tag NEW_CONST

// Monsieur Biz Tag NEW_VAR

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

// Monsieur Biz Tag NEW_METHOD

}