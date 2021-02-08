<?php

class AntiXSS {
    public static $err = "XSS Detected!";

   
     */
    public static function setEncoding($str, $newEncoding) {
        $encodingList = mb_list_encodings();
        $currentEncoding = mb_detect_encoding($str, $encodingList);
        $changeEncoding = mb_convert_encoding($str, $newEncoding, $currentEncoding);

        return $changeEncoding;
    }

    
     */
    public static function blacklistFilter($str) {
        if (preg_match("/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)>(.*)/i", $str) > 0) {
            return $str;
        } else {
            return self::$err;
        }
    }

   
    public static function whitelistFilter($str, $whiteFilterPattern) {

        switch ($whiteFilterPattern) {
            case "string":
                $pattern = "([a-zA-Z]+)";
            break;
            case "number":
                $pattern = "([0-9]+)";
            break;
            case "everything":
                $pattern = "(.*)";
            break;
            default:
                $pattern = "([0-9a-zA-Z]+)";
            break;
        }

        if(preg_match("/^$pattern $/i", $str) > 0) {
            return $str;
        } else {
            return self::$err;
        }
    }

   
    public static function setFilter($str, $filterMethod, $filterPattern = NULL, $noHTMLTag = NULL) {

        if (urldecode($str) > 0) {
            $str = urldecode($str);
        }

        if ($noHTMLTag == 1) {
            $str = strip_tags($str);
        }

        $str = strtolower($str);
        $str = addslashes($str);
    $str = htmlspecialchars(trim($str));

        switch($filterMethod) {
            case "black":
                $str = self::blacklistFilter($str);
            break;
            case "white":
                $str = self::whitelistFilter($str, $filterPattern);
            break;
            default:
            break;
        }

        return $str;
    }
}
?>