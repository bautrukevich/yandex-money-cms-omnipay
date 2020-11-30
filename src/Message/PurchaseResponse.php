<?php

namespace yandexmoney\YandexMoney\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * YandexMoney Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
  
    public function getEndpoint()
    {
        if ($this->getRequest()->getTestMode()){
            return 'https://demomoney.yoomoney.ru/eshop.xml'
        } else {
            return 'https://yoomoney.ru/eshop.xml';
        }
    }


    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        return $this->getEndpoint();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectData()
    {
        return $this->data;
    }
}
