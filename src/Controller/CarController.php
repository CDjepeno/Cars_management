<?php

namespace App\Controller;

use App\Entity\SearchCars;
use App\Form\SearchCarsType;
use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\CardScheme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    /**
     * Permet de crée la pagination sur 6 voitures
     * 
     * @Route("/customer/cars", name="cars")
     *
     * @param CarRepository $car
     * @param PaginatorInterface $paginator
     * @param Request $request
     * 
     * @return Response
     */
    public function index(CarRepository $car, PaginatorInterface $paginator, Request $request): Response
    {
        $searchCars = new SearchCars;

        $form = $this->createForm(SearchCarsType::class,$searchCars);

        $form->handleRequest($request);

        return $this->render('car/cars.html.twig', [
            "cars" => $paginator->paginate(
                        $car->findAllWithPagination($searchCars), 
                        $request->query->getInt('page', 1), 
                        6 
                    ),
            "form" => $form->createView(), 
            "admin" => false
        ]);
    }

    
}
