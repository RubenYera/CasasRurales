<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Alojamiento;
use App\Entity\Comodidad;
use App\Entity\Tipo;
use App\Entity\Reserva;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // if (isGranted($this->getUser())) {
        //     throw $this->createAccessDeniedException();
        // }

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Admin', 'fa fa-home', 'home')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('images/logo/flash.svg')

            // the domain used by default is 'messages'
            // ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            ->renderSidebarMinimized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls()
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Volver a la Web', 'fa fa-globe', 'home');
        yield MenuItem::subMenu('Usuarios', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Listado', 'fas fa-list', User::class),
            MenuItem::linkToRoute('Alta Masiva', 'fas fa-plus', 'Alta_Masiva_Usuario'),
        ]);
        yield MenuItem::subMenu('Alojamientos', 'fas fa-building')->setSubItems([
            MenuItem::linkToCrud('Listado', 'fas fa-list', Alojamiento::class),
            MenuItem::linkToCrud('Reservas', 'fas fa-calendar', Reserva::class),
            
        ]);
        // yield MenuItem::linkToCrud('Alojamientos', 'fas fa-building', Alojamiento::class);
        // yield MenuItem::linkToCrud('Reservas', 'fas fa-calendar', Reserva::class);
        yield MenuItem::linkToCrud('Comodidades', 'fas fa-couch', Comodidad::class);
        yield MenuItem::linkToCrud('Tipos', 'fas fa-tags', Tipo::class);
        yield MenuItem::linkToLogout('Salir', 'fa fa-door-open');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
