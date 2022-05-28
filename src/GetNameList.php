<?php

namespace vadimushka_d\NameList;

class GetNameList
{

    public static array $LOCALES = ['ru'];

    protected string $fileMale;
    protected string $fileFemale;
    protected string $fileLast;
    protected string $error;

    public function __construct(protected $count = 1, protected $language = 'ru')
    {
        $this->fileMale = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $this->language . DIRECTORY_SEPARATOR . 'male.txt';
        $this->fileFemale = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $this->language . DIRECTORY_SEPARATOR . 'female.txt';
        $this->fileLast = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $this->language . DIRECTORY_SEPARATOR . 'last.txt';
    }

    /**
     * @return bool|Name[]
     */
    public function getMaleNames(): bool|array
    {
        try {
            list($names, $last) = $this->shuffle($this->getContent($this->fileMale), $this->getContent($this->fileLast));
            return $this->generation($names, $last);
        } catch (\Exception $exception) {
            $this->error = $exception->getMessage();
            return false;
        }
    }

    /**
     * @return bool|Name[]
     */
    public function getFemaleNames(): bool|array
    {
        try {
            list($names, $last) = $this->shuffle($this->getContent($this->fileFemale), $this->getContent($this->fileLast));
            return $this->generation($names, $last, true);
        } catch (\Exception $exception) {
            $this->error = $exception->getMessage();
            return false;
        }
    }


    public function getError(): string
    {
        return $this->error;
    }


    protected function generation(array $names, array $last, $isFemale = false): array
    {
        $generations = [];
        for ($i = 0; $i < $this->count; $i++) {
            $generations[] = new Name($names[$i], $last[$i], $isFemale);
        }
        return $generations;
    }

    protected function shuffle(array $names, array $last): array
    {
        shuffle($names);
        shuffle($last);
        return [$names, $last];
    }

    /**
     * @throws \Exception
     */
    protected function getContent(string $pathToFile): array
    {
        if(!$this->isReadableFile($pathToFile)){
            throw new \Exception('File not found or not access for read file');
        }
        return file($pathToFile, FILE_IGNORE_NEW_LINES);
    }

    protected function isReadableFile(string $pathToFile): bool
    {
        return is_readable($pathToFile);
    }


}