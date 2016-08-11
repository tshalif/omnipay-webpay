<?php namespace Omnipay\Webpay;

use Omnipay\Common\AbstractGateway;

/**
 * Webpay Gateway
 *
 * @link https://webpay.jp/
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Webpay';
    }

    public function getDefaultParameters()
    {
        return array(
            'authToken' => '',
        );
    }

    public function getAuthToken()
    {
        return $this->getParameter('authToken');
    }

    public function setAuthToken($authToken)
    {
        return $this->setParameter('authToken', $authToken);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Webpay\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Webpay\Message\AuthorizeRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Webpay\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Webpay\Message\PurchaseRequest', $parameters);
    }
}
