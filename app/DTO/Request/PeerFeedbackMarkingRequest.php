<?php


namespace App\DTO\Request;


class PeerFeedbackMarkingRequest
{
    /** @var int */
    public $reviewId;

    /** @var int */
    public $feedbackMark;

    /** @var string */
    public $feedbackComment;
}
