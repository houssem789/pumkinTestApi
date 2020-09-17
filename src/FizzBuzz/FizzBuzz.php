<?php

declare(strict_types=1);

namespace App\FizzBuzz;

final class FizzBuzz
{

    public function testMethod()
    {
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
    }
}
