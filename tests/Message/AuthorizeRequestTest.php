<?php

namespace Omnipay\Webpay\Message;

use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize();
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.webpay.jp/v1/charges', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->request->setAmount('10.00');
        $this->setMockHttpResponse('AuthorizeSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertSame("ch_btBfZZ23w3FHgbb", $response->getTransactionReference());
        $this->assertNull($response->getCode());
        $responseCard = $response->getCard();

        $this->assertNotEmpty($responseCard);
        $this->assertSame('Visa', $responseCard['type']);
        $this->assertSame('1111', $responseCard['last4']);
        $this->assertSame('pass', $responseCard['cvc_check']);
    }

    public function testSendError()
    {
        $this->request->setAmount('10.00');
        $this->setMockHttpResponse('AuthorizeFailure.txt');
        $response = $this->request->send();
        $this->assertSame('This card cannot be used. Contact card issuer to determine reason or choose a different card.', $response->getMessage());
        $this->assertFalse($response->isSuccessful());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getOrderNumber());
        $this->assertNull($response->getType());
        $this->assertNull($response->getMessageId());
        $this->assertNull($response->getAuthCode());
        $responseCard = $response->getCard();
        $this->assertEmpty($responseCard);
    }


    public function testPaymentMethod()
    {
        $this->assertSame($this->request, $this->request->setPaymentMethod('card'));
        $this->assertSame('card', $this->request->getPaymentMethod());
    }


    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }
}
