<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input) : string
    {
        $utf8 = [
            '/[áàâãªä]/u' => 'a',
            '/[ÁÀÂÃÄ]/u' => 'A',
            '/[ÍÌÎÏ]/u' => 'I',
            '/[íìîï]/u' => 'i',
            '/[éèêë]/u' => 'e',
            '/[ÉÈÊË]/u' => 'E',
            '/[óòôõºö]/u' => 'o',
            '/[ÓÒÔÕÖ]/u' => 'O',
            '/[úùûü]/u' => 'u',
            '/[ÚÙÛÜ]/u' => 'U',
            '/[!.;,:?]/' => '',
            '/#/' => '-',
            '/ç/' => 'c',
            '/Ç/' => 'C',
            '/ñ/' => 'n',
            '/Ñ/' => 'N',
            '/"/' => '',
            '/\'/' => '',
            '/[«»]/u' => ' ',
            '/[[]/u' => ' ',

        ];

        $firstStep = preg_replace(array_keys($utf8), array_values($utf8), $input);
        $secondStep = strtolower(preg_replace('/ {1,}/', '-', trim($firstStep)));
        $thirdStep =  preg_replace('/-{2,}/', '-', trim($secondStep));

        return $thirdStep;
    }
}