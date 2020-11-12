<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Exception;

/**
 * Class FileService
 *
 * @package App\Service
 */
class FileService
{
    /**
     * @var Finder
     */
    protected $finder;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Get content from the first file
     *
     * @param string  $folder   Folder
     * @param string  $fileName File names filter
     * @param boolean $decode   Decode from json
     *
     * @return File Content
     */
    public function getFileContent(string $folder, string $fileName, bool $decode = true)
    {
        $this->initFinder($folder, $fileName);

        $iterator = $this->finder->getIterator();
        $iterator->rewind();
        $file = $iterator->current();
        $content = $file->getContents();

        if (true === $decode) {
            return json_decode($content, true);
        }

        return $content;
    }

    /**
     * Delete multiple files
     *
     * @link https://symfony.com/doc/current/components/filesystem.html
     * @param string $folder   Folder
     * @param string $fileName File names filter
     * @param string $date     Date filter
     *
     * @return Number of files need to be deleted
     */
    public function removeMultiple(string $folder, string $fileName = null, string $date = null)
    {
        $this->initFinder($folder, $fileName, $date);

        $paths = $this->getAbsoluteFilePaths();
        $this->filesystem->remove($paths);

        return count($paths);
    }

    /**
     * Get list of file names
     *
     * @return array
     */
    private function getAbsoluteFilePaths()
    {
        $paths = [];
        foreach ($this->finder as $file) {
            $paths[] = $file->getRealPath();
        }

        return $paths;
    }

    /**
     * Init Finder Component
     *
     * @link https://symfony.com/doc/current/components/finder.html
     * @param string $folder   Folder
     * @param string $fileName File names filter
     * @param string $date     Date filter
     *
     * @return void
     * @throws Exception $e.
     */
    private function initFinder(string $folder, string $fileName = null, string $date = null)
    {
        $finder = new Finder();
        try {
            $finder->files()->in($folder);

            if (null !== $fileName) {
                $finder->name($fileName);
            }

            if (null !== $date) {
                $finder->date($date);
            }
        } catch (Exception $e) {
            throw $e;
        }

        $this->finder = $finder;
    }
}
