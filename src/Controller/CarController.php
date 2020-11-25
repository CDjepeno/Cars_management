<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\CardScheme;

class CarController extends AbstractController
{
    /**
     * @Route("/customer/cars", name="cars")
     */
    public function index(CarRepository $car): Response
    {
        return $this->render('car/cars.html.twig', [
            'cars' => $car->findAll()
        ]);
    }
}
