<?php

namespace App\Controller;

use App\Services\ClientApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ApiController extends AbstractController
{

    /**
     * @Route("/api/git-hub-data", name="api_git_hub_data")
     */
    public function gitHubData(Request $request,  ClientApi $clienApi)
    {

        $data = $clienApi->fetchData(
            'GET',
            'https://api.github.com/repos/symfony/symfony-docs'
        );
        dump($data);
        die;
    }
}
