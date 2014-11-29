#  	Creating predefined rights

Predefined rights are standalone articles of the category Category:ACL/Right that contain inline right definitions and/or links to other predefined rights. 

Predefined rights are standalone articles of the category Category:ACL/Right that contain inline right definitions and/or links to other predefined rights. This makes it possible to reuse sets of rights in different contexts. For example, the rights of a whole group that are defined for one category can be reused for another category. Predefined rights contain a description that is annotated with the property ACL/description to explain the purpose of the rights.   

## Example
The security descriptor ACL:Category/Favorite books contains the following ACL in form of predefined rights:
```
[[ACL/description::Allow r/e/c access for members of the group Readers, Peter and Paul to articles of the category "Favorite books".]]
{{#predefined right:rights=ACL:Right/Common/Reader/PermitREC}}
{{#predefined right:rights=ACL:Right/User/Peter/PermitREC, ACL:Right/User/Paul/PermitREC}}
```
## Naming conventions for predefined rights
In order to make it easier to keep an overview of all rights, we propose a naming convention for articles that define predefined rights. (Do not confuse this naming convention with the one for security descriptors. The latter naming scheme is mandatory.)

* **ACL:Right/Common/:** This prefix should be used for rights that affect the majority of users e.g. the right for all registered users to read articles.
* **ACL:Right/User/username/name of right:** This prefix should be used for the rights that a user defines for himself. E.g. Peter should define his rights like this: ACL:Right/User/Peter/PermitRead. 

## The right to modify rights

Rights can be modified in the security descriptor page (i.e. the article that is linked to the protected element by its name) and in a predefined right (i.e. an article of the Category:ACL/Right).

Sysops always have the rights to modify access rights. An additional new parser function ```{{#manage rights:...}}``` takes a list of all users and groups who are allowed to change the rights. This functions is added to the security descriptor e.g.:

The user Peter and the group of ProjectManagers can modify this ACL.
```
{{#manage rights:assigned to=User:Peter, ProjectManagers}}
```
With these rights it is possible that an author writes an article and protects it as long as he is working on it. Later he can open it to reviewers but still hide it from the public. Finally he can release it and someone else can take full control over the article's rights.

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
