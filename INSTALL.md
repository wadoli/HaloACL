# Access Control List extension #

Do you like collaborating? Probably, because otherwise you would not manage a Wiki.

Perhaps your vision is to unleash crowd wisdom and let everybody contribute boundlessly. Or you want to assemble an exclusive circle that works together on arts projects. Or you would like to support employees with sharing knowledge and need well-arranged structures for this.

Never mind what contribution policy you want to follow: The ACL puts in your hands the capability of controlling MediaWikis editing possibilities via a simple graphical user interface. Define hierarchic user groups, assign freely combinations of over 50 permission objects (e.g. reading, editing, protecting, editinterface etc.) and be even able to build your own groups of these permissions - thanks to the Access Control List extension.

**Enjoy the Access Control List extension features:**

- Manage access to system features via graphical user interface (see example)
- Define user groups and "groups of groups" and/or import them via the Lightweight Directory Access Protocol (LDAP)
- Combine your own permission sets out of over 50 system features and assign them to groups or individual users
- Make use of group hierarchies to pilot all of the contribution and editing processes in your Wiki


## Administration and Installation ##
This articles guides you through installation and other administrative work


### Requirements & Compatibility ###
* [`Patch` for Linux](http://en.wikipedia.org/wiki/Patch_(Unix))
* [MediaWiki 1.13.2, 1.15.1 - 1.15.3, 1.16.0 - 1.16.4 or 1.17.0 - 1.17.2](http://www.mediawiki.org/wiki/Download)
* [Semantic MediaWiki 1.7.*, 2.*](http://www.mediawiki.org/wiki/Extension:Semantic_MediaWiki)
* [Semantic Forms 1.9 - 2.1.2](http://www.mediawiki.org/wiki/Extension:Semantic_Forms)
* Optional: [Memcached](http://memcached.org)
* Obsolete: [ScriptManager 1.x](http://www.mediawiki.org/wiki/Extension:ScriptsManager)
* Obsolete: [ARCLibrary 1.x](http://www.mediawiki.org/wiki/Extension:ARCLibrary)


### Installation ###

#### How to install manually ####

1. Include the path to **php.bin** to the system variable PATH (either Windows or Linux), e.g. `C:xamppphp;`
3. Extract the HaloACL ZIP archive
4. Copy the folders 'HaloACL', 'ScriptManager' and 'ARCLibrary' into the extensions folder of MediaWiki.
5. Activate the HaloACL by adding the following lines to LocalSettings.php:

	```PHP
include_once('extensions/HaloACL/includes/HACL_Initialize.php');
	enableHaloACL(); 
$wgMainCacheType = CACHE_MEMCACHED;
$wgMemCachedServers = array('localhost:11211');
```

	**Note:**
	If you already have custom namespaces on your site, insert `$haclgNamespaceIndex = ???;` into your LocalSettings.php **before** the call of HACL_Initialize.php. The number ??? must be the smallest even namespace number that is not in use yet. However, it must not be smaller than 100.

6. Open a command prompt
7. Go to the base directory of your MediaWiki
8. Choose the command depending on your MediaWiki installation to patch MediaWiki:

	```Shell
cp extensions/HaloACL/<patchfile_for_MW> .
patch < <patchfile_for_MW>
or
php patch.php -d <mediawiki-dir> -p patch_for_MW_1.17.0.txt
```

9. Choose the command depending on your Semantic MediaWiki installation to patch SMW (skip this step if you don't have SMW installed), e. g. `php patch.php -d <mediawiki-dir> -p patch_for_SMW_1.7.1.txt`
10. Execute the following command to patch Semantic Forms (skip this step if you don't have the Semantic Forms extension installed), e. g. `php patch.php -d <mediawiki-dir> -p patch_for_SF_2.1.2.txt`
11. Update the database: The HaloACL extension requires some additional tables in the database that must be added to the existing database schema. Existing data will not be modified. Therefore change into the maintenance folder of the HaloACL extension and run the setup script:

	```Shell
cd /folder_to_mediawiki/extension/HaloACL/maintenance
php HACL_Setup.php
```

12. After a successful installation in the LocalSettings.php the following section must appear: `/*haloacl-start*/ ... /*haloacl-end*/`


#### Notes on patches ####

##### Notes on patches for Mediawiki #####

This patch adds semantic protection of properties and their values and filters links to protected pages from several special pages. On other pages these links are replaced by a link to the page "Permission denied". This patch is optional.


##### Notes on patches for Semantic Mediawiki #####

This patch adds semantic protection of properties and their values. This patch is recommended.


##### Notes on patches for SemanticForms #####

This patch checks if pages can be edited with Semantic Forms.

This patch for Semantic Forms is mandatory, if you want to protect the values of semantic properties in semantic forms and if you want to use the HaloACL toolbar in forms.

**Note:**
The patch files were created in Eclipse. They can be installed using the tool patch.php from the deploy framework (smwhalo-deploy-1.0) which itself uses GNU patch. The patch.php is also included in this extension. Go into the root directory of the extension and run the following command:

	php patch.php -p <patch-file> -d <mediawiki-dir> --onlypatch


#### Creating default groups with default rights ####

After the database is updated you can, if you want, create some default groups with default permissions, like the ones that come with a SMW+ installation.


|  Group  |  Default permissions  |
| ----- | ----- |
|  Knowledge consumer  |  read  |
|  Knowledge provider  |  read, edit, upload  |
| Knowledge architect  |  read, edit, manage, upload  |
| sysop  |  read, edit, manage, upload, administrate, technical |
| bureaucrat  |  read, edit, manage, upload, administrate, technical  |

The user "WikiSysop" is the default member of these groups.

**To create these defaults you have to execute the following on the command line:**

```Shell
cd /folder_to_mediawiki/extension/HaloACL/maintenance
php HACL_Setup.php --initDefaults
```

**Note:**

This step is only necessary if you have installed the extension manually; executing the installation with the wiki Administration Tool, will add these groups and permissions automatically.

### Language support ###
Currently, the only supported languages are English, German and French.

#### Changing language ####
1. **Open the LocalSettings.php**
2. **Change the value of `$wgLanguageCode` to your desired language**
For German enter ‘`de`’
For English enter ‘`en`’
For French enter ‘`fr`’

	**Note:**

	The label of the special pages change according to the selected language. In this case you'll find the special page to HaloACL under "Spezial:HaloACL" when using German, "Spécial:HaloACL" when using French. However, the page will be in english.

	Because of those 'Translations' and some more static translations of this kind it is not recommended to switch the language after the Wiki has got content. It is recommended to define the language only right after the installation. The chosen language is static for the whole wiki and can not be changed afterwards. (unless you translate all the content of course).

	Do not confuse this language of the content with the language of a user. User language for the UI may be changed for each user separately in preferences.


### Testing your Installation ###
1. Go to the special page `Special:Version` page and you should see **HaloACL (Version nn)** listed under **Other**.
2. Go to the special page `Special:HaloACL` to start defining access control lists.

### Troubleshooting ###

#### Error in forms ####

Unfortunately there was a bug in the SMW patch in HaloACL 1.1. The reason for this patch was that the SF namespace constants where defined twice, which lead to an error when the second define statements came up. Semantic Forms is independend from HaloACL thus any version of SF should run with HaloACL.

Open the file extensions/SemanticMediaWiki/includes/SMW_GlobalFunctions.php and remove the slashes before the lines:

```PHP
	//		define('SF_NS_FORM', $smwgNamespaceIndex+6);
	//		define('SF_NS_FORM_TALK', $smwgNamespaceIndex+7);
```

#### Call to undefined method ####

While creating a property the following error occurs after saving:

Fatal error: Call to undefined method SMWPropertyValue::userCan() in `/var/www/webapps/halo/extensions/HaloACL/includes/HACL_Evaluator.php`

This problem occurs if HaloACL protects properties and SMW is not patched. There are two solutions for your problem (with HaloACL enabled):

1. In HACL_Initialize.php, set

	```PHP
$haclgProtectProperties=false;
```	

	In this case, properties are not protected, or

2. Apply the patch in patch_for_SMW_1.4.2.txt to SMW. This is the recommended solution.

	**Note:**

	If you are using SMW 1.4.3 you have to look for **patch_for_SMW_1.4.3.txt**, located at **..extensionsHaloACL**


#### Database query syntax error Special:Form ####

The patches are missing, follow the instructions in step 3 to install the patches.


#### Special:HaloACL is empty ####

The content of Special:HaloACL is almost completely loaded by two ajax functions. Sometimes problems occur when jquery.js is loaded before protoype.js. With the Firebug extension of Firefox it is possible to track all ajax calls. When you open Special:HaloACL, there should be two ajax call:

```PHP
http://localhost/develwiki/index.php/Special:HaloACL?action=ajax&amp;rs=haclCreateACLPanels
http://localhost/develwiki/index.php/Special:HaloACL?action=ajax&amp;rs=haclCreateAclContent
```

**How to track the ajax calls:**

1. Open Firefox
2. Click the little bug icon in the status bar at the bottom to activate Firebug.
3. Go to Network in the Firebug menu, click the little triangle and activate the Network feature.
4. Open the special page Special:HaloACL in your wiki. Maybe you have to refresh the page once more (F5).
5. You should see all GET and POST requests sent by Firefox. For the HaloACL there are 78 requests.
6. You can switch to the Console of Firebug. It shows only the two ajax calls needed for Special:HaloACL
7. Furthermore the console shows JavaScript errors or warnings.

**Note:**

This bug is fixed for HaloACL version 1.1.1. If Special:HaloACL is empty, first go through the installation instructions, then check if all needed patches are installed.

### Configuration ###

All configuration options are defined and described in ../HaloACLincludes/HACL_Initialize.php.

| Parameter | Description |
|---|---|
| `$haclgUseFeaturesForGroupPermissions` | boolean, default value: `true`<br>Enable this variable if you want to use the HaloACL for defining global permissions. Otherwise a set of default permissions will be created that will overwrite all $wgGroupPermissions for anonymous ('*') and registered ('user') users. If this variable is set to true, you can further define features that will appear in the ACL as global permissions using the array $haclgFeature. |
| `$haclgFeature` | Normally the system variable is filled with some default permissions (system settings). You can extend this feature list by defining them in this array. See "Configuring features for global permissions". |
| `$haclgIP` | `$IP . '/extensions/HaloACL';` <br> This is the path to your installation of HaloACL as seen on your local filesystem. Used against some PHP file path issues. |
| `$haclgHaloScriptPath` | `$wgScriptPath . '/extensions/HaloACL';` <br> This is the path to your installation of HaloACL as seen from the web. Change it if required (`$wgScriptPath` is the path to the base directory of your wiki). No final slash. |
| `$haclgEnableTitleCheck` | boolean, default value: `false;` # Set this variable to false to disable the patch that checks all titles for accessibility. Unfortunately, the Title-object does not check if an article can be accessed. A patch adds this functionality and checks every title that is created. If a title can not be accessed, a replacement title called "Permission denied" is returned. This is the best and securest way of protecting an article, however, it slows down things a bit. |
| `$haclgOpenWikiAccess` | boolean, default value: `true;` <br> _true_: If this value is <true>, all articles that have no security descriptor are fully accessible. Remember that security descriptor are also inherited via categories or namespaces. <br> _false_: If it is <false>, no access is granted at all. Only the latest author of an article can create a security descriptor. |
| `$haclgProtectProperties` | boolean, default value: `true;` <br> _true_: If this value is <true>, semantic properties can be protected. <br> _false_: If it is <false>, semantic properties are not protected even if they have security descriptors. |
| `$haclgBaseStore` | `HACL_STORE_SQL;` <br> By design several databases can be connected to HaloACL. (However, in the first version there is only an implementation for MySQL.) With this variable you can specify which store will actually be used. Possible values: `\- HACL_STORE_SQL` |
| `$haclgUnprotectableNamespaces` | `array('Main');` <br> This array contains the names of all namespaces that can not be protected by HaloACL. This bears the risk that users can block all articles of a namespace if it has no security descriptor yet. On the other hand, if each namespace would have a security descriptor, then all authorized users for that namespace will be able to access all articles in that namespace, even if security descriptors for individual articles define another set authorized users. The name of the main namespace is 'Main'. |
| `//$haclgNewUserTemplate` | `”ACL:Template/NewUserTemplate";`																  <br> This is the name of the master template that is used as default rights template for new users. Every user can define his own default rights for new pages. He does this in a security descriptor with the naming convention "`ACL:Template/<username>`". The content of this article is assigned to security descriptors that are automatically generated for new pages. However, for new users there is no default template. With this setting you can specify a master template (a name of an article) that is used to create a default template for new users. The master template is a normal security descriptor that can contain the variable "`{{{user}}}`" that will be replaced by the user's name. <br> See "Creating security descriptors automatically". |
| `$haclgEvaluatorLog` | boolean, default value: `false;` <br> If `$haclgEvaluatorLog is <true>`, you can specify the URL-parameter "hacllog=true". In this case HaloACL echos the reason why actions are permitted or prohibited. |
| `$haclgEncryptionKey` | `”MY VERY SECRET KEY";` <br> This key is used for protected properties in Semantic Forms. SF has to embed all values of input fields into the HTML of the form, even if fields are protected and not visible to the user (i.e. user has no right to read.) The values of all protected fields are encrypted with the given key. YOU SHOULD CHANGE THIS KEY AND KEEP IT SECRET. |
| `$haclgThrowExceptionForMissingFeatures` | boolean, default value: `true;` <br> The names of the features that are defined here are stored as reference in the database if they are actually used. If the definition of a feature is removed the corresponding rights can no longer be set. Normally this will lead to an exception that informs about the missing feature. If `haclgThrowExceptionForMissingFeatures` is false, this exception will not be thrown and the rights for the missing feature will be silently ignored. |


### Known issues ###

#### Security exception during SMW refresh ####

The SMW's refresh script is executed as anonymous user. It tries to access all pages including those for which it does not have access rights. So HaloACL actually behaves correctly. warning.pngCould not connect to Web Service. Please check your Wiki Web Service Definition.


#### Workaround ####

The quick solution is to disable HaloACL in LocalSettings while doing the refresh.

## LDAP support ##

### Enabling LDAP support ###
The LDAP connector uses group and user definitions from an LDAP server in HaloACL

You have to set the variable $haclgBaseStore = HACL_STORE_LDAP, either in 
HACL_Initialize.php or in LocalSettings.php.

In LocalSettings.php it has to look like this:

```PHP
include_once('extensions/HaloACL/includes/HACL_Initialize.php');
$haclgBaseStore = HACL_STORE_LDAP;
enableHaloACL(); 
```

After that the extension LdapAuthentication has to be configured in LocalSettings.php.
The extension allows configuring the connection to several LDAP/ActiveDirectory
domains. The following example configuration shows one setting for an LDAP and an
Active Directory system, respectively. Of course, these settings will vary for
your system. Most variables originate from LdapAuthentication. Please refer to
its documentation for further information.

```PHP
//--- LDAP/ActiveDirectory settings ---

require_once( "$IP/extensions/LdapAuthentication/LdapAuthentication.php" );
$wgAuth = new LdapAuthenticationPlugin();
$wgLDAPDomainNames = array( "LDAP", "ActiveDirectory" );
$wgLDAPServerNames = 
	array(	"LDAP"	=> "localhost",
			"ActiveDirectory" => 'localhost' );
$wgLDAPSearchStrings = 
	array(	"LDAP"	=> "cn=USER-NAME,ou=people,dc=company,dc=com",
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
	array(	"LDAP"	=> "clear",
			"ActiveDirectory" => "clear");
$wgLDAPLowerCaseUsername = 
	array(	"LDAP"	=> true,
			"ActiveDirectory" => true);

$wgLDAPBaseDNs =
	array(	'LDAP' => 'dc=company,dc=com',
			"ActiveDirectory" => 'OU=SMW,DC=xyz,DC=company,DC=com');
	
$wgLDAPUserBaseDNs =	
	array(	'LDAP'	=> 'ou=people,dc=company,dc=com',
			"ActiveDirectory" => 'OU=Users,OU=SMW,DC=xyz,DC=company,DC=com');
$wgLDAPGroupBaseDNs =	
	array(	'LDAP'	=> 'ou=groups,dc=company,dc=com',
			"ActiveDirectory" => 'OU=Groups,OU=SMW,DC=xyz,DC=company,DC=com');
	
//The objectclass of the groups we want to search for
$wgLDAPGroupObjectclass = 
	array("LDAP"	 => "groupOfNames" ,
		  "ActiveDirectory" => "group");

//The attribute used for group members
$wgLDAPGroupAttribute = 
	array(	"LDAP"=>"member" ,
			"ActiveDirectory" => "member");

//The naming attribute of the group
$wgLDAPGroupNameAttribute = 
	array(	"LDAP"	=> "cn" ,
			"ActiveDirectory" =>  "cn");
$wgLDAPGroupSearchNestedGroups = 
	array(	"LDAP"	=> true ,
			"ActiveDirectory" => true);
$wgLDAPUseLDAPGroups = 
	array(	"LDAP"	=> true ,
			"ActiveDirectory" => true);

//The objectclass of the users we want to search for
$wgLDAPUserObjectclass = 
	array(	"LDAP"	=> "inetOrgPerson" ,
			"ActiveDirectory" => "person"); // only for HaloACL
$wgLDAPUserNameAttribute = 
	array(	"LDAP"	=> "cn" ,
			"ActiveDirectory" => "samaccountname"); // only for HaloACL
```

### Synchronizing users from the LDAP server ###
The UI shows the LDAP groups and their users. However, this is only possible if 
the users are really known to the wiki system. If a new LDAP server is connected 
to the wiki, unknown users will be displayed as 127.0.0.1  as unknown users 
default to localhost. The class HACLStorageLDAP  provides the utility method 
createUsersFromLDAP which creates a user account for each LDAP user in the wiki. 
The wiki administrator can invoke this function with the commandline script 
HACL_Setup.php in /extensions/HaloACL/maintenance/:

	php HACL_Setup.php --createUsers --ldapDomain="Name of LDAP domain"

The Name of the LDAP domain is one of the domains that is specified in the LDAP 
configuration in LocalSettings.php. 


## Configuring features for global permissions ##

With this new feature which has been released with HaloAccess Control List extension 1.3, administrators now have the possibility of managing access to system features directly within the page Special:HaloACL instead of having to edit the LocalSettings.php every time manually. This article describes how to configure the list of features that are displayed in "Global permissions" tab of the Special:HaloACL page.


## Getting started with Security and User Rights ##

SMW+ comes with some preconfigured rights and this article explains the default settings and how to get started with the Access Control List


## Copyright and License ##
Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
