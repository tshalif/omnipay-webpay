<?php namespace Omnipay\Webpay\Message;

class AuthorizeRequest extends AbstractRequest
{
    protected $capture = false;

    public function getEndpoint()
    {
        return $this->endpoint . '/charges';
    }

    public function getData()
    {
        $this->validate('amount');

        $data = array(
            'amount' => $this->getAmount(),
            'currency' => strtolower($this->getCurrency()),
            'description' => $this->getTransactionId() . ' ' . $this->getDescription(),
            'capture' => $this->capture ? 'true' : 'false',
        );

        if ($this->getCard()) {
            $this->getCard()->validate();

            $data['card'] = array(
                'number' => $this->getCard()->getNumber(),
                'name' => $this->getCard()->getName(),
                'exp_month' => $this->getCard()->getExpiryDate('m'),
                'exp_year' => $this->getCard()->getExpiryDate('y'),
                'cvc' => $this->getCard()->getCvv(),
            );
        }

        if ($this->getToken()) {
            $data['card'] = $this->getToken();
        }

        return $data;
    }
}
