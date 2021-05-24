<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    $cryptonAddressShort = '4B92T3TNfrNEuSLj4N8AAXp1zyHrHVbqUgNhDSmc931d';
    
    $util = new Crypton\Utility();
    echo $util->UnShortenAddress($cryptonAddressShort);
