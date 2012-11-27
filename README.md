Zend-Gdata-Contacts
===================

Implementation of Gdata Contacts API for Zend based on [Darien Hager design proposal](http://framework.zend.com/wiki/display/ZFPROP/Zend_Gdata_Contacts+-+Darien+Hager) with minor changes.

Usage
=====

	require_once 'Zend/Gdata/Contacts.php';
	
	$client = ...; // Zend_Http_Client authorized (post login)
	
	$gdataContact = new Zend_Gdata_Contacts($client);
	$feed = $gdataContact->getContactListFeed();
	$entries = $feed->getEntry();
	foreach($entries as $entry){
		echo("Name:\t".$entry->getName()."\n");
		echo("Notes:\t".$entry->getNotes()."\n");
		echo("Emails:\t".join(", ",$entry->getEmails())."\n"); 
		echo("Phones:\t".join(", ",$entry->getPhones())."\n"); 
		echo("Address:\t".$entry->getAddress()->getFormattedAddress()."\n");
		echo("Street:\t".$entry->getAddress()->getStreet()."\n");
	}