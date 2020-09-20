<?php

namespace App\Services;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductManager extends AbstractController
{
    private $productRepository;
    private $email;
    private $session;

    public function __construct(
        String $email,
        ProductRepository $productRepository,
        EntityManagerInterface $em,
        SessionInterface $session
    ) {
        $this->email = $email;
        $this->productRepository = $productRepository;
        $this->em = $em;
        $this->session = $session;
    }

    public function addProduct(Product $product)
    {
        $this->em->persist($product);
        $this->em->flush();
        $this->session->getFlashBag()->add('success', 'Product has been added');
    }


    public function modifyProduct(Product $product)
    {
        $this->em->persist($product);
        $this->em->flush();
        $this->session->getFlashBag()->add('success', 'Product has been updated');
    }


    public function deleteProduct(Product $product)
    {
        $this->em->remove($product);
        $this->em->flush();
        $this->session->getFlashBag()->add('danger', 'Product has been updated');
    }

    /**
     * Finds all products
     */
    public function findAll()
    {
        $data = $this->productRepository->findAll();

        return $data;
    }
}
