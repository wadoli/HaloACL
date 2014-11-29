# Creating ACL using Wikitext

This article explains how you can create an Access Control List with Wikitext, in order to protect your instances of namespaces, instances of categories, single pages and values of properties.

## What is an ontology

Ontology is a formal representation of the knowledge by a set of concepts within a domain and the relationships between those concepts. It is used to reason about the properties of that domain, and may be used to describe the domain.
Ontologies serve a similar function as database schemas by providing machine-processable semantics of informations sources through collections of terms and their relationships. They support sharing, using, and reusing information.

It exist three kinds of ontology:

* Upper ontology : Describes very general concepts that are the same across all domains. 

The most important function of an upper ontology is to support very broad semantic interoperability between a large number of ontologies accessible "under" this upper ontology.

* Domain/Task ontology : Models a specific domain, or part of the world. It represents the particular meanings of terms as they apply that domain.
* Meta ontology : Specifies an abstract system structure, by definding terms and relationships.

## A meta ontology for access rights

The rules for access control will be defined as content of the wiki i.e. special articles (the security descriptors) will define all access rights. These articles will be located in the new namespace ACL. Of course, this namespace will be protected by our extension so that only authorized users can modify the access rights. This Figure describe the ontology that is used for the definitions of rights. 

[ACLOnto.png](ACLOnto.png)

### Category:ACL/ACL

HaloACL will protect four kinds of wiki objects: instances of categories and namespaces, single pages and the values of semantic properties. They are protected by a security descriptor with an ACL that defines their access rights. Security descriptors are special articles in the category Category:ACL/ACL that are linked to the protected objects by their name. The naming convention is as follows:

* ACL:Category/<category name> : The security descriptor ACL:Category/Favorite books protects the instances of the category Category:Favorite books.
* ACL:Page/<pagename> : <pagename> is the complete name of the page that will be protected by the ACL. Examples are ACL:Page/Main page, ACL:Page/User:Peter and ACL:Page/Category:Favorite books. The latter does not protect the instances of category Favorite books but the category page itself.
* ACL:Namespace/<namespace name> : For instance, ACL:Namespace/User protects the articles in the namespace User.
* ACL:Property/<property name> : For example, ACL:Property/Salary protects the values of the property Property:Salary.

These articles define the ACL of the wiki objects that are linked by their name. An ACL can have a description that should explain the meaning of the ACL in prose. The ACL as such is composed by a list of inline rights definitions or links to predefined rights. 

### Inline right definition

An inline rights definition consists of users and/or groups, a set of predefined actions (read, edit, etc.) that are permitted and a description of the definition.

**Example:** The security descriptor ACL:Category/Favorite books contains the following ACL in form of an inline right definition:
```

{{#access:
 |assigned to = Reader, User:Peter, User:Paul
 |actions=read,edit,create
 |description= Allow r/e/c access for members of the group Readers, Peter and Paul to articles of the category "Favorite books".
 |name=Reader, Peter, Paul
 }}
```

## Property right definition

A property right definition is an inline right definition for property values.

**Example:** The security descriptor ACL:Property/Salary contains the following ACL with a property right definition:
```
{{#property access:
 assigned to=Chief Secretary
 |actions=read
 |description= Allow chief secretaries to read the salary.
 }}
```

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
