<?php namespace Omnipay\Webpay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return (!isset($this->data['error']) && empty($this->data['failure_message']));
    }

    public function getTransactionId()
    {
        return $this->d('id');
    }

    public function getTransactionReference()
    {
        return $this->d('id');
    }

    public function getType()
    {
        return $this->d('type');
    }

    public function getOrderNumber()
    {
        return $this->d('order_number');
    }

    public function getMessageId()
    {
        return $this->d('message_id');
    }

    public function getMessage()
    {
        if ($this->d('failure_message')) {
            return $this->d('failure_message');
        }

        $data = $this->d('error') ? $this->d('error') : $this->data;
        
        return $this->d('message', $data);
    }

    public function getAuthCode()
    {
        return $this->d('captured') || $this->d('paid') ? $this->d('id') : null;
    }

    public function getCode()
    {
        return $this->d('code');
    }

    public function getCard()
    {
        return $this->d('card');
    }

    public function getReference()
    {
        return $this->d('reference');
    }

    public function getCategory()
    {
        return $this->d('category');
    }
    
    private function d($field, $data = null)
    {
        $data = $data ? $data : $this->data;
        
        return isset($data[$field]) ? $data[$field] : null;
    }
}
