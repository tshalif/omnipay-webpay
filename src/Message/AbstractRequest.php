<?php namespace Omnipay\Webpay\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $endpoint = 'https://api.webpay.jp/v1';

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getAuthToken()
    {
        return $this->getParameter('authToken');
    }

    public function setAuthToken($authToken)
    {
        return $this->setParameter('authToken', $authToken);
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('order_number');
    }

    public function setOrderNumber($value)
    {
        return $this->setParameter('order_number', $value);
    }

    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    public function getComments()
    {
        return $this->getParameter('comments');
    }

    public function setComments($value)
    {
        return $this->setParameter('comments', $value);
    }

    public function getTermUrl()
    {
        return $this->getParameter('term_url');
    }

    public function setTermUrl($value)
    {
        return $this->setParameter('term_url', $value);
    }

    public function getPaymentProfile()
    {
        return $this->getParameter('payment_profile');
    }

    public function setPaymentProfile($value)
    {
        return $this->setParameter('payment_profile', $value);
    }


    public function getHttpMethod()
    {
        return 'POST';
    }

    public function sendData($data)
    {
        // Don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        if (!empty($data)) {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                null,
                http_build_query($data)
            );
        } else {
            $httpRequest = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint()
            );
        }

        $httpResponse = $httpRequest
            ->setHeader(
                'Content-Type',
                'application/x-www-form-urlencoded'
            )
            ->setHeader(
                'Authorization',
                'Bearer ' . $this->getAuthToken()
            )
            ->send();

        return $this->response = new Response($this, $httpResponse->json());
    }
}
