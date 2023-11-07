<?php

class CustomException extends Exception
{

    public function getCustomMessage(): string
    {
        return "Custom message " . $this->getMessage() . "\n";
    }

    private function getCustomCode(): string
    {
        return "Custom get code " . $this->getCode() . "\n";
    }

    private function getDateError(): string
    {
        return date('l jS \of F Y h:i:s A') . "\n";
    }

    private function getFunnyMessage(): string
    {
        return "its so fine message ;)" . "\n" . "\n";
    }

    private function getCustomLocation(): string
    {
        return 'Exception occurred in ' . $this->getFile() . ' on line ' . $this->getLine() . "\n";
    }

    private function collectingErrors(): void
    {
        $messages = [];
        array_push(
            $messages,
            $this->getDateError(),
            $this->getCustomMessage(),
            $this->getCustomCode(),
            $this->getCustomLocation(),
            $this->getFunnyMessage(),
        );
        $this->writeLog($messages);
    }

    private function writeLog(array $arrMessages): void
    {
        $file = fopen('../error.txt', 'a');
        fwrite($file, implode(' ', $arrMessages));
        fclose($file);
    }

    public function callException(): string
    {
        $this->collectingErrors();
        return 'Вызвана ошибка которая записана в лог';
    }
}