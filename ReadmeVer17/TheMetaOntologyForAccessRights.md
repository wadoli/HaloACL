# The meta ontology for access rights

In this section the ontology that is used for the definitions of rights is described.

## A meta ontology for access rights

The rules for access control are defined as content of the wiki i.e. special articles (called security descriptors) define all access rights. These articles are located in the new namespace ACL. Of course, this namespace is also protected by our extension so that only authorized users can modify the access rights. In this section the ontology that is used for the definitions of rights is described. Figure 1 shows an overview. 

Image: [Figure 1:The ontology for rights management.](ACLRights.png)

### Category:ACL/ACL

HaloACL protects four kinds of wiki objects: instances of categories and namespaces, single pages and the values of semantic properties. They are protected by a security descriptor with an ACL that defines their access rights. Security descriptors are special articles in the category Category:ACL/ACL that are linked to the protected objects by their name. The naming convention is as follows:

* ** ACL:Category/categoryname ** The security descriptor ACL:Category/Favorite books protects the instances of the category Category:Favorite books. 
* ** ACL:Page/pagename ** pagename is the complete name of the page that will be protected by the ACL. Examples are ACL:Page/Main page, ACL:Page/User:Peter and ACL:Page/Category:Favorite books. The latter does not protect the instances of category Favorite books but the category page itself. 
* ** ACL:Namespace/namespacename ** For instance, ACL:Namespace/User protects the articles in the namespace User. 
* ** ACL:Property/propertyname ** For example, ACL:Property/Salary protects the values of the property Property:Salary. 

These articles define the ACL of the wiki objects that are linked by their name. An ACL can have a description that should explain the meaning of the ACL in prose.

The ACL as such is composed by a list of inline rights definitions or links to predefined rights.

### Inline right definition

An inline rights definition consists of users and/or groups, a set of predefined actions (read, edit, etc.) that are permitted and a description of the definition.

** Example **
The security descriptor ACL:Category/Favorite books contains the following ACL in form of an inline right definition: 

```
{{#access:
|assigned to = Reader, User:Peter, User:Paul
|actions=read,edit,create
|description= Allow r/e/c access for members of the group Readers, Peter and Paul to articles of the category "Favorite books".
}}
```

### Property right definition

A property right definition is an inline right definition for property values.

** Example ** The security descriptor ACL:Property/Salary contains the following ACL with a property right definition: 
```
{{#property access:
 assigned to=Chief Secretary
|actions=read
|description= Allow chief secretaries to read the salary.
}}
```

### Category:ACL/Right

Predefined rights are standalone articles of the category Category:ACL/Right that contain inline right definitions and/or links to other predefined rights. This makes is possible to reuse sets of rights in different contexts. For example, the rights of a whole group that are defined for one category can be reused for another category. Predefined rights should contain a description that is annotated with the property ACL/description to explain the purpose of the rights.

** Example ** The security descriptor ACL:Category/Favorite books contains the following ACL in form of predefined rights: 
```
[[ACL/description::Allow r/e/c access for members of the group Readers, Peter and Paul to articles of the category "Favorite books".]]
{{#predefined right:rights=ACL:Right/Common/Reader/PermitREC}}
{{#predefined right:rights=ACL:Right/User/Peter/PermitREC, ACL:Right/User/Paul/PermitREC}}
```
#### Naming conventions for predefined rights

In order to make it easier keeping an overview of all rights, we propose a naming convention for articles that define predefined rights. (Do not confuse this naming convention with the one for security descriptors. The latter naming scheme is mandatory.)

* **ACL:Right/Common/:** This prefix should be used for rights that affect the majority of users e.g. the right for all registered users to read articles.
* **ACL:Right/User/username/nameofright:** This prefix should be used for the rights that a user defines for himself. E.g. Peter should define his rights like this: ACL:Right/User/Peter/PermitRead. 

[read more about predefined rights](CreatingPredefinedRights.md)

### ACL:Whitelist

As describe above, all articles that have no security descriptor in form of an article with an ACL can be accessed by everyone. However, an administrator might want to initially protect all pages that have no individual rights. For instance, there are several special pages that should be hidden for anonymous users. On the other hand, the wiki's main page should be readable for every one. This is the time, where the article ACL:Whitelist is needed.

If this article exists and is empty, all pages with no individual rights are protected. Now the administrator (i.e. a member of the group sysop) can specify all articles, that can be accessed by everyone e.g. Main page, Special:UserLogin, Special:Userlogout and Special:Confirmemail. The only right for these pages is read. If no right can be applied to a protected wiki object, the whitelist is consulted last and possibly reading is allowed. However, all other right definitions have higher priority (as described above) than the whitelist.

** Example  for ACL:Whitelist **
```
{{#whitelist:pages=Main page, Special:UserLogin, Special:Userlogout, Special:Confirmemail}}
```

### The right to modify rights

One of the most important questions is: who has the right to modify rights? Rights can be modified in the security descriptor page (i.e. the article that is linked to the protected element by its name) and in a predefined right (i.e. an article of the Category:ACL/Right).

Sysops always have the rights to modify access rights. An additional new parser function {{#manage rights:...}} takes a list of all users and groups who are allowed to change the rights. This functions is added to the security descriptor e.g.:

```
The user Peter and the group of ProjectManagers can modify  this ACL.
{{#manage rights:assigned to=User:Peter, ProjectManagers}}
```

With these rights it is possible that an author writes an article and protects it as long as he is working on it. Later he can open it to reviewers but still hide it from the public. Finally he can release it and someone else can take full control over the article's rights. 

### Users

Users are not declared in the ACL framework as they already exist in the standard wiki software. A user account is created by the user himself when he wants to get a login. In the user definition of the ACLs anonymous users are addressed with the special value *. All registered users are addressed with the value #. Single users are denoted as User:<username> e.g. User:Peter.

### Groups

For HaloACL we extend MediaWiki's concept of groups.

###  MediaWiki groups

MediaWiki already has the concept of groups. System administrators can assign users to user groups that are defined in the system variable $wgGroupPermission (see [$wgGroupPermissions](http://www.mediawiki.org/wiki/Manual:$wgGroupPermissions)). About 50 kinds of actions can be enabled for members of these groups. These actions affect the whole wiki, like uploading files etc. It is not possible to protect the kinds of objects that our extensions will protect (pages, categories,...). The drawback of these MediaWiki groups is, that they are defined in the PHP code which can only be done by system administrators. Nevertheless, users belong to these groups and their basic rights are defined by them.

### ACL groups

However, for our extension we need a more flexible group concept. It must be possible for users to create, modify and delete groups. We call these groups ACL groups to distinguish them clearly from MediaWiki groups. Groups consist of users and other groups. (Cycles over groups must be prevented.) Thus it is for instance possible to populate the groups for departments with its employees and aggregate the whole company be these groups.

####  Naming convention for groups

Groups are defined in articles in the namespace ACL that belong to the category Category:ACL/Group. We propose the following naming conventions for these articles:

* ** ACL:Group/Common/groupname ** Common groups can be used by everyone and may reflect for example the structure of a company e.g. developers, project managers, secretaries etc. So, the group of developers would be defined in an article named ACL:Group/Common/Developer. In an ACE the group will be addressed without the namespace i.e. Group/Common/Developer. In a small wiki this might be overkill and developers would simply be defined in ACL:Developer but for large wikis this will keep the structure clean. 

* ** ACL:Group/User/username/private groups ** One goal is that users can define their own groups. This can lead to a very high number of groups that have to be structured to avoid confusion. Example: The group of Peter's friends is defined in ACL:Group/User/Peter/My friends and is addressed in a security descriptor as Group/User/Peter/My friends. 

####  Adding members to a group

The parser function {{#member:...}} is used to define the members of a group.

** Example ** The group ACL:Group/User/Peter/My friends consists of the user Paul and the group Group/User/Paul/My friends. 
```
Add a group and a user to this group.
{{#member:members=User:Paul,Group/User/Paul/My friends}}
```

#### Administrating groups
Of course, groups can not be viewed and edited by everyone. With the parser function {{#manage group:...}} the users and groups that can view and modify the group are defined. Sysops can always view and edit groups.

** Example ** The group ACL:Group/User/Peter/My friends can only be modified by Peter (and sysops). 
```
{{#manage group:assigned to=User:Peter}}
```

####  A complete example

In the following example, Peter defines the group of his friends (i.e. Paul and his friends). Only Peter can change this group. The group is defined in the article ACL:Group/User/Peter/My friends.

```
{{#member:members=User:Paul,Group/User/Paul/My friends}}

{{#manage group:assigned to=User:Peter}}

[[Category:ACL/Group]]
```

###  Initial rights for new pages

What happens when a user creates a new article? Does the user have to create the corresponding security descriptor or is it created automatically? And if so, what is its initial content?

A possible solution should satisfy three scenarios:

* The wiki is by default an open wiki i.e. all new articles are accessible by all users. Only if a page should be protected explicitly a security descriptor must be provided.
* New articles are automatically protected and belong to the author until he releases it. In this case a security descriptor must be created automatically with an ACL that permits only access for the author.
* New articles are automatically protected and belong to users and groups that cab be freely defined. In this case a security descriptor must be created automatically with an ACL that can be configured. 

The solution for this is simple. Every user can define a template (not a MediaWiki template) for his default ACL. There is a special article with the naming scheme ACL:Template/<username> e.g. ACL:Template/Peter. This template article can contain any kind of valid ACL as described above. It can define rights for the author alone or arbitrary combinations of users and groups.

If the user creates a new article, the system checks, if he has defined an ACL template. If not, no security descriptor is created. This solves the problem of the first scenario, the open wiki. Otherwise, if the template exists, a security descriptor is created and filled with the content of the template. This serves the latter two scenarios. 

** Access to default rights templates**

* Users can only access (read, edit and create) their own initial rights templates.
* sysops and bureaucrats can access the initial rights templates of other users. 

####  Internationalization

The terms that have been used in the ACL ontology above depend on the content language of the wiki. The namespace (ACL) and the properties (description, right, user, group, action, permission, category) are translated accordingly.

### Hierarchy of rights
The page based access rights are defined for the operations read, formedit, wysiwyg, edit, annotate, create, move and delete. These rights are structured in a hierarchy as depicted in Figure 2. If, for example, the top-level right read is denied, then all lower level rights are denied as well. If only read is explicitely granted, then all lower levels rights are still denied. If delete is explicitely allowed and all other rights are omitted, then all the higher levels edit, formedit, wysiwyg, annotate and read are allowed too, whereas create and move are not automatically granted.

The right create makes only sense for all pages or pages in a namespace. It does not apply to pages in a category, as a page must be created before it is assigned to a category.

Image: [Figure 2: The hierarchy of page based access rights.](HierarchyOfAccessRights.png)

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
