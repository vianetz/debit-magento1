<?php
/**
 * This file is part of the Itabs_Debit module.
 *
 * PHP version 5
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category  Itabs
 * @package   Itabs_Debit
 * @author    ITABS GmbH <info@itabs.de>
 * @copyright 2008-2014 ITABS GmbH (http://www.itabs.de)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @version   1.1.6
 * @link      http://www.magentocommerce.com/magento-connect/debitpayment.html
 */

/**
 * Customer Attribute Backend Encrypted
 */
class Itabs_Debit_Model_Entity_Customer_Attribute_Backend_Encrypted
    extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{
    /**
     * Encrypts the value before saving
     *
     * @param  Mage_Core_Model_Abstract $object Object
     * @return Itabs_Debit_Model_Entity_Customer_Attribute_Backend_Encrypted
     */
    public function beforeSave($object)
    {
        $attributeName = $this->getAttribute()->getName();

        if ($object->getData($attributeName) != '') {
            $value = Mage::helper('core')->encrypt($object->getData($attributeName));
            $object->setData($attributeName, $value);
        }

        return parent::beforeSave($object);
    }

    /**
     * Re-set the decrypted value to the object after saving again.
     *
     * @param  Mage_Core_Model_Abstract $object Object
     * @return Itabs_Debit_Model_Entity_Customer_Attribute_Backend_Encrypted
     */
    public function afterSave($object)
    {
        $attributeName = $this->getAttribute()->getName();

        if ($object->getData($attributeName) != '') {
            $value = Mage::helper('core')->decrypt($object->getData($attributeName));
            $object->setData($attributeName, $value);
        }

        return parent::afterSave($object);
    }

    /**
     * Decrypts the value after load
     *
     * @param  Mage_Core_Model_Abstract $object Object
     * @return Itabs_Debit_Model_Entity_Customer_Attribute_Backend_Encrypted
     */
    public function afterLoad($object)
    {
        $attributeName = $this->getAttribute()->getName();

        if ($object->getData($attributeName) != '') {
            $value = Mage::helper('core')->decrypt($object->getData($attributeName));
            $object->setData($attributeName, $value);
        }

        return parent::afterLoad($object);
    }
}
