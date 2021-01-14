<?php

class Kriptografi {
    private $cipher;
    private $plain;
 
    function generateKey($text)
    {
        $hasil = sqrt(strlen($text));
        return ceil($hasil);
    }

    function enkripCaesar($plain) {
        $cipher = "";
        $key = $this->generateKey($plain) % 26;

        for ($i = 0; $i < strlen($plain); $i++) {
            $add = $plain[$i];
            $ascii = ord($plain[$i]);
            if ($ascii > 64 && $ascii < 91) {
                $ascii = $ascii + $key;
                if ($ascii > 90) $ascii -= 26;
                $add = chr($ascii);
            } else if ($ascii > 96 && $ascii < 123) {
                $ascii = $ascii + $key;
                if ($ascii > 122) $ascii -= 26;
                $add = chr($ascii);
            }
            $cipher = $cipher . $add;
        }
        $this->cipher = $cipher;
    }

    function dekripCaesar() {
        //cipher text adalah text yang sudah di dekrip dengan scytale
        $cipher = $this->plain;

        $plain = "";
        $key = $this->generateKey($cipher) % 26;

        for ($i = 0; $i < strlen($cipher); $i++) {
            $add = $cipher[$i];
            $ascii = ord($cipher[$i]);
            if ($ascii > 64 && $ascii < 91) {
                $ascii = $ascii - $key;
                if ($ascii < 65) $ascii += 26;
                $add = chr($ascii);
            } else if ($ascii > 96 && $ascii < 123) {
                $ascii = $ascii - $key;
                if ($ascii < 97) $ascii += 26;
                $add = chr($ascii);
            }
            $plain = $plain . $add;
        }
        $this->plain = $plain;
    }
 
    function enkripScytale() {
        $space = "~";
        $offset = "`";
        //plaintext dari scytale adalah cipher hasil caesar
        $plain = $this->cipher;
        $sizePlain = strlen($plain);
        $currentIndex = 0;
        $key = $this->generateKey($plain);
        $matrix = array_fill(0, $key, array_fill(0, $key, ""));

        for ($i = 0; $i < $key; $i++) {
            for ($j = 0; $j < $key; $j++) {
                if ($currentIndex < $sizePlain) {
                    $char = $plain[$currentIndex];
                    if ($char == " ") $char = $space;
                } else {
                    $char = $offset;
                }
                $matrix[$i][$j] = $char;
                $currentIndex++;
            }
        }
        $cipher = "";

        for ($i = 0; $i < $key; $i++) {
            for ($j = 0; $j < $key; $j++) {
                $cipher = $cipher . $matrix[$j][$i];
            }
        }
        $this->cipher = $cipher;
    }

    function dekripScytale($cipher) {
        $space = "~"; $offset = "`";
        $sizeCipher = strlen($cipher);
        $currentIndex = 0;
        $key = $this->generateKey($cipher);
        $matrix = array_fill(0, $key, array_fill(0, $key, ""));

        for ($i = 0; $i < $key; $i++) {
            for ($j = 0; $j < $key; $j++) {
                if ($currentIndex < $sizeCipher) {
                    $char = $cipher[$currentIndex];
                    if ($char == " ") $char = $space;
                } else $char = $offset;
                $matrix[$i][$j] = $char;
                $currentIndex++;
            }
        }
        $plain = "";
        for ($i = 0; $i < $key; $i++) {
            for ($j = 0; $j < $key; $j++) {
                if ($matrix[$j][$i] == $space) {
                    $plain = $plain . " ";
                } else if ($matrix[$j][$i] != $offset) {
                    $plain = $plain . $matrix[$j][$i];
                }
            }
        }
        $this->plain = $plain;
    }

    function setWord($text, $act) {
        if ($act == 'enkripsi') {
            //lakukan pemanggilan enkripsi disini,,, 
            $this->enkripCaesar($text);
            $this->enkripScytale();
        } else {
            // dekripsi disini
            $this->dekripScytale($text);
            $this->dekripCaesar();
        }
        
    }

    function getCipher() {
        return $this->cipher;
    }

    function getPlain() {
        return $this->plain;
    }
}