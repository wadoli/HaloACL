# Protecting semantic properties

This article comprises the features for the protection of semantic properties in the ACL extension. 

## Introduction

If an article contains protected properties their values must not be shown. So for each article that is about to be displayed, the system finds out, if it contains forbidden properties. The values of protected properties are not revealed to users who have no right for viewing them. While the article is rendered by the wiki, the values must be replaced by XXX. Furthermore, if a user is not authorized to access the value of a property, the corresponding property object does not return the value, no matter what extension asks for the value.

Protecting semantic content when queries are answered is only possible with a triple store. SMW uses the #ask: syntax for queries. The triple store is queried with #sparql: . As #ask does not support semantic protection it must be switched off, if this feature of HaloACL is enabled. SPARQL queries can only consider access rights if they are stored in the triple store. So all rights concerning properties will be transfered into the triple store.

## Features of semantic protection

Several new features are part of the HaloACL to gain a reliables access control on semantic data.

## Access rights for properties

The access control is defined in the form of access control lists (ACL) that appear in security descriptor pages. They define rules that are checked when access to the value of a property is requested. The rules are a sequence of entries that permit access. Only if a rule in the list matches the current conditions, the access to a property is granted. Otherwise it is always denied.

The ACL for a property is defined in a security descriptor i.e. an article with the same name but in the ACL:Property/ namespace. This provides a fast and easy way to set up and maintain the access rules. Of course, the security descriptor article has to be protected by page protections mechanisms. (See Definition of rights for properties below for further details.)

** Example ** The property salary should be protected. Only users in the group secretary should be able to see and modify its values. The ACL in ACL:Property/Salary is defined as follows:
```
No other rights than the ones defined in this article are granted to anyone else.

Only secretaries can read and edit the values of this property.
{{#property access:
 assigned to=secretary
|actions=read,edit
|description= Allow secretaries to read the salary.
}}
```

## Hiding values of protected properties

The values of protected properties are hidden in several places:

**Articles with protected properties** Unauthorized users may read articles that contain protected properties. However, their values are blackened or replaced by XXX. 

**Factbox and Special:Browse** Protected properties are hidden in the semantic factbox and on the page Special:Browse. 

**Queries** Queries extract the annotated properties from articles and present them as table etc. If a property is in some way forbidden for a user, this is considered in the query that is modified. So if a property has no access rights, the whole tuple that would normally be retrieved from the triple store is rejected i.e. in the table of results a complete row will be missing. 

**Ontology Browser** No possibility to retrieve the values of protected properties.

## Creating and editing protected properties

If users have the right to edit articles, nothing can detain them from adding new properties or changing values of existing properties. But if the article is saved, the protected properties would have to be ignored, i.e. not written to the semantic database.

However, if the user has the right to edit an article because it does not contain forbidden properties, he can still add a forbidden property. If he then tries to save the article, he will be redirected to the edit page again where he has to correct his article. If the Semantic Toolbar is present, if can prohibit that the users saves an invalid article. 

## Definition of rights for properties

Access rights for properties are defined in the security descriptor article that belongs to the property e.g. ACL:Property/Salary. A list of access rules is specified with a new parser function: {{#propertyaccess:...}}. This function can have up to 3 parameters:

**assigned to** This specifies the users and groups that get the new right as a comma separated list. 
**actions** This specifies the actions that are permitted by the rule. Valid values are read, edit, formedit and * (which equals read, edit, formedit). 
**description** This (optional) description in prose explains the meaning of this rule. 

**Example**
```
{{#propertyaccess:
 assigned to=User:CEO
|actions=read
|description=The user "CEO" can read the values of the property.
}}


{{#propertyaccess:
 assigned to=Chief secretary,User:CFO
|actions=*
|description=Users in the group "Chief secretary" and the "CFO" can do everything with the values of the property.
}}
```

{{#propertyaccess:...}} is a so-called parser function. It is evaluated every time the security descriptor article is saved and displayed. Its properties are stored in a database table. 

## Presentation of protected properties

* "Forbidden" properties are hidden from unauthorized users in view mode. The value of the property will be replaced by XXX or a black bar. SMW's property classes must be patched to return the replacement instead of the actual value.
* If an article contains forbidden properties, it can not be edited by unauthorized users. When a user tries to access such an article, HaloACL has to retrieve all of its properties, evaluate the rights and decide, if the user may edit it. 

Image: [Figure 1: The date of the event is hidden. Furthermore, it does not appear in the fact box.](HiddenProtectedProperty.png)

## Presentation of query results

The same result filter as described above is applied to the result of a Sparql query. 

## Editing of protected properties

** Editing completely forbidden properties ** If a user wants to edit an article that already contains "forbidden" properties, he can not enter the regular edit mode. In this case the tabs above the article will only show "view source". If this tab is clicked, the user is redirected to a "Permission error". 
** Editing with Semantic Forms ** If a user has the right to edit the properties with Semantic Forms, he can only do this (of course a semantic form must be defined). The values of properties without read access are not visible in the form. 
** Editing properties with full access** If an article contains only properties with the right "edit", the complete wiki text can be edited. 
** Saving articles with forbidden properties ** If a user tries to save a wiki text that contains a property without "edit" right, the operation must be aborted. Such an article can not be stored. It is reopened in edit mode to enable the user to correct the wiki text. An error message lists all forbidden properties.  

Image: [Figure 2: A user can not save an article with protected properties.](SaveProtectedProperty.png)

## History of articles with protected properties

If an article contains protected properties, unauthorized users must not see the corresponding wiki text. This will be prohibited as described in the previous section. However, if the protected properties are removed, the article's wiki text is no longer protected by their occurence. Now it is possible, to read the wiki text of the previous revisions in the article's history. MediaWiki shows the differences of the wiki texts of different revisions. HaloACL will analyze the wiki texts of the revisions that are compared and disable the Difference View if one of them contains protected properties.

## The semantic toolbar and advanced annotation mode

Properties can be annotated with the semantic toolbar (STB) in edit mode or advanced annotation mode. If a property is forbidden for a user, the STB does not allow to add the property if it is added manually in an input field of the STB. In this case the input field is highlighted with a red background.

The STB lists all properties of an article. If the users enters a forbidden property in the wiki text, the STB highlights this property and marks it as forbidden. As long as the wiki text contains such a property, the user can't save this article.

Image: [Figure 3: A user can not enter a protected property with the Semantic Toolbar.](ProtectedPropInSTB01.png)
Image: [Figure 4: If the user enters a property in the wiki text...](ProtectedPropInSTB02.png)
Image: [Figure 5: ...the Semantic Toolbar shows a warning...](ProtectedPropInSTB03.png)
Image: [Figure 6: ...and the button "Save page" is disabled. A warning explains why.](ProtectedPropInSTB04.png)
Image: [Figure 7: Protected properties can not be added in the Advanced Annotation Mode.](ProtectedPropInSTB05.png)

## Enhancements to the userCan hook

Whenever MediaWiki has to find out something about access rights it invokes the userCan hook (see [1]). HaloACL attaches a callback function to this hook where it decides if an action is permitted or denied. The function is called with a title object, a user and an action. So it can decide if the user can perform the action (e.g. edit, read) on the title (a wiki article).

In order to evaluate access rights on property values, we have to introduce new actions. If MediaWiki or one of its extensions needs to know the right for a property it invokes the userCan hook with the property as title object, the user and one of the following new actions (as string):

**propertyread** Checks if the property can be read. 
**propertyformedit** Checks if the property can be edited with semantic forms. 
**propertyedit** Checks if the property can be edited. 

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
