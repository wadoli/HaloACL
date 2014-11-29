# Protecting wiki spaces

This article describes how to configure wiki spaces so all the articles in this space (sub-pages) are automatically protected like the main article of the wiki space (super page). 

## Introduction

When you create a new wiki space, you want all the articles in this space (sub-pages) to be automatically protected like the main article of the wiki space (super page). Read here how to configure wiki spaces so a sub-page inherits the protection of its super page.

## Prerequisites

By default subpages in the namespace "Main" are disabled in MediaWiki. Activate them in LocalSettings.php first:

* Open the LocalSettings.php
* Add the following line to enable subpages in namespace 'Main': 
```
$wgNamespacesWithSubpages[NS_MAIN] = true;
```

## How to protect a wiki space

To protect a wiki space namely a page and its subpages, proceed as follows:

* Log in with your account
* Create a new page, this is the main page of your wiki space, e.g. 'My Page'
* Go to the special page 'Special:HaloACL
* Protect 'My Page' and define full access for you and read access for anonymous and registered users:
    * Go to Create ACL > Create standard ACL
    * Select Page
    * Enter the name of the super page, in this example 'My Page'
    * Click Next
    * Optionally enter a name which describes the right
    * Activate the checkbox Full right
    * Select Define for: Me
    * Save right [ACL for protecting a Wiki space are created](ACLProtectSubpages2.png)
    * Click Next
    * Click Next step
    * Click Save ACL 
*  Optionally you can log out and verify that 'My Page' is protected:
    * Try to edit the page
    * Try to create a subpage 'My Page/Subpage' [The system denies the action of an anonymous user for a protected page](ACLProtectSubpages1.png)
* Log in again and create a subpage; this time it works as you have got the appropriate rights.  

**Result** You have created a wiki space and protected the main article; its subpages inherit the same protection 

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
