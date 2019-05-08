# Decorator

The decorators permits you to create specific methods for an entity if you do not want or do not can add them in your `Entity` or your `Manager`.
The advantage of the decorator is you can inject all your needed services.


## Creation

Your `Decorator` class :

```php
namespace Acme\MyBundle\Decorator;

use Lyssal\EntityBundle\Decorator\AbstractDecorator;
use Acme\MyBundle\Entity\MyEntity;

class MyEntityDecorator extends AbstractDecorator
{
    /**
     * {@inheritDoc}
     */
    public function supports($entity)
    {
        return ($entity instanceof MyEntity);
    }


    /**
     * Return the label of the status.
     * 
     * @return string The status label
     */
    public function getStatusLabel()
    {
        return $this->entity->getStatus()->getLabel();
    }
}
```

Init your service :

```yaml
services:
    _defaults:
        autowire: true

    App\Doctrine\Decorator\MyEntityDecorator:
        tags: ['lyssal.decorator']
```


## Functionalities and use

Using the service :

```php
$myEntityDecorator = $this->container->get('lyssal.decorator')->get($myEntity);
echo $myEntityDecorator->getStatusLabel();
```

The decorators also works with array of entities :

```php
$myEntityDecorators = $this->container->get('lyssal.decorator')->get($myEntities);
foreach ($myEntityDecorators as $myEntityDecorator) {
    echo $myEntityDecorator->getStatusLabel();
}
```

The decorators can have a lot of vocations :

* Return an URL to view the entity properties :

```php
$myDecorator->getUrl();
```

* Return an image in HTML :

```php
$myDecorator->getIconHtml();
```

* Verify a right, an access :

```php
if ($periodDecorator->isOpen()) {
    // ...
}
```

* Etc

```php
if ($periodDecorator->isFinished()) {
    echo 'Finished';
}
echo $periodDecorator->getDayCount();
```

If a joined entity has a decorator, the getter will also return a decorator.

```php
$myEntityDecorator = $this->container->get('lyssal.decorator')->get($myEntity);
$myEntityDecorator->getTypes(); // If `MyEntityTypeDecorator` exists, will return an array of decorators
```

## The Twig functions

You can you the `decorator()` function :

```yaml
{# Display the avatar of the current user #}
{{ decorator(app.user).avatarHtml|raw_secure }}
```

## Extend the manager

```yaml
parameters:
    lyssal.entity.decorator.manager.class: 'App\Doctrine\Decorator\DecoratorManager'
```
