# Getting started with Security and User Rights

SMW+ comes with some preconfigured rights and this article explains the default settings and how to get started with the Access Control List 

## Introduction

After the installation of SMW+ there are some predefined user groups and rights. All rights with exception of the reading rights are denied, per default. 

## Prerequisites

Log in as "WikiSysop"

## Explantion of the default user groups and rights

When you go to the special page **Special:HaloACL** directly or over the menu **Administration > Access rights administration**, you can see under the tab **Manage groups** some predefined user groups: 
* Knowledge architect
* Knowledge consumer
* Knowledge provider
* bureaucrat
* sysop 

The user "WikiSysop" (namely you as an administrator) belongs to all this groups.

[Predefined user groups in SMW+](SpecialHaloACL_DefaultGroups.png)

Under the tab **Global Permissions** you can view and manage the system rights of all these user groups. The following table lists all default permissions:

| Permission | Explanation | Comprises system features | Default setting |
|------------|-------------|---------------------------|-----------------|
|Read | This is the feature for reading articles. |	read | permitted for all users 
|Upload | This is the feature for uploading files into the wiki. | upload, reupload, reupload-own, reupload-shared, upload_by_url |	denied for all users except of Knowledge architects, Knowledge provider, bureaucrat and sysop |
| Edit | This is the feature for editing articles. | edit, formedit, annotate, wysiwyg, createpage, delete, rollback, createtalk, move, movefile, move-subpages, move-rootuserpages, createaccount, editprotected | denied for all users except of Knowledge architects, Knowledge provider, bureaucrat and sysop |
| Management | This is the feature for managing wiki articles. | import, importupload, ontologyediting, bigdelete, deletedhistory, undelete, browsearchive, mergehistory, protect, block, blockemail, hideuser, userrights, userrights-interwiki, markbotedits, patrol, editinterface, editusercssjs, suppressrevision, deleterevision, gardening |	denied for all users except of Knowledge architects, bureaucrat and sysop |
| Administration | This is the feature for administrating the wiki. | siteadmin, trackback, unwatchedpages |	denied for all users except of bureaucrat and sysop |
| Technical | This is the feature for technical issues. | bot, purge, minoredit, nominornewtalk, noratelimit, ipblock-exempt, proxyunbannable, autopatrol, apihighlimits, writeapi, suppressredirect, autoconfirmed, emailconfirmed |	denied for all users except of bureaucrat and sysop |

## Reloading these user rights into your wiki
To create these defaults, open the command line in Admin mode and execute the following command:
```
cd /folder_to_mediawiki/extension/HaloACL/maintenance
php HACL_Setup.php --initDefaults
```

## Related topics
If you wish to change these default settings the following articles may help you:

* [Configuring features for global permissions](ConfiguringFeaturesForGlobalPermissions.md)
* [Managing global permissions with the HaloACL](ManagingGlobalPermissionsWithTheHaloACL.md)
* [Managing groups](ManagingGroups.md)

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
