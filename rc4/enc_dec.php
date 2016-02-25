<?php

include '../phpseclib/phpseclib/Crypt/Base.php';
include '../phpseclib/phpseclib/Crypt/DES.php';
include '../phpseclib/phpseclib/Crypt/RC4.php';

$plaintext = 'Something very secret.';
$password = 'VdcpDTWTc5Aehxgv2uL9haaFddDBhrc8uCMG3ykg';

echo 'Plaintext: ' . $plaintext . "\r\n";

//Create new RC4 object for encrypting
$des_encrypt = new \phpseclib\Crypt\RC4(\phpseclib\Crypt\RC4::MODE_ECB);
//set OPENSSL as preferred engine
$des_encrypt->setPreferredEngine(phpseclib\Crypt\RC4::ENGINE_OPENSSL);
//set keylength to 256
$des_encrypt->setKeyLength(256);
//set pbkdf2 with sha512 and 4096 iterations as password hashing method
$des_encrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);

$ciphertext_raw = $des_encrypt->encrypt($plaintext);

echo 'Ciphertext(RAW): ' . $ciphertext_raw . "\r\n";

$ciphertext = base64_encode($ciphertext_raw);

echo 'Ciphertext(base64): ' . $ciphertext . "\r\n";

//Create new RC4 object for decryption
$des_decrypt = new phpseclib\Crypt\RC4(phpseclib\Crypt\RC4::MODE_ECB);
//set OPENSSL as preferred engine
$des_decrypt->setPreferredEngine(phpseclib\Crypt\RC4::ENGINE_OPENSSL);
//set key length to 256
$des_decrypt->setKeyLength(256);
//set pbkdf2 with sha512 and 4096 iterations as password hashing method
$des_decrypt->setPassword($password, 'pbkdf2', 'sha512', NULL, 4096);
//Decode from base64 and decrypt
$decrypted = $des_decrypt->decrypt(base64_decode($ciphertext));

echo 'Decrypted: ' . $decrypted . "\r\n";

//Is everything ok?
var_dump($plaintext == $decrypted);
