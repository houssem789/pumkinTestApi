<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\FizzBuzz\FizzBuzz;




class FizzBuzzController extends AbstractController
{

    public function __invoke(FizzBuzz $fizzBuzz)
    {


        $fizzBuzz->testMethod();


        die;
        /*
        for ($i = 1; $i <= 200; $i++) {
            $multiThree = false;
            $multiFive = false;

            if ($i % 3 == 0) {
                $multiThree = true;
            }
            if ($i % 5 == 0) {
                $multiFive = true;
            }
            if ($multiThree && $multiFive) {
                echo "FizzBuzz" . PHP_EOL;
                continue;
            }
            if ($multiThree) {
                echo "Fizz" . PHP_EOL;;
                continue;
            }
            if ($multiFive) {
                echo "Buzz" . PHP_EOL;;
                continue;
            }

            echo $i . PHP_EOL;
        }

        die;*/
    }
}