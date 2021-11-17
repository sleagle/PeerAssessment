<?php


namespace App\DTO\Request;


class CreateUnitRequest
{
    /** @var string */
    public $token;

    /** @var string */
    public $unitCode;

    /** @var string */
    public $unitName;

    /** @var int */
    public $lectureId;
}
