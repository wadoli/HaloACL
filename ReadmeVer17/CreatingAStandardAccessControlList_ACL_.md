# Creating a standard Access Control List (ACL)

Learn here how to create standard access control lists, ACL templates and default user templates. 

HaloACL is an extension that introduces a powerful access control in the wiki. Users can protect single articles, articles of certain categories or namespaces and values of semantic properties against unauthorized access. All this can be defined by normal users. Access can be granted to single users or groups of users, which can be defined for one own needs. All settings can be made with a convenient user interface.

## Requirements

To create an ACL you need to be logged-in.

An ACL for a security descriptor or a predefined right can be created in the Create ACL-tab.

## How to create an Access Control List

Go to the special page Special:HaloACL using the Administration-menu or using the list of all special pages.

There you are able to:

* Create a standard Access Control List
* Create ACL template
* Create ACL default user template 

Create ACL is chosen by default.

## How to create a standard Access Control List

You can protect single wiki pages, properties, namespaces (e.g. for pages in the 'template' namespace), and categories (e.g. for articles in the category 'private')

* Click Create standard ACL
* Select the type you wish to protect (Page, Property, Pages in Namespace or in Category)
* Enter the name or use the autocompletion feature to specify the item you wish to protect

**Note:** When you access Special:HaloACL via "» Advanced access rights definition" in the HaloACL toolbar while editing an article, the name of the last visited page will be automatically filled in the textbox.

Image: [CSA.png](CSA.png)

* Click Next Step
* Jump to chapter How to create right to read how to modify the rights 

## How to create an Access Control List Template

Save the defined rights as a template, this saves time and raises ACLs to a level of standardization, since the templates can be reused. Once you create a template, you can assign this template to any type of element you wish to protect e.g. page, property, etc. You may additionally use the ACL templates in your quick access list on every page. You just need to select the templates you want to have in the quick access list from the manage quick access ACL tab.

1. Click Create ACL template
2. Enter a concisely name for the new ACL template
3. Click Next Step
4. Jump to chapter How to create right to read how to modify the rights

Image: [CreateACLTEMPLATE.png](CreateACLTEMPLATE.png)

## How to create an ACL default user template

All newly created pages will have rights that are stored in the default template.

**Note:** You can create an ACL default user template only for pages.

1. Click Create ACL default user template.
2. Press simply Next Step

Image: [CreateACLDefaultTEMPLATE.png](CreateACLDefaultTEMPLATE.png)

ACL default user template can only be created once, if you want to change rights, you have 2 possibilities:

* You must delete the old ACL default user template and create a new one with you desired rights.
* You can simply [manage the old ACL default user template](ChangingAnAccessControlList_ACL_.md).

## How to create right

In the 2nd section Rights, you have 2 possibilities:

* Click Create right if you want to create a new right.
* Click Add right template if you wish to select a predefined ACL

**Note:** You may create multiple rights e.g.: Right1 = Read only for User1 + Right 2 = Full access for User2

1. Click Create right
2. Enter a concisely name for the right
3. Choose actions that should be allowed
4. Write a clear description (you can toggle the auto description on/off)
5. Choose groups and users who gain this right.

Image: [Rights.png](Rights.png)

Within an inline right definition there are two lists of groups and users. The list left-hand side contains all groups and users that the wiki knows and that can be accessed by the current user (WikiSysop). Choose the assignees of the inline right from this list.
The second list contains all groups and users that are already assigned. Assignees can be removed from the right with the help of this list. 

Image: [Assigned_List.png](Assigned_List.png)

## Add right template

You can use one (or more) templates from the list of predefined templates.

**Note:** You first have to create at least one template

1. Click Add right template
2. Select your desired existing ACL templates by clicking the check boxes
3. Click Use selected template 

Image: [Use_ACL_Temp.png](Use_ACL_Temp.png)

## How to add modification rights

After you have saved your inline right, you would like to make sure which user or user group have rights to modify this ACL.

* Click the plus Image:Plus_button.png to expand the Modification Rights box.
* Select the user / user group which have the right to modify this ACL.
* Click save right.

Image: [ACL_Modification.png](ACL_Modification.png)

* Finally, save the whole ACL.

## How to see if your page is protected

In order to know if your page is protected and which kind of protection it has, click Local Edit. The ACL panel appears at the top of the page:

[Protect.png](Protect.png)

* Click on the info-button to get more informations about the page protection.
* To manage your ACL, click Advanced access rights definition and you will be automatically linked to the  special pageSpecial:HaloACL 

**Note:** Another way to see which rights your page has, is to add /ACL:Page/ to your page link as follow: http://yourwikiurl/ACL:Page/nameofyourpage

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
