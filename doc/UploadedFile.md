# Decorator

The UploadedFileTrait help you to manage an uploaded file / image in your entity.


## How to use

```php
// Call the trait in your entity class
use Lyssal\EntityBundle\Traits\UploadedFileTrait;

// Define the $uploadedFile property (without anotation)
private $uploadedFile;

// Define the getUploadedFileDirectory() method which returns the directory path where uploaded files will be saved
public function getUploadedFileDirectory()
{
    return 'my_dir';
}
```

You also would create a Doctrine property to save the saved file name and overload the uploadFile() to handle the file.


## Here an example

```php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lyssal\EntityBundle\Traits\UploadedFileTrait;
use Lyssal\File\File;
use Lyssal\File\Image;

/**
 * My entity.
 *
 * @ORM\Entity()
 */
class MyEntity
{
    use UploadedFileTrait;


    /**
     * @var int The image max width
     */
    const IMAGE_MAX_WIDTH = 800;

    /**
     * @var int The image max height
     */
    const IMAGE_MAX_HEIGHT = 600;
    

    /**
     * @var string The image path
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;


    /**
     * @var \Symfony\Component\HttpFoundation\File\File
     */
    private $uploadedFile;


    /**
     * Get the image filename.
     *
     * @return null|string The filename
     */
    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    /**
     * Set the image filename.
     *
     * @param null|string $imageFilename The filename
     *
     * @return self
     */
    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }


    /**
     * Get the image path.
     *
     * @return string The image path
     */
    public function getImagePath()
    {
        return $this->getUploadedFileDirectory().'/'.$this->imageFilename;
    }

    /**
     * @see \Lyssal\Entity\Traits\UploadedFileTrait::getUploadedFileDirectory()
     */
    public function getUploadedFileDirectory()
    {
        return 'images'.DIRECTORY_SEPARATOR.'entity_dir';
    }

    /**
     * Save the uploaded image.
     *
     * @return void
     */
    public function uploadFile()
    {
        // Delete the old file if existing
        $this->deleteFile();
        // Save the file in the server
        $this->saveUploadedFile();

        // Here our image in the server
        $image = new Image($this->getUploadedFilePathname());
        // We minify the image name to remove special characters,
        // and specify a maxlength for the database
        $image->minify(null, null, true, 255);
        // We get the new filename
        $this->imageFilename = $image->getFilename();

        // We verify that the image format is managed
        if ($image->formatIsManaged()) {
            // We proportionally reduce the image
            $image->resizeProportionallyByMaxSize(self::IMAGE_MAX_WIDTH, self::IMAGE_MAX_HEIGHT);
        }
    }

    /**
     * Delete the image.
     */
    protected function deleteFile()
    {
        if (null !== $this->imageFilename) {
            $file = new File($this->getImagePath());
            $file->delete();
        }
    }
}
```
