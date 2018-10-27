# Entityable

The Entityable permits to add a linked entity property in an entity without a real relation (as a ManyToOne for example).

It can be useful if your entity can have a relation with an infinity of entity classes.

You can see an example of use in `LyssalSeoBundle`. The `Page` entity is an `Entityable` because the pages can be linked to a lot of other entities (and we cannot know which in advance).


## How to use


```php
namespace App\Entity;

use Lyssal\EntityBundle\Entity\EntityableInterface;
use Lyssal\EntityBundle\Entity\Traits\EntityTrait;

/**
 * My entity.
 */
class MyEntity implements EntityableInterface
{
    use EntityTrait;
    
    // My other properties and methods
}

```
