<?php

namespace App\Controller\Admin;

use App\Service\JsonDataLoader;
use App\Controller\Admin\DashboardController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class JsonLoaderController extends AbstractDashboardController
{
    private $jsonDataLoader;

    public function __construct(JsonDataLoader $jsonDataLoader)
    {
        $this->jsonDataLoader = $jsonDataLoader;
    }

    #[Route('/admin/jsonloader', name: 'admin_json_loader', methods:['GET', 'POST'])]
    public function admin_jsonLoader(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('choice', ChoiceType::class, [
                'choices'  => [
                    'Countries' => 'countries',
                    'States' => 'states',
                    'Cities' => 'cities',
                ],
            ])
            ->add('file', FileType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $choice = $form->get('choice')->getData();
            $file = $form->get('file')->getData();

            if ($file) {
                // Handle the uploaded file
                $jsonFilePath = $file->getRealPath();
         
                // Call the service to load JSON data into the database
                // Assuming $choice contains the selected choice ('countries', 'states', or 'cities')
                switch ($choice) {
                    case 'countries':
                        // Load countries
                        $this->jsonDataLoader->loadCountriesFromJson($jsonFilePath);
                        break;
                    case 'states':
                        // Load states
                        $this->jsonDataLoader->loadStatesFromJson($jsonFilePath);
                        break;
                    case 'cities':
                        // Load cities
                        $this->jsonDataLoader->loadCitiesFromJson($jsonFilePath);
                        break;
                    default:
                        // Handle invalid choice
                        // You can log an error, display a message, or handle it in another way
                        $this->addFlash('error', 'Something went wrong with the choice selection.');
                        break;
                }

                // Add a flash message to indicate successful data loading
                $this->addFlash('success', 'JSON data loaded successfully.');

                // Redirect to a desired page
                return $this->redirectToRoute('admin_json_loader');
            }
        }

        return $this->render('admin/json_loader.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
