# The breadcrumbs

You can automatically generate breadcrumbs for your entity pages.


## How to use

First, your entities must implements `BreadcrumbableInterface`.

By default, to generate names, we use the [Appellation](doc/Appellation.md) so if your entity do not have an Appellation, do not forget the __toString method.

By default, to generate links, we use the [entity router](EntityRouter.md) so your entities have to implements `RoutableInterface`.


### Example

```php
namespace App\Entity;

use Lyssal\Entity\Model\Breadcrumb\BreadcrumbableInterface;
use Lyssal\EntityBundle\Entity\RoutableInterface;

/**
 * My entity.
 */
class MyEntity implements BreadcrumbableInterface, RoutableInterface
{
    // My properties and methods
    
    
    /**
     * @see \Lyssal\Entity\Model\Breadcrumb\BreadcrumbableInterface::getParent()
     */
    public function getBreadcrumbParent()
    {
        // Here return the parent entity
    }
    
    /**
     * @see \Lyssal\EntityBundle\Entity\RoutableInterface::getRouteProperties()
     */
    public function getRouteProperties(): array
    {
        return ['my route', ['myEntity' => $this->id]];
    }
    
    
    /**
     * Get the name.
     *
     * @return string The name
     */
    public function __toString()
    {
        // Here return the entity name
    }
}
```

## The templates

Call the breacrumb template in your template with a `breadcrumbs` array.

You can generate this array using the `lyssal_breadcrumbs` function.
Use the entity as first parameter and optionally for the second parameter you can use a string array for the first elements of the breadcrumbs.


```twig
{{ include('@LyssalEntity/_breadcrumbs/default.html.twig', { 'breadcrumbs': lyssal_breadcrumbs(my_entity) }) }}

{# Add the home page as root element #}
{{ include('@LyssalEntity/_breadcrumbs/default.html.twig', { 'breadcrumbs': lyssal_breadcrumbs(my_entity, '<a href="/">My home page</a>') }) }}

{# Add many links #}
{{ include('@LyssalEntity/_breadcrumbs/default.html.twig', { 'breadcrumbs': lyssal_breadcrumbs(my_entity, ['<a href="/">My home page</a>', 'My breadcrumb']) }) }}
```

You also have template for some frameworks:

```twig
{# For Foundation 6 #}
{{ include('@LyssalEntity/_breadcrumbs/foundation_6.html.twig', { 'breadcrumbs': lyssal_breadcrumbs(my_entity) }) }}

{# For Bootstrap 4 #}
{{ include('@LyssalEntity/_breadcrumbs/bootstrap_4.html.twig', { 'breadcrumbs': lyssal_breadcrumbs(my_entity) }) }}
```


## Add a root element

To automatically add a root element, specify in your config:

```yaml
lyssal_entity:
    breadcrumbs:
        root: '<a href="/">HOME</a>'
```

