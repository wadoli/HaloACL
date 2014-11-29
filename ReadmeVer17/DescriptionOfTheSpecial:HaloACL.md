# Description of the Special:HaloACL

The core of the Halo Access Control List extension is the special page 'Special:HaloACL' where new security descriptors can be created or existing ones can be edited. Of course only user with the right to modify security descriptors can open this page. This article describes what you can do on this special page for ACL management. 

## The 'Special:HaloACL' interface for ACL management

There are five tabs in the HaloACL interface:

* Global Permissions* (new) – Set global permissions with HaloACL; features of Mediawiki can be enabled or disabled for groups of users defined with the HaloACL
* Create ACL – Protect pages and other elements with Access Control Lists
* Manage ACLs – Manage all defined Access Control Lists and templates in your Wiki
* Manage groups – Manage all defined Access Control List groups and assign rights to a specific group of users whenever you create an ACL.
* Whitelist – Specify articles, that can be accessed (read) by everyone. If this article exists and is empty, all pages with no individual rights are protected. 

### Global Permissions

This feature combines HaloACL groups with MediaWiki's global permissions. This is very useful if you don't want to go to the LocalSetting.php every time to grant access to specific groups and system features. Thereby the Halo Access Control List offers an interface for managing permission as an all-in-one solution.

Read [Managing global permissions with the HaloACL](ManagingGlobalPermissionsWithTheHaloACL.md) for step-by-step instructions.

Image: [Manage MediaWiki's global permissions](SpecialHaloACL_GlobPer.png)

### Create ACL


In this section you can:

* Create standard ACL
* Create ACL template
* Create ACL default user template 

#### Create standard ACL

An Access Control List (ACL) is a page which is mapped to the element that you wish to protect. Let's say that you want to protect the page "MyNotes". A new page called "ACL:Page/MyNotes" containing this articles access control list will be created. The ACL article always consists of:

* the type you wish to protect e.g. page, property etc
* the right settings e.g. read access for userX
* the definitions about the persons who have the ACLs modification rights 

Read [How to create a standard Access Control List](CreatingAStandardAccessControlList_ACL_.md) for step-by-step instructions.

Image: [Create a standard Access Control List](SpecialHaloACL_CreateACL.png)

#### Create ACL template

An Access Control List template is a predefined ACL. Once you create a template, you can assign this template to any type of element you wish to protect e.g. page, property, etc. You can additionally use the ACL templates in your quick access list on every page. Just select the templates you wish to have in the quick access list from the manage quick access ACL tab.

Read [How to create an Access Control List Template](CreatingAStandardAccessControlList_ACL_.md) for step-by-step instructions.

Image: [Create an Access Control List template](SpecialHaloACL_CreateACLTemp.png)

#### Create ACL default user template

A default ACL user template is an Access Control List which will be used as your default ACL, whenever you create new pages within the wiki. Change the access right state from your default ACL template to unprotected at anytime.

Read [How to create an ACL default user template](CreatingAStandardAccessControlList_ACL_.md) for step-by-step instructions.

Image: [Create ACL default user template](SpecialHaloACL_CreateACLdefUserTemp.png)

#### Manage ACLs

In this section you can:

* Manage existing ACLs
* Manage quick access ACLs
* Manage own default user template 

#### Manage existing ACLs

This section provides a list of all defined ACLs in your wiki. Activate/deactivate the checkboxes in the section 'Show ACLs' to filter the existing ACLs.

Read [How to manage an existing ACL](ChangingAnAccessControlList_ACL_.md) for step-by-step instructions.

Image: [Manage existing ACLs](SpecialHaloACL_ManageACLExistACL.png)

#### Manage quick access ACLs

This section has a list of all ACL templates that you can use in your quick access list. This list defines the ACLs that will be displayed in the dropdown box that is at the top of every page in the edit or creation mode. You may select up to 15 ACL templates. 

Image [OhneQL.png](OhneQL.png)

Read [How to manage a quick access list](ChangingAnAccessControlList_ACL_.md) for step-by-step instructions.

Image: [Manage quick access ACLs](SpecialHaloACL_ManageACLQuickACL.png)

#### Manage own default user template

Wiki administrators can define a master template for new users. Each time a new user logs in for the first time, the master template is set as his default template. Experienced users can modify their default template. This section provides a list of your default ACL user templates.

Read [How to Manage your own Default ACL User Template](ChangingAnAccessControlList_ACL_.md) for step-by-step instructions.

Image: [Manage own default user template](SpecialHaloACL_ManageACLownusertemp.png)

#### Manage Groups

This section provides the creation, editing and deletion of ACL groups. An ACL group is a collection of users. This group may also include other user groups. You can use these groups to easily assign rights to a specific set of users whenever you create an ACL.

Read the section [Managing groups](ManagingGroups.md) for step-by-step instructions.

[Manage Groups](SpecialHaloACL_ManageGroups.png)

#### Whitelist

Specify articles, that can be accessed (read) by everyone. If this article exists and is empty, all pages with no individual rights are protected. You can create and delete Whitelist entries in this section.

Read [How to manage whitelists](ChangingAnAccessControlList_ACL_.md) for step-by-step instructions.

Image: [Whitelist](SpecialHaloACL_Whitelist.png)

### Related topics
[Managing global permissions with the HaloACL](ManagingGlobalPermissionsWithTheHaloACL.md)
[Creating a standard ACL](CreatingAStandardAccessControlList_ACL_.md)
[Changing an Access Control List (ACL)](ChangingAnAccessControlList_ACL_.md)
[Managing groups ](ManagingGroups.md)

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
