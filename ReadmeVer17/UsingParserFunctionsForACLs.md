# Using parser functions for ACLs

This section summarizes the new parser functions that are introduced by HaloACL. 


We have considered that parser functions are better suited for defining ACLs in wiki articles than semantic properties. The advantages of using parser functions for this task:

* Better software control while the function is parsed within HaloACL.
* The ACL definition can easily be stored in the dedicated ACL DB table. This allows fast evaluation of property rights at runtime.
* Only a hook for the parser function is needed. It is only called when the parser function appears in an article.
* The content of the parser function can be ignored, if it is not used within the scope of the namespace ACL.

## Overview of the parser functions in HaloACL

### {{#access:...

This parser function defines an access control entry (ACE) in form of an inline right definition. It can appear several times in an article.

#### Parameters:

* ** assigned to: ** This is a comma separated list of user groups and users whose access rights are defined. The special value * stands for all anonymous users. The special value user stands for all registered users.
* ** actions: ** This is the comma separated list of actions that are permitted. The allowed values are read, edit, formedit, create, move, annotate and delete. The special value * comprises all of these actions.
* ** description: ** This description in prose explains the meaning of this ACE. 


#### Example:
```
{{#access:
|assigned to=Group/Common/Reader,User:Peter,User:Paul
|actions=read,edit,create
|description= Allow r/e/c access for members of the group Readers, Peter and Paul to articles of the category "Favorite books".}}
```

### {{#property access:...

This parser function defines the access rights for values of semantic properties. It can appear several times in security descriptors (articles) of properties e. g. in ACL:Property/Salary. It is ignored in other articles.


#### Parameters:

* ** assigned to:** This is a comma separated list of user groups and users whose access rights are defined. The special value * stands for all anonymous users. The special value user stands for all registered users.
* ** actions: ** This is the comma separated list of actions that is permitted. The allowed values are read, edit and formedit. The special value * comprises all of these actions.
* ** description: ** This description in prose explains the meaning of this ACE. 

#### Example:
```
{{#property access:
|assigned to=Chief Secretary
|actions=read
|description= Allow chief secretaries to read the salary.
}}
```

###  {{#predefined right:...

Besides inline right definitions ACLs can refer to other sets of rights that are defined in another article. This parser function established the connection. It can appear several times in security descriptors and articles with predefined rights.

#### Parameters:

* ** rights: ** A comma separated list of article names with the prefix ACL:Right/ 

#### Example:
```
{{#predefined right:rights=ACL:Right/Group/Reader/PermitREC}}
```

### {{#whitelist:...

This parser function can only appear in the article ACL:Whitelist, however several times.

#### Parameters:

* ** pages: **  This is a comma separated list of full article names that can be read by everyone. 

#### Example:
```
{{#whitelist:pages=Main page, Special:UserLogin, Special:Userlogout, Special:Confirmemail}}
```

### {{#manage rights:...

This function can be used in security descriptors and predefined rights. It defines which user or group can change the ACL.

#### Parameters: 

* ** assigned to: ** This is a comma separated list of users and groups that can modify the security descriptor. 

#### Example:
```
{{#manage rights: assigned to=User:Peter, Group/Common/Project Managers}}
```
### {{#member:...

This function can appear (several times) in ACL group definitions. It defines a list of users and ACL groups that belong to the group. A warning is issued if a circle of groups is defined.

#### Parameters:

* ** members: ** This is a comma separated list of users and groups that belong to the group. 

#### Example: 
```
{{#member:members=User:Peter, Group/Common/Project Managers}}
```

### {{{#manage group:...

This function can be used in ACL group definitions. It defines which user or group can change the group.


#### Parameters:

* ** assigned to: **
    This is a comma separated list of users and groups that can modify the group. 

#### Example:
```
{{#manage group: assigned to=User:Peter}}
```

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
