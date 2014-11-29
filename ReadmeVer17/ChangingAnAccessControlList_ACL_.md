# Changing an Access Control List (ACL)

This article describes how to manage the existing ACLs, your own default user template and the quick access ACLs.

## How to manage an Access Control List

Go to the special page **Special:HaloACL** using the Administration-menu or using the list of all special pages.

* Click **Manage ACLs** tab.
* You are able to:

    * Manage existing ACLs
    * Manage quick access ACLs
    * Manage your own Default ACL User Template 

* **Manage existing ACLs** is chosen by default.

## How to manage an existing ACL

In this tab, you will find a list of all existing ACLs.

**Note:** If the list of existing ACLs is empty, you should create it first.

First you need to find ACL that you want to manage. In order to achieve a fast and efficient search:

* Select the Type of your ACL (Page, Property, Template .....) in the Show ACLs table.
* Write the name of your desired ACL in the Filter input box.

Image: [M_E_ACL_1.png](M_E_ACL_1.png)

* Click on the Info button to have informations about your ACL (Right and Modification Rights).

Image: [ACL_INF.png](ACL_INF.png)

* Click edit button to change your ACL. Here you can create or delete Right and Modification Right in the same way as described in the [create ACLs](CreatingAStandardAccessControlList_ACL_.md) article. 

* If you want to delete your ACL, just click the check boxes and click Delete selected button.
## How to manage a quick access list

When you have protected your page by creating ACL, you will see the HaloACL toolbar on top of your page in the edit or creation mode. This contains a dropdown list called quick access list which only contains one value by default (the standard ACL template).

In this example, the name of our protected page is A complex project.

Image: [OhneQL.png](OhneQL.png)

If you want to added further choices to this list visit the Manage quick access ACLs tab of Special:HaloACL that holds a list of all ACL templates that you can use in your quick access list.

* Select your desired templates.
* Click Save Quickacl button.

Image: [Q_list.png](Q_list.png)

After saving the quick access list all selected quick ACLs will appear in the dropdown box of the HaloACL toolbar and you can easily choose which protection your page will have.

Image [WithQL.png](WithQL.png)

You can click the Info button if you want to get informations about Rights and Modification Rights of your protection.

**Note:** If you want to delete the quick access list, just deselect all the selected templates at Special:HaloACL and click save Quickacl button

## How to Manage your own Default ACL User Template 

Your own Default ACL User Template must already be created [see here](CreatingAStandardAccessControlList_ACL_.md), then you can manage it.

Image: [M_O_D_Template.png](M_O_D_Template.png)

Here you will be able to modify an existing right, to create a new right, to add template, or to modify the Modification Rights. [Read this](CreatingAStandardAccessControlList_ACL_.md) on how to create or modify the rights. 

## How to manage whitelists

All articles that have no security descriptor in form of an article with an ACL can be accessed by everyone. However, you as an administrator want to initially protect all pages that have no individual rights. For instance, there are several special pages that should be hidden for anonymous users. On the other hand, the wiki's main page should be readable for every one. This is the time, where a whitelist is needed.

If this article exists and is empty, all pages with no individual rights are protected. Specify here all articles, that can be accessed by everyone e.g. Main page, Special:UserLogin, Special:Userlogout and Special:Confirmemail. The only right for these pages is read. If no right can be applied to a protected wiki object, the whitelist is consulted last and possibly reading is allowed. However, all other right definitions have higher priority than the whitelist.

## How to create a whitelist 
* On the bottom of the page, you will see this input box.

Image: [AddWhitepage.png](AddWhitepage.png)

* Enter the name, you can use the autocompletion feature.
* Click Add Page Button.

## How to delete an existing whitelisted page

You can also delete pages from the whitelist at the same location where you created it.

* Go to the special page Special:HaloACL.
* Click Whitelist tab. All whitelisted pages would appear.

Image: [DeleteWhitepage.png](DeleteWhitepage.png)

* Simply click the check boxes to choose whitelisted pages wich you want to delete from the list.
* Click Delete selected button. 

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
