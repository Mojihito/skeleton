# Kanban board for Github issues

## About

This is a simple, read-only, Kanban-board for Github issues.

### Concepts and workflow

* `Queued:` are open issues, in a milestone with no one assigned
* `Active:` are any open issue, in a milestone with someone assigned
* `Completed:` are any issues in a milestone that is closed

#### How to install and use

* git clone https://github.com/Mojihito/skeleton.git
* composer install
* PHP document root should point to public/index.php. 
Alternatively you can install symfony in build PHP server
https://symfony.com/doc/current/setup/symfony_server.html
* use /chooserepo route to get a starting form
