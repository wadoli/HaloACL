# Managing global permissions with the HaloACL

The management of global permissions with the HaloACL is a new feature which was released with HaloAccess Control List extension 1.3. It lets users set global permissions using the Special:HaloACL page. In doing this, Mediawiki system features can be enabled or disabled for particular user groups and defined with the HaloACL.

## Introduction

With the new feature released with HaloAccess Control List extension 1.3, administrators now have the possibility of managing access to system features directly within the page Special:HaloACL instead of editing the LocalSettings.php every time manually. This article describes how to add global permissions to existing Access Control List groups.

It's recommended to to become familiar with the related technical background information [on global permissions](ConfiguringFeaturesForGlobalPermissions.md).

## Prerequisites

* You need to be logged in as a WikiSysop
* Ensure that the [ACL groups are defined](CreatingNewACLGroups.md)
* Ensure that the [global permissions features are defined](ConfiguringFeaturesForGlobalPermissions.md)

## How to add global permissions for existing ACL groups

* Go to the special page Special:HaloACL
* Click Global Permissions to manage permissions for the system features. The predefined features are listed in the box Permission:

Image: [All defined features can be permitted in the tab Global Permissions](GlobalPermissions02.png)

* Select a system feature that you want to define its permissions from the list, e.g. Read - the description of the selected feature will be displayed to the right on the permission selectors pane. The HaloACL group's tree shall also open on the lower pane. 

Image: [Its first two entries are the special Mediawiki groups * All users * (anonymous and registered) and * Registered users *](SpecialHaloACL_GlobPer2.png)

* Activate the checkbox that is next to the group that you want to grant access or click the checkbox twice to deny permissions.

Image: [All users belonging to the group 'Gardening' have 'Read' permission, with the exception of the users belonging to the group 'Ontology editing'](SpecialHaloACL_GlobPer3.png)

* Click Save global permissions at the bottom to save the changes. A pop up window opens indicating that the right has been saved successfully.
* Click Ok

Now whenever the members of the group 'Ontology editing' try to access a page, the Wiki will deny them access and inform them that they need to be members of the groups 'Administrators', Bureaucrats' or 'Gardening'.

**Note:** Members of the first two groups can always read pages as they could otherwise not fulfill their administrative tasks in the wiki. However, the set of their accessible pages can be restricted with HaloACL's content rights

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
