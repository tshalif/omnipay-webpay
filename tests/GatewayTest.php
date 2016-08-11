<?php namespace Omnipay\Webpay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testAuthorize()
    {
        $request = $this->gateway->authorize(
            array(
                'amount' => '10.00'
            )
        );
        $this->assertInstanceOf('Omnipay\Webpay\Message\AuthorizeRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('POST', $request->getHttpMethod());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(
            array(
                'amount' => '10.00'
            )
        );
        $this->assertInstanceOf('Omnipay\Webpay\Message\PurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('POST', $request->getHttpMethod());
    }
}
