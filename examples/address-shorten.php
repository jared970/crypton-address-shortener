<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    // account pubkey = crypton address
    $cryptonAddress = '2F2BF157DB859C01FE0CDC2C7F2B5A787ED34EB964559F1E093237EE4707249C';
    
    $util = new Crypton\Utility();
    echo $util->ShortenAddress($cryptonAddress);
