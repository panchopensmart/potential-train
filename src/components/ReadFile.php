<?php

class ReadFile
{
    public function readXmlFile(string $path): array
    {
        $readFile = file_get_contents($path, true);
        return explode(';', $readFile);
    }

    public function readCsvFile(string $path): array
    {
        $readFile = file_get_contents($path, true);
        return explode(';', $readFile);
    }

    public function readLinesFromFile($filename) : Iterator
    {
        $file = fopen($filename, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                yield $line;
                if (str_ends_with(trim($line), '.php')) {
                    break;
                }
            }
            fclose($file);
        }
    }
}