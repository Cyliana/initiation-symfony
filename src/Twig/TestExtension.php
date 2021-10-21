<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TestExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping

            new TwigFilter('firstword', [$this, 'firstword']),  //1er argument ;: nom donner au filtre , 2 eme argument => fonction dans this
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('makebtn', [$this, 'makebtn']),
        ];
    }

    public function firstword($value)
    {
        $word = explode(' ', $value)[0];

        $word = str_replace(',','',$word);
        $word = str_replace('!','',$word);
        $word = str_replace('?','',$word);
        $word = str_replace('.','',$word);
        $word = str_replace(':','',$word);
        $word = str_replace(';','',$word);

        return($word);
    }


    public function makebtn($namebtn, $typebtn='')
    {
        switch($typebtn)
        {
            case "primary" : 
                echo '<button type="button" class="btn btn-primary">'.$namebtn.'</button>';
                break;
            case "secondary" : 
                echo '<button type="button" class="btn btn-secondary">'.$namebtn.'</button>';
                break;
            case "success" : 
                echo '<button type="button" class="btn btn-success">'.$namebtn.'</button>';
                break;
            case "danger" : 
                echo '<button type="button" class="btn btn-danger">'.$namebtn.'</button>';
                break;
            case "warning" : 
                echo '<button type="button" class="btn btn-warning">'.$namebtn.'</button>';
                break;
            case "info" : 
                echo '<button type="button" class="btn btn-info">'.$namebtn.'</button>';
                break;
            case "light" : 
                echo '<button type="button" class="btn btn-light">'.$namebtn.'</button>';
                break;
            case "dark" : 
                echo '<button type="button" class="btn btn-dark">'.$namebtn.'</button>';
                break;
            default : 
                echo '<button type="button" class="btn btn-link">'.$namebtn.'</button>';
            break;
        }
    }

}












