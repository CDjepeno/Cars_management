<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\SearchCars;
use App\Form\CarType;
use App\Form\SearchCarsType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * Permet d'afficher les véhicules sur la partie admin
     *
     * @Route("/admin", name="admin_cars")
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
            "admin" => true
        ]);
    }

    /**
     * Permet de modifier un véhicule et ajouter un véhicule
     * 
     * @Route("/admin/add", name="add_car")
     * @Route("/admin/update/{id}", name="update_car", methods="GET|POST")
     *
     * @param Car $car
     * @param Request $request
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function addUpdate(Car $car=null, Request $request, EntityManagerInterface $manager) 
    {
        if(!$car) {
            $car = new Car();
        }
        $form = $this->createForm(CarType::class,$car);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $update = $car->getId() !== null;
            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                "success",
                ($update) ? "La modification a bien été éffectuer" : "le véhicule a bien été ajouter"
            );

            return $this->redirectToRoute("admin_cars");
        }
        return $this->render('admin/addUpdateCar.html.Twig',[
            "form" => $form->createView(),
            "car"  => $car, 
            "is_Update" => $car->getId() !== null
        ]);
    }

    /**
     * Permet de supprimer un véhicule
     * 
     * @Route("/admin/delete/{id}", name="delete_car", methods="delete")
     *
     * @return void
     */
    public function delete(Car $car, EntityManagerInterface $manager,Request $request)
    {
        if($this->isCsrfTokenValid("SUP". $car->getId(), $request->get("_token")))
        {
            $manager->remove($car);
            $manager->flush();

            $this->addFlash(
                "danger", 
                "le véhicule a bien été supprimer"
            );

            return $this->redirectToRoute("admin_cars");
        }
    }
     
}
