<?php

class GetResponse
{
    private bool $isValidationsNonErrors = true;

    public function responseValidation(array $errorResponse): string
    {
        foreach ($errorResponse as $value) {
            if ($value !== true) {
                $this->isValidationsNonErrors = false;
            }
        }

        if (!$this->isValidationsNonErrors) {
            return json_encode(
                array(
                    'success' => false,
                    'errors' => $this->clearErrorResponse($errorResponse)
                )
            );
        } else {
            return json_encode(
                array(
                    'success' => true,
                )
            );
        }
    }

    public function clearErrorResponse(array $arrErrors): array
    {
        return array_filter($arrErrors, function ($element) {
            return $element !== true;
        });
    }
}