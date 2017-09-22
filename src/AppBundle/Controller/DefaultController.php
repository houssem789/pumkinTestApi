<?php

namespace AppBundle\Controller;


use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Transaction\Transaction;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * Get transaction list of an user
     *
     * @param Request $request
     * @return Response
     *
     * @Rest\View
     */
    public function transactionListAction(Request $request)
    {
        $user = $this->getUser();

        return $user;
//        return $this->getDoctrine()->getRepository(Transaction::class)->findByUser($user);
    }
}
