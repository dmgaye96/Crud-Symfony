<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employe;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Serices;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Employe::class);
        $employes = $repo->findAll();
        return $this->render('service/index.html.twig', [ 'controller_name' => 'ServiceController','employes' => $employes]);
    }

    /**
     * @Route("/", name="home")
     */

    public function home() { return $this->render('service/home.html.twig');}

    /**
     * @Route("/service/new" ,name ="ajouter")
     * @Route("/service/{id}/edit",name="edit_employe")
     */
    public function form(Employe $employes = null, Request $request, ObjectManager $manager)
    {
        if (!$employes) {

            $employes =new Employe();
        }

        $form = $this->createFormBuilder($employes)
            ->add('matricule')
            ->add('nomcomplet')
            ->add('datenaissance', DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('salaire')
            ->add('serices', EntityType::class, ['class' => Serices::class, 'choice_label' => 'libelle'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($employes);
            $manager->flush();
            return $this->redirectToRoute('service');
        }
        return $this->render('service/new.htm.twig', ['formEmploye' => $form->createView(),
        'editMode' => $employes->getId() !==null 
        
        ]);
    }

    /**
     *@Route("/service/detele/{id}",name="delete")
     */
    public function delet($id)
    {    
        $repo=$this->getDoctrine()->getRepository(Employe::class);
        $employe =$repo->find($id);
        return $this->render('/service/delete.html.twig', [
            'employe' => $employe
        ]);
    }


     /**
     *@Route("/service/{id}",name="deletecofirme")
     */
    public function delete(Employe $employe, ObjectManager $manager)
    {    
        $manager->remove($employe);
        $manager->flush();
        return $this->redirectToRoute('service');
    } 
}
