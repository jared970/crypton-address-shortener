# crypton-address-shortener
Library for handling Crypton addresses and vouchers.

This solution can be used to shorten the wallet address in order to use it in the URL for web services.
For example, it will be possible to use a shortened link when creating a donation service in Crypton.

## install

```bash
composer require jared970/crypton-shortener
```

## example

```php
// account pubkey = crypton address
$cryptonAddress = '2F2BF157DB859C01FE0CDC2C7F2B5A787ED34EB964559F1E093237EE4707249C';

$util = new Crypton\Utility();
echo $util->ShortenAddress($cryptonAddress);
```

result:

```
4B92T3TNfrNEuSLj4N8AAXp1zyHrHVbqUgNhDSmc931d
```
