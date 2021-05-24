<?php
    namespace Crypton;

    class Utility {
        public function __construct() {
            // 
        }

        function base58Permutation($char, $reverse = false) {
            $table = [
                      '1','2','3','4','5','6','7','8','9','A','B','C','D',
                      'E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W',
                      'X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','m','n','o',
                      'p','q','r','s','t','u','v','w','x','y','z'
                     ];
    
            if($reverse)
            {
                $reversedTable = [];
                foreach($table as $key => $element)
                {
                    $reversedTable[$element] = $key;
                }
    
                if(isset($reversedTable[$char]))
                    return $reversedTable[$char];
                else
                    return null;
            }
    
            if(isset($table[$char]))
                return $table[$char];
            else
                return null;
        }

        function base58Encode($data, $littleEndian = true): string {
            $res = '';
            $dataIntVal = gmp_init($data, 16);
            while(gmp_cmp($dataIntVal, gmp_init(0, 10)) > 0)
            {
                $qr = gmp_div_qr($dataIntVal, gmp_init(58, 10));
                $dataIntVal = $qr[0];
                $reminder = gmp_strval($qr[1]);
                if(! self::base58Permutation($reminder))
                {
                    throw new \Exception('Something went wrong during base58 encoding');
                }
                $res .= self::base58Permutation($reminder);
            }

            //get number of leading zeros
            $leading = '';
            $i = 0;
            while(substr($data, $i, 1) === '0')
            {
                if($i!== 0 && $i%2)
                {
                    $leading .= '1';
                }
                $i++;
            }

            if($littleEndian)
                return strrev($res . $leading);
            else
                return $res.$leading;
        }

        function base58Decode($encodedData, $littleEndian = true) {
            $res = gmp_init(0, 10);
            $length = strlen($encodedData);
            if($littleEndian) {
                $encodedData = strrev($encodedData);
            }
    
            for($i = $length - 1; $i >= 0; $i--)
            {
                $res = gmp_add(
                               gmp_mul(
                                       $res,
                                       gmp_init(58, 10)
                               ),
                               self::base58Permutation(substr($encodedData, $i, 1), true)
                       );
            }
    
            $res = gmp_strval($res, 16);
            $i = $length - 1;
            while(substr($encodedData, $i, 1) === '1')
            {
                $res = '00' . $res;
                $i--;
            }
    
            if(strlen($res)%2 !== 0)
            {
                $res = '0' . $res;
            }
    
            return $res;
        }

        public function ShortenAddress($cryptonAddress = ''): string {
            return self::base58Encode($cryptonAddress);
        }

        public function UnShortenAddress($cryptonAddress = '', $uppercase = true): string {
            $result = self::base58Decode($cryptonAddress);
            if($uppercase) {
                return strtoupper($result);
            }
            return $result;
        }
    }
