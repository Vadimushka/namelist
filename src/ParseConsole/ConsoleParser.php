<?php
namespace vadimushka_d\NameList\ParseConsole;

class ConsoleParser
{

    public static function parse(array $argv): array
    {
        $count = 1;
        $lang = 'ru';
        foreach ($argv as $arg) {
            $explode = explode('=', $arg, 2);
            if (count($explode) !== 2) {
                continue;
            }
            list($name, $value) = $explode;
            if ($name === '--lang') {
                $lang = $value;
                if (!in_array($lang, \vadimushka_d\NameList\GetNameList::$LOCALES)) {
                    throw new \Exception("Unsupported language - $lang, supported - " . implode(',', \vadimushka_d\NameList\GetNameList::$LOCALES));
                }
            }
            if ($name === '--count') {
                $count = intval($value);
            }
        }
        return [$count, $lang];
    }

}
