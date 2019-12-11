<?php

namespace Hms\DictCheck;

/**
 * Class DictValidator
 * @package Hms\DictCheck
 *
 * @author  Hubert Smusz <hubert.smusz@gmail.pl>
 * @version 1.0.0
 */
final class Validator
{
    /**
     * @param $pass
     *
     * @return bool
     */
    public function validate($pass)
    {
        $wordFile   = __DIR__ . '/SJP/odm.txt';
        $pass = str_replace('.', '', $pass);
        $lcPass     = strtolower($pass); // also check password with numbers or punctuation subbed for letters
        $deleetPass = strtr($lcPass, '48[)36#1!0572', 'abcdeghllostz');

        if (is_readable($wordFile)) {
            if ($fh = fopen($wordFile, 'r')) {
                $found = false;
                while (!($found || feof($fh))) {
                    $words = preg_quote(strtolower(fgets($fh, 1024)), '/');
                    $words = explode(',', $words);
                    foreach ($words as $word) {
                        $word = trim($word);
                        if (strlen($word) < 4) {
                            continue; // skip small words
                        }

                        if (preg_match("/$word/", $lcPass) || preg_match("/$word/", $deleetPass)) {
                            $found = true;
                            continue 2;
                        }
                    }
                }
                fclose($fh);
                if ($found) {
                    return false;
                }
            }
        }

        return true;
    }
}
