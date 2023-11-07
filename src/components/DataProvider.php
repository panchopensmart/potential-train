<?php

class DataProvider
{
    public function chooseData(array $userData, string $csvPath, string $xmlPath): array
    {
        $isEmpty = empty(array_filter([$userData]));
        if (!$isEmpty) {
            return array_values($userData);
        } else {
            return [];
        }
    }
}