<?php namespace Omnipay\Webpay\Message;

class FetchProfileCardsRequest extends FetchProfileRequest
{
    public function getEndpoint()
    {
        return $this->endpoint . '/' . $this->getProfileId() . '/cards';
    }
}
