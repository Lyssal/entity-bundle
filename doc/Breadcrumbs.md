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
        return $this->myParent;
    }
    
    /**
     * @see \Lyssal\EntityBundle\Entity\RoutableInterface::getRouteProperties()
     */
    public function getRouteProperties(): array
    {
        return ['my_route', ['myEntity' => $this->id]];
    }
    
    
    /**
     * Get the name.
     *
     * @return string The name
     */
    public function __toString()
    {
        // Here return the entity name
        return $this->name;
    }
}
```

Just call the `lyssal_breadcrumb` function in your template to display the breadcrumb.

The first paramater either an entity or a string.
If you want to add a parent, set a second parameter.
If you still want to add an other parent, set a third parameter, etc.

```twig
{{ lyssal_breadcrumb(my_entity) }}

{# Add a parent element #}
{{ lyssal_breadcrumb(my_entity, '<a href="#">My parent</a>') }}

{# ... > My entity > Edit #}
{{ lyssal_breadcrumb('edit'|trans, my_entity) }}
```

## The template

You can define your breadcrumb template in config:

```yaml
lyssal_entity:
    breadcrumbs:
        template: '@App/breadcrumbs.html.twig'
```

By default, it is a simple HTML list but you also can use a defined template:


```yaml
# If you use Foundation 6
template: '@LyssalEntity/_breadcrumbs/foundation_6.html.twig'

# If you use Bootstrap 4
template: '@LyssalEntity/_breadcrumbs/bootstrap_4.html.twig'

# By default
template: '@LyssalEntity/_breadcrumbs/dedfault.html.twig'
```


## Add a root element

To automatically add a root element, specify in your config:

```yaml
lyssal_entity:
    breadcrumbs:
        root: '<a href="/">HOME</a>'
```

