<?php
namespace App\Controller;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Form\RechadminType;
use App\Repository\PanierRepository;
use App\Repository\LivraisonRepository;

use App\Repository\ProduitRepository;
use App\Repository\SuperadminRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class ProduitController extends AbstractController
{
    /**
     * @var ProduitRepository
     */
    private $repository;


    public function __construct(ProduitRepository $repository)
    {
        $this->repository = $repository;

    }


    /**
     * @route("/pro",name="pro")
     * @param ProduitRepository $repository
        * @param LivraisonRepository $repository1
     * @param SuperadminRepository $repository3

     * @param Request $request
 * @return Response
     */

    public function index(ProduitRepository $repository, Request $request,LivraisonRepository $repository1,SuperadminRepository $repository3): Response
    {
        $properties [] = null;
        $pro = $repository1->findAll();
        $super = $repository3->findAll();

        $indice=0;
        foreach ($pro  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )
            {
                $indice= $indice+1;
            }

        }
        $form = $this->createForm(RechadminType::class);
        $c = $form->getData();
        if ($form->handleRequest($request)->isSubmitted()) {
            $c = $form->getData();


            $proo = $repository->findAll();
            $n = -1;
            foreach ($proo as $p) {
                $b = implode($c);
                $b = str_replace(' ', '', $b);
                if ($b) {
                    if ((stristr(trim(strtolower($b)), strtolower(str_replace(' ','',$p->getNom()))) ||(stristr(trim(strtolower($b)),  '#'.(string)$p->getId())) || stristr(trim(strtolower($b)), '#'.(string)$p->getPrix())) || (stristr(strtolower(str_replace(' ','',$p->getNom())), trim(strtolower($b))) || stristr((string)$p->getPrix(), trim(strtolower($b))) ||(stristr((string)$p->getPrix(), trim(strtolower($b)))))) {

                        $n = $n + 1;
                        $properties[$n] = $p;

                    }
                }
                if ($properties[0] == null) {
                    $properties = null;
                }
            }


            return $this->render('pages/produit.html.twig', ['form' => $form->createView(), 'properties' => $properties,'pro' => $pro,'indice'=>$indice,'super'=>$super]);

        }

        $properties = $repository->findAll();
        return $this->render('pages/produit.html.twig', ['form' => $form->createView(), 'properties' => $properties,'pro' => $pro,'indice'=>$indice,'super'=>$super]);

    }




    /**
     * @Route("/ajoutprod",name="ajoutprod")
     * @param Request $request
     * @param LivraisonRepository $repository1
     * @param SuperadminRepository $repository3

     * @return Response
     */
    public function ajout(Request $request,LivraisonRepository $repository1,SuperadminRepository $repository3)
    {
        $pro = $repository1->findAll();
        $super = $repository3->findAll();

        $indice=0;
        foreach ($pro  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )
            {
                $indice= $indice+1;
            }

        }
        $produit=new Produit();
        $form= $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit) ;
            $em->flush();

            $this->addFlash('success', 'Produit Ajouter');

            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        return $this->render('pages/newprod.html.twig',['produit' => $produit,'form'=>$form->createView(),'pro' => $pro,'indice'=>$indice,'super'=>$super]) ;

    }


    /**
     * @route("/deleteprod/{id}",name="deleteprod")
     * @param Produit $p
     * @return Response
     */

    public function delete( Produit  $p)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($p);
        $em->flush();

        $this->addFlash('success', 'Produit Supprimer');


        return $this->redirect($_SERVER['HTTP_REFERER']);


    }




    /**
     * @Route("/proddetail/{id}",name="proddetail")
     * @param Produit $a
     * @param Request $request
     * @param LivraisonRepository $repository1
     * @param SuperadminRepository $repository3

     * @return Response
     */
    public function detail(Produit $a,Request $request,LivraisonRepository $repository1,SuperadminRepository $repository3)
    {
        $pro = $repository1->findAll();
        $super = $repository3->findAll();

        $indice=0;


        foreach ($pro  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )
            {
                $indice= $indice+1;
            }}
        $form= $this->createForm(ProduitType::class,$a);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Produit Modifier');

            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        return $this->render('pages/createprod.html.twig',['a' =>$a,'form'=>$form->createView(),'pro' => $pro,'indice'=>$indice,'super'=>$super]) ;

    }









}