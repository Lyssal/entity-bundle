# Installation

* Install with Composer:

```sh
composer require lyssal/entity-bundle
```

* Tag your services:

```yaml
services:
    _instanceof:
        # Only if you create your own decorators
        Lyssal\Entity\Decorator\DecoratorInterface:
            tags: ['lyssal.decorator']

        # Only if you create your own appellations
        Lyssal\Entity\Appellation\AppellationInterface:
            tags: ['lyssal.appellation']

        # Only if you create your own routers
        Lyssal\EntityBundle\Router\EntityRouterInterface:
            tags: ['lyssal.entity_router']
```
