# Description of the Access Control List

This section describes the basics of the Halo Access Control List extension. Comparison of HaloACL to common access control extensions is made. The basic functionality of HaloACL is mentioned. Other articles on the description of the HaloACL interface, details on how protect semantic properties and the use of special parser functions for ACLs and the meta ontology for access rights are given.

## Introduction

Access Control is a very important feature, especially for business use. Organizations in most cases find it helpful to have the possibility of applying access restrictions in their Wikis so that they may add and work with this confidential data from the wiki - there is therefore understandably a need to limit access to such data to restricted groups of users while availing other data to users as per the rules.

The Access Control List extension is a tool that implements this. 

##  What's different from other extensions?

Access Control with HaloACL has been designed to be more flexible in comparison to the ones mentioned below:


### MediaWiki's access control

This Access Control is based on actions - an action is either allowed for a user or it is forbidden.

Drawbacks:

* It does not support fine grained control 

### Permission ACL - one of the best access control extensions

Advantages:

* Can control access to pages, instances of categories and namespaces 

Drawbacks:

* Only administrators can change access rights
* There is only one Access Control List which is not suitable for intense use i.e. thousands of individual rights
* Uses Mediawiki groups which can only be defined by administrators 

## Special Capabilities of Access Control with HaloACL



### Halo Access Control List extension (HaloACL)

Access Control with HaloACL is very flexible and has been designed resolve most of the drawbacks mentioned above:

* HaloACL can protect individual pages, instances of categories and namespaces and values of semantic properties.
* Users can define their own groups which can contain users and other groups.
* Every user can easily protect the article that he owns.
* HaloACL supports the actions: read, edit with form, wysiwyg, annotate, edit, create, move, delete
* Access rights can be defined and reused in other access rights (Templates).
* Every user can define a default rights template that is automatically applied to his newly created articles.
* Supports a whitelist
* A comprehensive interface simplifies management of access rights. 


## Basics of HaloACL
### Security descriptors

This section gives details about the functionality of page protection.

Access Control in HaloACL is defined in the form of Access Control Lists (ACL) that appear in security descriptor pages. Every protected element has a Security Descriptor. The security descriptor pages define rules that are checked when access to the value of a property is requested. The rules are a sequence of entries that permit access. The access to the protected content is granted only if a rule in the list matches the current conditions. Otherwise it is always denied.

A pages ACL is defined in a security descriptor i. e. an article with the same name but in the ACL: namespace. This provides a fast and easy way to set up and maintain the access rules. It is clear that the security descriptor article also has to be protected by page protection mechanism.

**Example**
```
{{#manage rights: assigned to=User:Thomas}}

{{#access:
 assigned to =User:Thomas,
|actions=*
|description=Allows * for Thomas
}}
```
### Groups

Groups are defined in articles. They can contain users and other groups.

### Mediawiki groups in comparison with HaloACL groups

With Halo's Access Control List, it is possible to combine Mediawiki's global permissions with HaloACL groups. In doing this, Mediawiki features i.e. uploading, can generally be enabled or disabled for HaloACL groups. The enabled rights for accessing articles (i.e. read, edit, etc) can then be further restricted by HaloACL based on the type of content (pages, instances of categories or namespaces etc.)

#### Sample Scenerio

* The group Wikiadministrators is defined and maintained in HaloACL.
* In Mediawiki,it is managed in the LocalSettings.php.

* **to give this group the rights to import articles, one would add this: **
```
        $wgGroupPermissions['Wikiadministrators']['import'] = true;
```
#### Results:

* The members of this group will always be retrieved from HaloACL and not from Mediawiki.
* This group can be managed with ease from HaloACL

[Description of the Special:HaloACL](DescriptionOfTheSpecial:HaloACL.md)

The core of the Halo Access Control List extension is the special page 'Special:HaloACL' where new security descriptors can be created or existing ones can be edited. Of course only user with the right to modify security descriptors can open this page. This article describes what you can do on this special page for ACL management. 

[Protecting semantic properties](ProtectingSemanticProperties.md)

This article comprises the features for the protection of semantic properties in the ACL extension. 

[Using parser functions for ACLs](UsingParserFunctionsForACLs.md)

This section summarizes the new parser functions that are introduced by HaloACL.

[The meta ontology for access rights](TheMetaOntologyForAccessRights.md)

In this section the ontology that is used for the definitions of rights is described.

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
