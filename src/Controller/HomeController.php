<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractController
{
    public function __invoke()
    {
        $hue = random_int(0, 360);
        $darkColor = static function (float $alpha = 1) use ($hue) { return "hsla($hue, 20%, 45%, $alpha)"; };
        $lightColor = static function (float $alpha = 1) use ($hue) { return "hsla($hue, 20%, 95%, $alpha)"; };

        return $this->render('instructions.html.twig', [
            'hue' => $hue,
            'darkColor' => $darkColor(),
            'lightColor' => $lightColor(),
            'darkColor075' => $darkColor(0.75),
        ]);
    }
}