# BrauneDigitalMessageBundle

This Symfony2-Bundle provides a base for user to user and system messaging.
## Requirements
In order to install this bundle you will need:
* DoctrineORM (Entity Persistence) 
* SonataEasyExtends (optional but strongly recommended) 
## Installation

Just run composer:
```bash
composer require braune-digital/message-bundle
```

And enable the Bundle in AppKernel.php:
```php
public function registerBundles()
    {
        $bundles = array(
          ...
          new BrauneDigital\MessageBundle\BrauneDigitalMessageBundle(),
          ...
        );
```
In order to use the bundle you have to  

## Extend the Bundle
Just run:
```
php app/console sonata:easy-extends:generate --dest=src BrauneDigitalMessageBundle
```

Enable the extended Bundle in AppKernel.php:
```php
public function registerBundles()
    {
        $bundles = array(
          ...
          new Application\BrauneDigital\MessageBundle\ApplicationBrauneDigitalMessageBundle(),
          ...
        );
```

## Add the relations to your User-Entity  
```xml
<one-to-many target-entity="Application\BrauneDigital\MessageBundle\Entity\UserHasConversation" field="conversations" mapped-by="user">
            <cascade><cascade-remove /></cascade>
            <order-by>
                <order-by-field name="joinedOn" direction="DESC"/>
            </order-by>
        </one-to-many>

        <one-to-many target-entity="Application\BrauneDigital\MessageBundle\Entity\UserHasMessage" field="messages" mapped-by="user">
            <cascade><cascade-remove /></cascade>
            <order-by>
                <order-by-field name="date" direction="ASC"/>
            </order-by>
        </one-to-many>

        <one-to-many target-entity="Application\BrauneDigital\MessageBundle\Entity\Message" field="sentMessages" mapped-by="by">
            <order-by>
                <order-by-field name="date" direction="ASC"/>
            </order-by>
        </one-to-many>
```
## Todo
* Add Document Version
* Validation / Constraints
* Security (Voters)