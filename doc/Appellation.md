# Appellation

The appellations permit to use and display the appellation of an object.
A simple appellation is a string which defines the object.

The appellation will help you to have a consistency on all the appellation of your application.
And the HTML appellation will be helpful for example for easily display a link or an icon with the name of one of yours entities.


## Functionalities

### The Symfony service

Use the `lyssal.appellation` service to use appellations.


### The functions

#### The simple appellation

By default, it uses the `__toString()` method of the object.

Example of use in PHP :

```php
$cityAppellation = $this->container->get('lyssal.appellation')->appellation($city);
```

Example of use in Twig :

```twig
<p>Hello {{ appellation(user) }} !</p>
```


#### The HTML appellation

By default, it is the same as the simple appellation.

Example of use in PHP :

```php
$cityAppellationHtml = $this->container->get('lyssal.appellation')->appellationHtml($city);
```

Example of use in Twig :

```twig
<p>Click the city : {{ appellation_html(city) }}.</p>
```


## Create your appellation

If you want to customize the appellation of your entity `AcmeMyBundle:Entity`, simply create an `EntityAppellation` object like this :

```php
<?php
namespace Acme\MyBundle\Appellation;

use Lyssal\EntityBundle\Appellation\AbstractDefaultAppellation;
use Acme\MyBundle\Entity\Entity;

class EntityAppellation extends AbstractDefaultAppellation
{
    /**
     * {@inheritDoc}
     */
    public function supports($object)
    {
        return ($object instanceof Entity);
    }

    /**
     * {@inheritDoc}
     */
    public function appellation($object)
    {
        return $object->__toString().' (#'.$object->getId().')';
    }

    /**
     * {@inheritDoc}
     */
    public function appellationHtml($object)
    {
        return '<a href="'.$this->router->generate('acme_mybundle_entity_view', array('entity' => $object->getId())).'">'.$this->appellation($object).'</a>';
    }
}
```

And init your appellation service :

```xml
<service id="acme.mybundle.appellation.entity" class="Acme\MyBundle\Appellation\EntityAppellation">
    <tag name="lyssal.appellation" />
</service>
```

Note: Do not use a namespace with class as service ID, the compiler pass will not found it.

