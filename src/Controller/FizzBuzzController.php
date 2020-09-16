<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;




class FizzBuzzController extends AbstractController
{

    public function __invoke()
    {

        for ($i = 1; $i <= 200; $i++) {
            echo $i;
            $multiThree = false;
            $multiFive = false;

            if ($i % 3 == 0) {
                $multiThree = true;
            } elseif ($i % 5 == 0) {
                $multiFive = true;
            }

            if ($multiThree && $multiFive) {
                echo "FizzBuzz";
            }
            if ($multiThree) {
                echo "Fizz";
            }

            if ($multiFive) {
                echo "Buzz";
            }

            echo $i;
        }

        die;
    }
}
