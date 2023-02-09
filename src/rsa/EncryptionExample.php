<?php

namespace piotrbaczek\rsaexamples\rsa;

use piotrbaczek\rsaexamples\rsa\Common\PublicKeyWrapper;
use piotrbaczek\rsaexamples\rsa\Common\RsaInterface;

class EncryptionExample
{
    /** @var RsaInterface $rsa */
    private $rsa;

    public function __construct(RsaInterface $rsa)
    {
        $this->rsa = $rsa;
    }

    public function encrypt(PublicKeyWrapper $publicKeyWrapper, string $message)
    {
        return $this->rsa->encrypt($publicKeyWrapper, $message);
    }
}