# Installation

1. Update your `composer.json` :

```json
"require": {
    "lyssal/entity-bundle": "~x.y"
}
```

2. Update with Composer :

```sh
composer update
```

3. Add in your `AppKernel.php` :

```php
new Lyssal\EntityBundle\LyssalEntityBundle(),
```

## Repository

If you want to use the functionalities of the Lyssal `EntityRepository` or `EntityManager`, you have to define `doctrine.orm.default_repository_class` in your `config.yml` :

```yml
doctrine:
    orm:
        default_repository_class: 'Lyssal\EntityBundle\Repository\EntityRepository'
```
