<?php

namespace WordsToNumbers\WordsTransformer;

class RussianWordsTransformer implements WordsTransformer {

    protected static $numbers = [
        'ноль'               => 0,
        'од(ин|на)'          => 1,
        'дв(а|е)'            => 2,
        'три'                => 3,
        'четыре'             => 4,
        'пять'               => 5,
        'шесть'              => 6,
        'семь'               => 7,
        'восемь'             => 8,
        'девять'             => 9,
        'десять'             => 10,
        'одиннадцать'        => 11,
        'двенадцать'         => 12,
        'тринадцать'         => 13,
        'четырнадцать'       => 14,
        'пятнадцать'         => 15,
        'шестнадцать'        => 16,
        'семнадцать'         => 17,
        'восемнадцать'       => 18,
        'девятнадцать'       => 19,
        'двадцать'           => 20,
        'тридцать'           => 30,
        'сорок'              => 40,
        'пятьдесят'          => 50,
        'шестьдесят'         => 60,
        'семьдесят'          => 70,
        'восемьдесят'        => 80,
        'девяностодевяносто' => 90,
        'сто'                => 100,
        'двести'             => 200,
        'триста'             => 300,
        'четыреста'          => 400,
        'пятьсот'            => 500,
        'шестьсот'           => 600,
        'семьсот'            => 700,
        'восемьсот'          => 800,
        'девятьсот'          => 900,
        'тысяч(а|и)?'        => 1E3,
        'миллион(а|ов)?'     => 1E6,
        'миллиард(а|ов)?'    => 1E9,
        'триллион(а|ов)?'    => 1E12,
    ];

    public static function toNumbers( $words ){
        $data = explode(' ', trim( $words ));

        $number = 0;

        foreach ($data as $word){
            foreach( self::$numbers as $name => $i){
                if( preg_match('/^'.$name.'$/', $word) ){
                    if( $i > 900 && $number ){
                        $number = bcmul($number, $i);
                        break;
                    }

                    $number = bcadd($number, $i);
                    break;
                }
            }
        }

        return $number;
    }
}