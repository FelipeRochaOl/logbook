<?php

namespace App\core;

use Exception;
use InvalidArgumentException;

class File
{
    private string $tempName;
    private string $destinationPath;
    private string $name;
    private string $size;
    private string $type;
    private string $error;

    public function __construct(array $file)
    {
        $this->tempName = $file["tmp_name"] ?? '';
        $this->name = isset($file["name"]) ? $file['name'] : '';
        $this->size = isset($file["size"]) ? $file['size'] : '';
        $this->type = isset($file["type"]) ? $file['type'] : '';
        $this->error = isset($file["error"]) ? $file['error'] : '';
    }

    public function getError()
    {
        return $this->error;
    }

    public function getDestinationPath(): string
    {
        return $this->destinationPath;
    }

    public function setDestinationPath($destinationPath): void
    {
        $this->destinationPath = $destinationPath;
    }

    public function getTempName(): string
    {
        return $this->tempName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @throws Exception
     */
    public function save(): void
    {
        try {
            $this->moveUploadedFile();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function createDir(): bool
    {
        if (!isset($this->destinationPath)) {
            throw new InvalidArgumentException("Destination path without value. Did you put a target folder with the setDestinationPath() method?");
        }
        if (!$this->isDirExists()) {
            if (!mkdir($this->destinationPath, 0777, true)) {
                throw new Exception("Error during create a directory");
            };
        }
        return true;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function isDirExists(): bool
    {
        if (!isset($this->destinationPath)) {
            throw new InvalidArgumentException("Destination path without value. Did you put a target folder with the setDestinationPath() method?");
        }
        return is_dir($this->destinationPath);
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function moveUploadedFile(): bool
    {
        $this->createDir();
        $destiny = $this->destinationPath . "/" . $this->name;
        if (!move_uploaded_file($this->tempName, $destiny)) {
            throw new InvalidArgumentException("The filename is not a valid upload file or cannot be moved for some reason.");
        }
        return true;
    }

}