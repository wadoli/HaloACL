# Enabling LDAP support
## Introduction

The LDAP connector uses group and user definitions from an LDAP server in HaloACL

HaloACL can be connected to a LDAP or Active Directory server to use its structure of groups and users. The extension "LdapAuthentication" is required for this. See http://www.mediawiki.org/wiki/Extension:LDAP_Authentication for further information.

##  Requirements

* MediaWiki 1.13.2 or 1.15.1 - 1.15.3 or 1.16 - 1.17
* SMW 1.5.0 - SMW 1.6.0 (optional)
* Semantic Forms 1.9 - Semantic Forms 2.1.2 (optional)
* Access Control List extension 1.4 - 1.6 

## Enabling LDAP support

* Open the LocalSettings.php
* Set the variable 
```
        $haclgBaseStore = HACL_STORE_LDAP
```
* Add the following line:
```
        include_once('extensions/HaloACL/includes/HACL_Initialize.php');
        $haclgBaseStore = HACL_STORE_LDAP;
        enableHaloACL();
```
* Optionally, add the following variable to allow the integration of LDAP groups in HaloACL groups:
```
        $haclgAllowLDAPGroupMembers = true;
```
If LDAP is enabled for HaloACL (see $haclgBaseStore) you can choose if LDAP groups may be members of HaloACL groups. If this variable is true , your users can add LDAP groups to their own HaloACL groups. If it is ``` <false> ``` the set of LDAP and HaloACL groups remains completely separated.

** NOTE: ** HaloACL groups can never be members of LDAP groups as this would undermine security restrictions that are granted only for LDAP groups. The members of the HaloACL group would inherit the rights of the LDAP groups.

* Configure the extension LdapAuthentication in LocalSettings.php.

The extension allows configuring the connection to several LDAP/ActiveDirectory domains. The following example configuration shows one setting for an LDAP and an Active Directory system, respectively. Of course, these settings will vary for your system. Most variables originate from LdapAuthentication. Please refer to its documentation for further information.

## LDAP/ActiveDirectory settings
```
require_once( "$IP/extensions/LdapAuthentication/LdapAuthentication.php" );
$wgAuth = new LdapAuthenticationPlugin();
$wgLDAPDomainNames = array( "LDAP", "ActiveDirectory" );
$wgLDAPServerNames = 
	array(	"LDAP"    => "localhost",
			"ActiveDirectory" => 'localhost' );
$wgLDAPSearchStrings = 
	array(	"LDAP"    => "cn=USER-NAME,ou=people,dc=company,dc=com",
			"ActiveDirectory" => "USER-NAME@xyz.company.com");
$wgLDAPSearchAttributes = array(
			"LDAP" => "cn",
			"ActiveDirectory"=>"sAMAccountName"  );
$wgLDAPGroupUseFullDN = array(
			"ActiveDirectory"=>true  );

//User and password used for proxyagent access.
//Please use a user with limited access, NOT your directory manager!
$wgLDAPProxyAgent = array(
			"ActiveDirectory"=>"CN=Wikisysop,OU=Users,OU=SMW,DC=xyz,DC=company,DC=com" );
$wgLDAPProxyAgentPassword = array(
			"ActiveDirectory"=>"test"  );

 	
$wgLDAPEncryptionType = 
	array(	"LDAP"    => "clear",
			"ActiveDirectory" => "clear");
$wgLDAPLowerCaseUsername = 
	array(	"LDAP"    => true,
			"ActiveDirectory" => true);

$wgLDAPBaseDNs =
	array(	'LDAP' => 'dc=company,dc=com',
			"ActiveDirectory" => 'OU=SMW,DC=xyz,DC=company,DC=com');
	
$wgLDAPUserBaseDNs =	
	array(	'LDAP'    => 'ou=people,dc=company,dc=com',
			"ActiveDirectory" => 'OU=Users,OU=SMW,DC=xyz,DC=company,DC=com');
$wgLDAPGroupBaseDNs =	
	array(	'LDAP'    => 'ou=groups,dc=company,dc=com',
			"ActiveDirectory" => 'OU=Groups,OU=SMW,DC=xyz,DC=company,DC=com');
	
//The objectclass of the groups we want to search for
$wgLDAPGroupObjectclass = 
	array("LDAP"     => "groupOfNames" ,
		  "ActiveDirectory" => "group");

//The attribute used for group members
$wgLDAPGroupAttribute = 
	array(	"LDAP"=>"member" ,
			"ActiveDirectory" => "member");

//The naming attribute of the group
$wgLDAPGroupNameAttribute = 
	array(	"LDAP"    => "cn" ,
			"ActiveDirectory" =>  "cn");
$wgLDAPGroupSearchNestedGroups = 
	array(	"LDAP"    => true ,
			"ActiveDirectory" => true);
$wgLDAPUseLDAPGroups = 
	array(	"LDAP"    => true ,
			"ActiveDirectory" => true);

//The objectclass of the users we want to search for
$wgLDAPUserObjectclass = 
	array(	"LDAP"    => "inetOrgPerson" ,
			"ActiveDirectory" => "person"); // only for HaloACL
$wgLDAPUserNameAttribute = 
	array(	"LDAP"    => "cn" ,
			"ActiveDirectory" => "samaccountname"); // only for HaloACL
```
## Synchronizing users from the LDAP server

The UI shows the LDAP groups and their users. However, this is only possible if the users are really known to the wiki system. If a new LDAP server is connected to the wiki, unknown users will be displayed as 127.0.0.1 as unknown users default to localhost. The class HACLStorageLDAP provides the utility method createUsersFromLDAP which creates a user account for each LDAP user in the wiki.

The wiki administrator can invoke this function with the commandline script HACL_Setup.php in /extensions/HaloACL/maintenance/:

```
php HACL_Setup.php --createUsers --ldapDomain="Name of LDAP domain"
```
The Name of the LDAP domain is one of the domains that is specified in the LDAP configuration in LocalSettings.php.

## Copyright and License
Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
