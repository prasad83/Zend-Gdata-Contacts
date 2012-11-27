Zend-Gdata-Contacts
===================

Implementation of Gdata Contacts API for Zend based on [Darien Hager design proposal](http://framework.zend.com/wiki/display/ZFPROP/Zend_Gdata_Contacts+-+Darien+Hager) with minor changes.

Usage
=====

	require_once 'Zend/Gdata/Contacts.php';
	
	$client = ...; // Zend_Http_Client authorized (post login)
	
	$gdataContact = new Zend_Gdata_Contacts($client);
	
	// LISTING
	
	$feed = $gdataContact->getContactListFeed();
	$entries = $feed->getEntry();
	foreach($entries as $entry){
		echo("Name:\t".$entry->getName()."\n");
		echo("Notes:\t".$entry->getNotes()."\n");
		echo("Emails:\t".join(", ",$entry->getEmails())."\n"); 
		echo("Phones:\t".join(", ",$entry->getPhones())."\n"); 
		echo("Addresses:\t".join(", ",$entry->getAddresses())."\n");
	}
	
	// CREATE
	
	$entry = $gdataContact->newContactEntry();
	$entry->name = $gdataContact->newName("Test Contact " . microtime(true));
	
	$workEmail = $gdataContact->newEmail("email.work@test.tld");
	$homeEmail = $gdataContact->newEmail("email.work@test.tld", "home");
	
	$workAddress = $gdataContact->newStructuredPostalAddress("Test Work Address");
	$workAddress->street = $gdataContact->newStreet("@WorkStreet");
	
	$homeAddress = $gdataContact->newStructuredPostalAddress("Test Address Home", "home");
	$homeAddress->street = $gdataContact->newStreet("@HomeStreet");
	
	$workPhone   = $gdataContact->newPhoneNumber("987654321");
	$mobilePhone = $gdataContact->newPhoneNumber("123456789", "mobile");
	
	$entry->emails = array($workEmail, $homeEmail);
	$entry->phones = array($mobilePhone, $workPhone);
	$entry->addresses = array($homeAddress, $workAddress); 
	$entry->notes = $gdataContact->newNotes("Some notes about the contact");
	$entry->organization = $gdataContact->newOrganization("TestCompany", "TestTitle");
	
	$createdContact = $gdataContact->insertContact($entry);
	
	echo "ID: " . $createdContact->id->text;