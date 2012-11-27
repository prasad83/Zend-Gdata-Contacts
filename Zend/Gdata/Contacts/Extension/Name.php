<?php

/**
 * https://github.com/prasad83/Zend-Gdata-Contacts
 * @author prasad
 * 
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Contacts
 */
require_once 'Zend/Gdata/Contacts/Extension.php';

require_once 'Zend/Gdata/Contacts/Extension/Name/FullName.php';
require_once 'Zend/Gdata/Contacts/Extension/Name/NamePrefix.php';
require_once 'Zend/Gdata/Contacts/Extension/Name/GivenName.php';
require_once 'Zend/Gdata/Contacts/Extension/Name/FamilyName.php';

class Zend_Gdata_Contacts_Extension_Name extends Zend_Gdata_Contacts_Extension {
	
	protected $_rootElement = 'name';
	
	protected $_fullName, $_namePrefix, $_givenName, $_familyName;

	/**
     * Creates individual Entry objects of the appropriate type and
     * stores them as members of this entry based upon DOM data.
     *
     * @param DOMNode $child The DOMNode to process
     */
    protected function takeChildFromDOM($child) {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
		$gdNamespacePrefix = $this->lookupNamespace('gd') . ':';

        switch ($absoluteNodeName) {
            case $gdNamespacePrefix . 'fullName';
                $fullName = new Zend_Gdata_Contacts_Extension_Name_FullName();
                $fullName->transferFromDOM($child);
                $this->_fullName = $fullName;
                break;
			case $gdNamespacePrefix . 'namePrefix';
                $namePrefix = new Zend_Gdata_Contacts_Extension_Name_NamePrefix();
                $namePrefix->transferFromDOM($child);
                $this->_namePrefix = $namePrefix;
                break;
			case $gdNamespacePrefix . 'givenName';
                $givenName = new Zend_Gdata_Contacts_Extension_Name_GivenName();
                $givenName->transferFromDOM($child);
                $this->_givenName = $givenName;
                break;
			case $gdNamespacePrefix . 'familyName';
                $familyName = new Zend_Gdata_Contacts_Extension_Name_FamilyName();
                $familyName->transferFromDOM($child);
                $this->_familyName = $familyName;
                break;
        }
    }
	
	public function getValue() {
		return $this->_fullName->getValue();
	}
}