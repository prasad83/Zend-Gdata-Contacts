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

require_once 'Zend/Gdata/Contacts/Extension/OrgName.php';
require_once 'Zend/Gdata/Contacts/Extension/OrgTitle.php';

class Zend_Gdata_Contacts_Extension_Organzation extends Zend_Gdata_Contacts_Extension {
	protected $_rootElement = 'organization';
	
	protected $_orgName, $_orgTitle;
	
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
            case $gdNamespacePrefix . 'orgName';
                $orgName = new Zend_Gdata_Contacts_Extension_OrgName();
                $orgName->transferFromDOM($child);
                $this->_orgName = $orgName;
                break;
			case $gdNamespacePrefix . 'orgTitle';
                $orgTitle = new Zend_Gdata_Contacts_Extension_OrgTitle();
                $orgTitle->transferFromDOM($child);
                $this->_orgTitle = $orgTitle;
                break;
        }
    }
	
	public function getValue() {
		return $this->_orgName->getValue();
	}
	
}