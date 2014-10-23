# Installing HaloACL 1.7

This article explains the process of installing and integrating the Access Control List extension 1.7 on top of MediaWiki and SMW+ 1.7

## Requirements 

1. MediaWiki 1.13.2, 1.15.1 - 1.15.3, 1.16.0 - 1.16.4 or 1.17.0 - 1.17.2

Compatibility information

* SMW 1.7.*
* Semantic Forms 1.9 - 2.1.2
* SMW+ 1.7.0 

## How to install manually

* Include the path to **php.bin** to the system variable PATH (either Windows or Linux), e.g. ```C:\xampp\php;```

* Extract the 'haloacl-1.7.0\_0\_including\_dependencies.zip' archive (for an installation on top of SMW+)

* Extract the 'haloacl-1.7.0_0.zip' archive (for an installation on top of MediaWiki)

* Copy the folders 'HaloACL', 'ScriptManager' and 'ARCLibrary' into the extensions folder of MediaWiki.

* Activate the HaloACL by adding the following lines to LocalSettings.php:
```
    require_once("extensions/ScriptManager/SM_Initialize.php");
    include_once('extensions/ARCLibrary/ARCLibrary.php');
    include_once('extensions/HaloACL/includes/HACL_Initialize.php');
    enableHaloACL(); 
```
+ **Note:** If you already have custom namespaces on your site, insert ```$haclgNamespaceIndex = ???;``` into your LocalSettings.php **before** the call of HACL_Initialize.php. The number ??? must be the smallest even namespace number that is not in use yet. However, it must not be smaller than 100.    

* Open a commandline interface

* Go to the directory of HaloACL, e.g. ```C:\xampp\htdocs\mediawiki\extensions\HaloACL```

* Choose the command depending on your MediaWiki installation to patch MediaWiki:
    - MediaWiki 1.13.2
        
        ```php patch.php -d <mediawiki-dir> -p patch_for_MW_1.13.2.txt```

    - MediaWiki 1.15.1 and 1.15.2 
    
        ```php patch.php -d <mediawiki-dir> -p patch_for_MW_1.15.1.txt```

    - MediaWiki 1.15.3

        ```php patch.php -d <mediawiki-dir> -p patch_for_MW_1.15.3.txt```

    - MediaWiki 1.16.0 and 1.16.1

        ```php patch.php -d <mediawiki-dir> -p patch_for_MW_1.16.0.txt```

    - MediaWiki 1.16.4

        ```php patch.php -d <mediawiki-dir> -p patch_for_MW_1.16.4.txt```

    - MediaWiki 1.17.0 and 1.17.2

        ```php patch.php -d <mediawiki-dir> -p patch_for_MW_1.17.0.txt```

* Choose the command depending on your Semantic MediaWiki installation to patch SMW (skip this step if you don't have SMW installed):
    - SMW 1.5.0

        ```php patch.php -d <mediawiki-dir> -p patch_for_SMW_1.5.0.txt```

    - SMW 1.5.1

        ```php patch.php -d <mediawiki-dir> -p patch_for_SMW_1.5.1.txt```

    - SMW 1.5.2

        ```php patch.php -d <mediawiki-dir> -p patch_for_SMW_1.5.2.txt```

    - SMW 1.5.6

        ```php patch.php -d <mediawiki-dir> -p patch_for_SMW_1.5.6.txt```

    - SMW 1.7.1

        ```php patch.php -d <mediawiki-dir> -p patch_for_SMW_1.7.1.txt```

* Execute the following command to patch Semantic Forms (skip this step if you don't have the Semantic Forms extension installed):
    - Semantic Forms 1.9

        ```php patch.php -d <mediawiki-dir> -p patch_for_SF_1.9.txt```

    - Semantic Forms 1.9.1

        ```php patch.php -d <mediawiki-dir> -p patch_for_SF_1.9.1.txt```

    - Semantic Forms 2.0

        ```php patch.php -d <mediawiki-dir> -p patch_for_SF_2.0.txt```

    - Semantic Forms 2.0.8

        ```php patch.php -d <mediawiki-dir> -p patch_for_SF_2.0.8.txt```

    - Semantic Forms 2.1.2

        ```php patch.php -d <mediawiki-dir> -p patch_for_SF_2.1.2.txt```

* Update the database:

    The HaloACL extension requires some additional tables in the database that must be added to the existing database schema. Existing data will not be modified. Therefore change into the maintenance folder of the HaloACL extension and run the setup script:

```
      cd /folder_to_mediawiki/extension/HaloACL/maintenance    
      php HACL_Setup.php
```

## Notes on patches

### Notes on patches for Mediawiki

This patch adds semantic protection of properties and their values and filters links to protected pages from several special pages. On other pages these links are replaced by a link to the page "Permission denied". This patch is optional.

```patch_for_MW_<version>.txt ```

### Notes on patches for Semantic Mediawiki

This patch adds semantic protection of properties and their values. This patch is recommended.

```patch_for_SMW_<version>.txt ```

### Notes on patches for SemanticForms

This patch checks if pages can be edited with Semantic Forms.

```patch_for_SF_<version>.txt ```

This patch for Semantic Forms is mandatory, if you want to protect the values of semantic properties in semantic forms and if you want to use the HaloACL toolbar in forms.
Information.png  

**Note:** The patch files were created in Eclipse. They can be installed using the tool patch.php from the deploy framework (smwhalo-deploy-1.0) which itself uses GNU patch. The patch.php is also included in this extension. Go into the root directory of the extension and run the following command: ```php patch.php -p <patch-file> -d <mediawiki-dir> --onlypatch```

## Creating default groups with default rights

After the database is updated you can, if you want, create some default groups with default permissions, like the ones that come with a SMW+ installation (see: reference to Getting started with Security and User Rights).
<br>

| Group                | Default permissions          |
|----------------------|------------------------------|
|Knowledge consumer     | read |
|Knowledge provider     | read, edit, upload |
|Knowledge architect    | read, edit, manage, upload |
|sysop 	                | read, edit, manage, upload, administrate, technical |
|bureaucrat 	        | read, edit, manage, upload, administrate, technical |

The user "WikiSysop" is the default member of these groups.

**To create these defaults you have to execute the following on the command line:**
```
cd /folder_to_mediawiki/extension/HaloACL/maintenance
php HACL_Setup.php --initDefaults
```
**Note:** This step is only necessary if you have installed the extension manually; executing the installation with the wiki Administration Tool, will add these groups and permissions automatically.

## Language support

Currently, the only supported languages are English, German and French.

### Changing language

1. Open the LocalSettings.php
2. Change the value of $wgLanguageCode to your desired language
    + For German enter 'de'
    + For English enter 'en'
    + For French enter 'fr'

**Note:** The label of the special pages change according to the selected language. In this case you'll find the special page to HaloACL under "Spezial:HaloACL" when using German, "Spécial:HaloACL" when using French. However, the page will be in english.

Because of those 'Translations' and some more static translations of this kind it is not recommended to switch the language after the Wiki has got content. It is recommended to define the language only right after the installation. The chosen language is static for the whole wiki and can not be changed afterwards. (unless you translate all the content of course).

Do not confuse this language of the content with the language of a user. User language for the UI may be changed for each user separately in preferences.

## Testing your Installation

1. Go to the special page Special:Version page and you should see HaloACL (Version nn) listed under Other.
2. Go to the special page Special:HaloACL to start defining access control lists:
[!alt ACL Specialpage](DemoACL1.3.png)
    
## Troubleshooting
### Error in forms

Unfortunately there was a bug in the SMW patch in HaloACL 1.1. The reason for this patch was that the SF namespace constants where defined twice, which lead to an error when the second define statements came up. Semantic Forms is independend from HaloACL thus any version of SF should run with HaloACL.

Open the file extensions/SemanticMediaWiki/includes/SMW_GlobalFunctions.php and remove the slashes before the lines:

```
//             define('SF_NS_FORM',            $smwgNamespaceIndex+6);
//             define('SF_NS_FORM_TALK',       $smwgNamespaceIndex+7);
```

### Call to undefined method

While creating a property the following error occurs after saving:

```
Fatal error: Call to undefined method SMWPropertyValue::userCan() in /var/www/webapps/halo/extensions/HaloACL/includes/HACL_Evaluator.php
```
This problem occurs if HaloACL protects properties and SMW is not patched. There are two solutions for your problem (with HaloACL enabled):

1. In HACL_Initialize.php, set ```$haclgProtectProperties=false;``` In this case, properties are not protected
2. Apply the patch in patch\_for\_SMW_1.4.2.txt to SMW. This is the recommended solution.
Information.png
  
**Note:**  If you are using SMW 1.4.3 you have to look for **patch_for_SMW_1.4.3.txt**, located at **..\extensions\HaloACL**

### Database query syntax error Special:Form

The patches are missing, follow the instructions in step 3 to install the patches.

### Special:HaloACL is empty

The content of Special:HaloACL is almost completely loaded by two ajax functions. Sometimes problems occur when jquery.js is loaded before protoype.js. With the Firebug extension of Firefox it is possible to track all ajax calls. When you open Special:HaloACL, there should be two ajax call:
```
http://localhost/develwiki/index.php/Special:HaloACL?action=ajax&rs=haclCreateACLPanels  
http://localhost/develwiki/index.php/Special:HaloACL?action=ajax&rs=haclCreateAclContent
```

**How to track the ajax calls:**

1. Open Firefox
2. Click the little bug icon in the status bar at the bottom to activate Firebug.
3. Go to Network in the Firebug menu, click the little triangle and activate the Network feature.
4. Open the special page Special:HaloACL in your wiki. Maybe you have to refresh the page once more (F5).
5. You should see all GET and POST requests sent by Firefox. For the HaloACL there are 78 requests.
6. You can switch to the Console of Firebug. It shows only the two ajax calls needed for Special:HaloACL
7. Furthermore the console shows JavaScript errors or warnings. 

**Note:** This bug is fixed for HaloACL version 1.1.1. If Special:HaloACL is empty, first go through the installation instructions, then check if all needed patches are installed.


## Configuration

All configuration options are defined and described in ..\HaloACL\includes\HACL_Initialize.php.

**$haclgUseFeaturesForGroupPermissions = true;**	Enable this variable if you want to use the HaloACL for defining global permissions. Otherwise a set of default permissions will be created that will overwrite all $wgGroupPermissions for anonymous ('*') and registered ('user') users. If this variable is set to true, you can further define features that will appear in the ACL as global permissions using the array $haclgFeature.

**$haclgFeature** Normally the system variable is filled with some default permissions (system settings). You can extend this feature list by defining them in this array. (See: Configuring features for global permissions)

**$haclgIP = $IP . '/extensions/HaloACL';** 	This is the path to your installation of HaloACL as seen on your local filesystem. Used against some PHP file path issues.

**$haclgHaloScriptPath = $wgScriptPath . '/extensions/HaloACL';** This is the path to your installation of HaloACL as seen from the web. Change it if required ($wgScriptPath is the path to the base directory of your wiki). No final slash.

**$haclgEnableTitleCheck = false;** Set this variable to false to disable the patch that checks all titles for accessibility. Unfortunately, the Title-object does not check if an article can be accessed. A patch adds this functionality and checks every title that is created. If a title can not be accessed, a replacement title called "Permission denied" is returned. This is the best and securest way of protecting an article, however, it slows down things a bit.

**$haclgOpenWikiAccess = true;** If this value is <true>, all articles that have no security descriptor are fully accessible. Remember that security descriptor are also inherited via categories or namespaces. If it is <false>, no access is granted at all. Only the latest author of an article can create a security descriptor.

**$haclgProtectProperties = true;** If this value is <true>, semantic properties can be protected. If it is <false>, semantic properties are not protected even if they have security descriptors.

**$haclgBaseStore = HACL_STORE_SQL;** By design several databases can be connected to HaloACL. (However, in the first version there is only an implementation for MySQL.) With this variable you can specify which store will actually be used. Possible values: - ```HACL_STORE_SQL```

**$haclgUnprotectableNamespaces = array('Main');** This array contains the names of all namespaces that can not be protected by HaloACL. This bears the risk that users can block all articles of a namespace if it has no security descriptor yet. On the other hand, if each namespace would have a security descriptor, then all authorized users for that namespace will be able to access all articles in that namespace, even if security descriptors for individual articles define another set authorized users. The name of the main namespace is 'Main'.

**$haclgNewUserTemplate = "ACL:Template/NewUserTemplate";** This is the name of the master template that is used as default rights template for new users. Every user can define his own default rights for new pages. He does this in a security descriptor with the naming convention ```"ACL:Template/<username>"```. The content of this article is assigned to security descriptors that are automatically generated for new pages. However, for new users there is no default template. With this setting you can specify a master template (a name of an article) that is used to create a default template for new users. The master template is a normal security descriptor that can contain the variable ```"{{{user}}}"``` that will be replaced by the user's name.

(See: Creating security descriptors automatically.)

**$haclgEvaluatorLog = false;** 	If ```$haclgEvaluatorLog``` is true, you can specify the URL-parameter "hacllog=true". In this case HaloACL echos the reason why actions are permitted or prohibited.

**$haclgEncryptionKey = "MY VERY SECRET KEY";** 	This key is used for protected properties in Semantic Forms. SF has to embed all values of input fields into the HTML of the form, even if fields are protected and not visible to the user (i.e. user has no right to read.) The values of all protected fields are encrypted with the given key. YOU SHOULD CHANGE THIS KEY AND KEEP IT SECRET.

**$haclgThrowExceptionForMissingFeatures = true;** 	The names of the features that are defined here are stored as reference in the database if they are actually used. If the definition of a feature is removed the corresponding rights can no longer be set. Normally this will lead to an exception that informs about the missing feature. If ```$haclgThrowExceptionForMissingFeatures``` is false, this exception will not be thrown and the rights for the missing feature will be silently ignored.

## Known issues
### Security exception during SMW refresh

The SMW's refresh script is executed as anonymous user. It tries to access all pages including those for which it does not have access rights. So HaloACL actually behaves correctly.

### Workaround
The quick solution is to disable HaloACL in LocalSettings while doing the refresh. 

## Copyright and License
Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
