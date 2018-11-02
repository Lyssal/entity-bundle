# The entity router

The entity router permits you to automtically generate an URL with your entities.

## How to use

Your entity have to implement RoutableInterface.

For example:

```php
namespace App\Entity;

use Lyssal\EntityBundle\Entity\RoutableInterface;

/**
 * My entity.
 */
class MyEntity implements RoutableInterface
{
    // My properties and methods
    
    /**
     * @see \Lyssal\EntityBundle\Entity\RoutableInterface::getRouteProperties()
     */
    public function getRouteProperties(): array
    {
        return ['my route', ['myEntity' => $this->id]];
    }
}
```

The `getRouteProperties()` have to return the route name and its parameters.


## The entity router service

Use the `lyssal.entity_router` service to generate URL.

```php
$entityUrl = $this->container->get('lyssal.entity_router')->generate($myEntity);
```


## Create your own entity router

* Your service must implement `Lyssal\EntityBundle\Router\EntityRouterInterface` ;
* Use the tag `lyssal.entity_router` when you init your service.


## The Twig function

You can you the `entity_path()` function:

```twig
<a href="{{ entity_path(my_entity) }}">Click here to show {{ appellation(my_entity) }}</a>
```
