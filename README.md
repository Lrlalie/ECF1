# ECF1
---

## Description
* an application of users' authentification with Symfony in PHP(particularity : webpack-encore, yarn, bootstrap, validator, doctrine, twig, UserInterface, provider, Routing, security.yaml, ...)
---
## Main fonctionnalities
* create an account
* login
* logout
* UserController, Entity User, Database, forms, twigs template
* fields : username, password, email (with confirmation of password, and it checks if username and email exist : Validator)
* update providers
* navigation
* security of fields
...

## To do 
*	By default a User created must have a Role with an attribute value containing the string ROLE_USER
*	The login form must be securised by a CSRF implementation @see CSRF
*	The access to signin and login for an logged user must be restricted using the current user role value with @Security or @IsGranted @see @Security & @IsGranted

---
## Contributors
* Laurence REYNIER
* Cyril ICHTI for the users history
---

## Copyright
* Copyright © Laurence REYNIER 2019 
* Copyright © M2I FORMATION 2019
---

## Bugs 
* I encontered several bugs during this ECF : particularly : conflict between 2 applications on the php language.
* Problems to understand routing
* it was a very good exercice to improve myself and i've learned more things about development (in particular the importance of the code sequence in an MVC context)
