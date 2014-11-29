# Creating security descriptors automatically

What happens when a user creates a new article? Does the user have to create the corresponding security descriptor or is it created automatically? And if so, what is its initial content? The solution is creating security descriptors automatically. 

## Initial rights for new pages

What happens when a user creates a new article? Does the user have to create the corresponding security descriptor or is it created automatically? And if so, what is its initial content?

We have three scenarios:

* The wiki is by default an open wiki i. e. all new articles are accessible by all users. Only if a page should be protected explicitly a security descriptor must be provided.
* New articles are automatically protected and belong to the author until he releases it. In this case a security descriptor must be created automatically with an ACL that permits only access for the author.
* New articles are automatically protected and belong to users and groups that can be freely defined. In this case a security descriptor must be created automatically with an ACL that can be configured. 


## Solution

Every user can define a template (not a MediaWiki template) for his default ACL. There is a special article with the naming scheme ACL:Template/<username> e.g. ACL:Template/Peter. This template article can contain any kind of valid ACL as described above. It can define rights for the author alone or arbitrary combinations of users and groups.

If the user creates a new article, the system checks, if he has defined an ACL template. If not, no security descriptor is created. This solves the problem of the first scenario, the open wiki. Otherwise, if the template exists, a security descriptor is created and filled with the content of the template. This serves the latter two scenarios.

Access to default rights templates:

* Users can only access (read, edit and create) their own initial rights templates.
* Sysops and bureaucrats can access the initial rights templates of other users. 

## The master template for initial rights

Wiki administrators can define a master template for new users. Each time a new user logs in for the first time, the master template is set as his default template. Experienced users can modify their default template.

The following master template is installed together with HaloACL. It defines that every new article can only be accessed by its creator. Of course the default rights can be changed afterwards.
```
{{#manage rights: assigned to={{{user}}}}}

{{#access:
 assigned to ={{{user}}}
|actions=*
|description=Allows * for {{{user}}}
}}

[[Category:ACL/ACL]]
```
This master template contains the special variable {{{user}}}. When the default template for a new user is created from the master template, this variable will be replaced by the actual user name.

Only sysops and bureaucrats can create and modify the master template. After it is saved, two errors will be reported:

* A right or security descriptor must contain rights or reference other rights.
8 A right or security descriptor must have at least one manager (group or user). 

This is because there is no special treatment for the master template where the variable ```{{{user}}}``` is no valid user or group name. So these messages can be ignored.

Several master templates can be present in the wiki, however, only one can be active at a time. Its name must be specified in the variable ```$haclgNewUserTemplate``` e.g.
```
$haclgNewUserTemplate="ACL:Template/NewUserTemplate";
```
This variable can be set in HACL_Initialize.php or in LocalSettings.php after the inclusion of HACL_Initialize.php and before ```enableHaloACL();```. 

** Copyright and License **

Initial text © 2011 ontoprise GmbH.

Permission is granted to copy, distribute and/or modify this document under the terms of the GNU Free Documentation License, Version 1.2 or any later version published by the Free Software Foundation; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the article [GNU Free Documentation License](http://www.gnu.org/licenses/fdl.html).
