<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Traits;

use Lyssal\Entity\Traits\UploadedFileTrait as BaseUploadedFileTrait;
use Lyssal\Exception\IoException;
use Lyssal\File\File;

/**
 * This trait helps to manage an upload file in an entity.
 * You have to create in your entity a property name $uploadedFile.
 */
trait UploadedFileTrait
{
    use BaseUploadedFileTrait;


    /**
     * @var string New filename of the uploaded name
     */
    protected $uploadedFileFilename;


    /**
     * Get the uploaded file.
     *
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile The uploaded file
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    /**
     * Get the filename of the saved file.
     *
     * @return string The filename
     */
    public function getUploadedFileFilename()
    {
        return $this->uploadedFileFilename;
    }

    /**
     * Get the pathame of the saved file.
     *
     * @return string The filename
     */
    public function getUploadedFilePathname()
    {
        return $this->getUploadedFileDirectory().DIRECTORY_SEPARATOR.$this->uploadedFileFilename;
    }


    /**
     * Upload the file.
     *
     * @param string|null $filename The new filename, else the upload filename will be used
     * @return string The filename of the saved file
     * @throws \Lyssal\Exception\IoException If the file can not be saved
     */
    public function uploadFile($filename = null)
    {
        return $this->saveUploadedFile($filename, false);
    }

    /**
     * Save the uploaded file in the server.
     *
     * @param string|null $filename The new filename, else the upload filename will be used
     * @param bool        $replace  If an existing file has to be replaced, else the file will be renamed
     * @return string The filename of the saved file
     * @throws \Lyssal\Exception\IoException If the file can not be saved
     */
    protected function saveUploadedFile($filename = null, $replace = false)
    {
        if (UPLOAD_ERR_OK !== $this->getUploadedFile()->getError()) {
            throw new IoException($this->getUploadedFile()->getErrorMessage());
        }

        if (null === $filename) {
            $filename = $this->getUploadedFile()->getClientOriginalName();
        }

        $file = new File($this->getUploadedFile()->getRealPath());
        if ($file->move($this->getUploadedFileDirectory().DIRECTORY_SEPARATOR.$filename, $replace)) {
            $this->setUploadedFile(null);
            $this->fileUploadIsSuccess = true;
            return $file->getFilename();
        }

        throw new IoException('The upload file can not be found.');
    }
}
