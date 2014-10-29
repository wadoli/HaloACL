# Configuring features for global permissions
With this new feature which has been released with HaloAccess Control List extension 1.3, administrators now have the possibility of managing access to system features directly within the page Special:HaloACL instead of having to edit the LocalSettings.php every time manually. This article describes how to configure the list of features that are displayed in "Global permissions" tab of the Special:HaloACL page.

## Introduction

Mediawiki has its own group management. Administrators have permission to define the actions that the members of any particular group may perform. There are over 50 different rights related to actions in the wiki, ref.:[User rights](http://www.mediawiki.org/wiki/Manual:User_rights).

Clearly, one notes that it would be a tedious task if one was to define the same groups in HaloACL and in Mediawiki and keep these groups synchronized manually. With this new feature, one may reuse HaloACL-groups in Mediawiki. 

[SpecialHaloACL_GlobPer.png](SpecialHaloACL_GlobPer.png)

## Sample Scenario

We presume that the group Wikiadministrators is defined and maintained in HaloACL. Adding the code below in Mediawiki's localsettings.php file grants this group the rights to import articles. Further on, the members of this group will thereafter always be retrieved from HaloACL and not from Mediawiki without any further user interaction.
```
    $wgGroupPermissions['Wikiadministrators']['import'] = true; 
```
With this feature in place, one realizes that it makes perfect sense to combine Mediawiki's global permissions with HaloACL groups. Before any rights are evaluated in HaloACL or other access control extensions the Mediawiki group rights are first evaluated. The Mediawiki features can therefore be enabled or disabled, e.g. uploading, for HaloACL groups. The rights for accessing articles that are enabled, e.g. read, edit, etc, can then be further restricted by HaloACL based on the type of content, i.e. pages, instances of categories or namespaces etc. 

** Note: ** Please be aware that Mediwiki evaluates its global permissions always first. If it denies access to a feature, no other access control extension can bring that right back. So, if for example reading is prohibited with the global permissions, HaloACL will not be able to allow reading certain pages like the Main Page or even the login page. In that case you have to set $wgWhitelistRead e.g.
```
$wgWhitelistRead[] = "Special:UserLogin";
$wgWhitelistRead[] = "Special:UserLogout";
```
See Manual:[$wgWhitelistRead](http://www.mediawiki.org/wiki/Manual:$wgWhitelistRead) for more information.

## What are Global Permissions?

The groups defined on Special:HaloACL are available for MediaWiki group permissions and this therefore replaces the group management of MediaWiki.

The user should take note of this:

* The MediaWiki groups "*" (all users) and "user" (registered users) are implicit pseudo groups that have no explicit user definition. They therefore do not appear in the "Manage group" tab of HaloACL as they cannot be managed - they can only be used. They are only available while defining content rights or "Global Permissions" with HaloACL.

* As HaloACL is meant to augment/extend MediaWiki's group management, it does not read and present the group definitions that are defined in MediaWiki's PHP code. The groups of HaloACL become available for MediaWiki's group permissions. They are added to the groups defined in MediaWiki. To avoid confusion, avoid defining any other groups in the PHP code other than the MediaWiki default groups.

* The MediaWiki default groups (e.g. "bureaucrat" and "sysop") are not visible in HaloACL's group management and the "Global permissions". Members of these groups should be managed with "Special:UserRights". However, if you wish to manage these groups with HaloACL, you can define them in the "Manage Groups" tab using the same name as in $wgGroupPermissions. You will not see the users that were added with "Special:UserRights" in HaloACL's group management. Such a group will contain all users added with "Special:UserRights" AND HaloACL's group management. 

## Preparations for the GUI Global Permissions

Before you can manage global permissions in the Special:HaloACL, the list of features listed have to be configured.

The section below explains the used terms and also explains how to configure the list of features that shall be managed with the HaloACL.

### Features vs. system features

Mediawiki has permissions for the set of system features that may be extended. For instance, an administrator can control the permissions for the read, edit and move features.

With the system variable [$wgGroupPermissions](http://www.mediawiki.org/wiki/Manual:$wgGroupPermissions) the administrator can make specifications about the user group that has permission to use a feature and the group that is denied permission.

In an attempt to further highlight the advantages of HaloACL, we indicate that there are about 50 system features in the Mediawiki core installation and the use of extensions may add others, ref.: [User rights](http://www.mediawiki.org/wiki/Manual:User_rights).

Permissions for these features are assigned to or withdrawn from Mediawiki's own groups of users. These groups are very simple (no group hierarchy) and membership is controlled with a poor user interface. Furthermore, new Mediawiki groups can only be defined in the wiki installation's source code.

HaloACL on the other hand offers a sophisticated and handy way of managing groups of users. The HaloACL GUI combines HaloACL's user groups with Mediawiki features permissions. This makes the original Mediawiki user groups obsolete, with the exception of the administrative groups bureaucrat and sysop.

** Note: ** We recommend that one sets up access rights for the administrative groups bureaucrat and sysop in the LocalSettings.php in the usual manner and go on to use the HaloACL to specify the access rights of the other user groups.

The Global Permissions tab of Special:HaloACL lets administrators and to some extent normal users make specifications about the Mediawiki features that are available for groups of users defined in HaloACL.

We note that the set of about 50 Mediawiki system features is unfortunately not clearly arranged. To create some order, we define the following terms:

* ** System feature ** Mediawiki offers about 50 system features. Permissions for every single feature are controlled in the system variable $wgGroupPermissions. With this, Mediawiki and HaloACL groups can be permitted or denied to use a feature. 

* ** Feature ** With HaloACL, system features can be combined to more comprehensive features. For example there are several system features for uploading files: upload, reupload, reupload-own, reupload-shared and upload_by_url. such a fine grained control is ussually not required and it is rather confusing. Administrators usually just wish to permit or deny uploading. Consequently, sets of system features can be combined to a single feature. 

### Properties of a feature

A feature
* is a combination of system features.
* can be permitted or denied, thus permitting or denying all system features it consists of.
* appears in the user interface of HaloACL.
* has a name by which it is represented in the UI.
* has a description which is displayed in the UI as explanation.
* can either be permitted/denied only by administrators or by all registered users.
* has a default value that permits or denies the feature for all anonymous and registered users.
* is completely defined in the PHP code. 

### Default permissions for features

Normally the system variable $wgGroupPermissions is filled with some default permissions. We define this as system settings. If no other rules are defined, the system settings alone states the system features that are enabled.

When the permissions for features are defined in the UI for a user group, a starting point for a reasonable set of permitted features is needed. Otherwise, specifying the permissions could be tedious. This is why every feature has a default value. It is applied to all anonymous and registered users i.e. $wgGroupPermissions will be set for the groups "*" and "user".

Once permission is granted to a group, it is impossible to withdraw it later on. We recommend that you deny access in the default settings and only enable them for certain groups.

Please also note that the default values for features overwrite the $wgGroupPermissions of all contained system features at run-time. Any $wgGroupPermissions of conflicting system features defined in LocalSettings.php or somewhere else will be lost.

By defining features, the administrator determines which system features can be permitted or denied for HaloACL's user groups in the GUI of HaloACL. A reasonable definition of features is shipped together with HaloACL. It is based on the categorization of user rights in User rights. We will now explain how administrators can create a feature.

### Configuring features

There are two possibilities of configuring features:

** 1 ** If you wish to use $wgGroupPermissions in the basic way, set the variable $haclgUseFeaturesForGroupPermissions = false; as defined in HACL_Initialize.php. If this is not done, a set of default permissions will be created and it will overwrite all $wgGroupPermissions for anonymous ('*') and registered ('user') users.

** 2 ** If you wish to define global permissions within the 'Special:HaloACL' page, set the variable $haclgUseFeaturesForGroupPermissions = true; as defined in HACL_Initialize.php. The features will appear in the HaloACL interface as global permissions defined in HACL_Initialize.php in the array $haclgFeature.

Now let us go on to define a feature named Upload for use in the HaloACL interface. It consists of the system features upload, reupload, reupload-own, reupload-shared and upload_by_url, has a name, a description, it is permissible by administrators (sysop or bureaucrat) and is denied for all users by default:

The definition of such a feature would look like this :
```
$haclgFeature['upload']['systemfeatures'] = "upload|reupload|reupload-own|reupload-shared|upload_by_url";
$haclgFeature['upload']['name'] = "Upload";
$haclgFeature['upload']['description'] = "This is the feature for uploading files into the wiki.";
$haclgFeature['upload']['permissibleBy'] = "admin"; // The other alternative would be "all"
$haclgFeature['upload']['default'] = "deny"; // The other alternative would be "permit"
```
Just in case you wish the access of one of the listed features,i.e 'upload' such that it is not defined with the Special:HaloACL interface, you can go ahead to delete its corresponding line(s) in the HACL_Initialize.php and define the access rights in the LocalSettings.php.

## Notes on implementation
Below is an overview of the classes that are involved in this new feature:
[UML-GroupPermissions.png](UML-GroupPermissions.png)

## Copyright and License
Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
