<?php

class CheckUserInputs
{
    private const REGEXP_PRODUCT_CODE = '/^\d{1,3}-\d+$/';
    private const PRODUCT_CODE_LENGTH = 10;
    private const REGEXP_PRICE = '/^\d+\.\d{2}$/';
    private const MIN_NAME_CHARS = 5;
    private const MAX_NAME_CHARS = 64;
    private const MAX_DESCRIPTION_CHARS = 300;

    private function checkCode(string $code) : string | bool
    {
        if ($code == '') {
            return 'input "product code" is empty';
        }
        $code = strip_tags(quotemeta(trim($code)));
        if (preg_match(self::REGEXP_PRODUCT_CODE, $code) and strlen($code) <= self::PRODUCT_CODE_LENGTH) {
            return true;
        } else {
            return 'input "product code" is not contains (10 more values or incorrect format)';
        }
    }

    private function checkPrice(string $price) : string | bool
    {
        if ($price == '') {
            return 'input "price" is empty';
        }
        $price = strip_tags(trim($price));
        if (preg_match(self::REGEXP_PRICE, $price)) {
            return true;
        } else {
            return '"price" is not contains (incorrect format)';
        }
    }

    private function checkName(string $name) : string | bool
    {
        if ($name == '') {
            return 'input "name" is empty';
        }
        $name = strip_tags(quotemeta(trim($name)));
        if (strlen($name) >= self::MIN_NAME_CHARS and strlen($name) <= self::MAX_NAME_CHARS) {
            return true;
        } else {
            return '"name" is not contains (user value is more 64 symbols or less 5 symbols)';
        }
    }

    private function checkDescription(string $description) : string | bool
    {
        if ($description == '') {
            return 'input "description" is empty';
        }
        $description = strip_tags(quotemeta(trim($description)));
        if (strlen($description) <= self::MAX_DESCRIPTION_CHARS) {
            return true;
        } else {
            return '"description" is not contains (user value is more 300 symbols)';
        }
    }

    public function runCheck(array $inputData, GetResponse $getResponse) : string | bool
    {
        $errorResponse = [];
        $errorResponse[0] = $this->checkCode($inputData[0]);
        $errorResponse[1] = $this->checkPrice($inputData[1]);
        $errorResponse[2] = $this->checkName($inputData[2]);
        $errorResponse[3] = $this->checkDescription($inputData[3]);

        return $getResponse->responseValidation($errorResponse);
    }

}