<?php
namespace App\Controller;
use App\Entity\Archiveprod;
use App\Entity\Livraison;
use App\Entity\Useraccount;
use App\Entity\Panier;
use App\Entity\Qteproduit;
use App\Form\LivraisonType;
use App\Form\ProduitType;
use App\Form\RechadminType;
use App\Repository\ArchiveprodRepository;
use App\Repository\LivraisonRepository;
use App\Repository\SuperadminRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class ComController extends AbstractController
{
    /**
     * @var LivraisonRepository
     */
    private $repository;


    public function __construct(LivraisonRepository $repository)
    {
        $this->repository = $repository;

    }


    /**
 * @route("/com",name="com")
     * @param LivraisonRepository $repository
     * @param Request $request
     * @param SuperadminRepository $repository2
     * @param ArchiveprodRepository $repository3

     * @return Response
     */

    public function index(LivraisonRepository $repository, Request $request,SuperadminRepository $repository2,ArchiveprodRepository $repository3): Response
    {
        $properties [] = null;
        $form = $this->createForm(RechadminType::class);
        $c = $form->getData();
        $pro = $repository->findAll();
        $super = $repository2->findAll();

        $indice=0;
        foreach ($pro  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )

            {
                $indice= $indice+1;
            }

        }

        if ($form->handleRequest($request)->isSubmitted()) {
            $c = $form->getData();



            $n = -1;
            foreach ($pro as $p) {
                $b = implode($c);
                $b = str_replace(' ', '', $b);
                if ($b && ($p->date_livraison !=null))
                {
                    if ((stristr(trim(strtolower($b)), strtolower(str_replace(' ','',$p->getIdcommande()->getIdpanier()->getIduser()->getEmail()))) ||(stristr(trim(strtolower($b)),  '#'.(string)$p->getId())) || stristr(trim(strtolower($b)),  date_format($p->getIdcommande()->getDate(), "d-m-Y")
                            ) || stristr(trim(strtolower($b)),date_format($p->getDateLivraison(), "d/m/Y")
                            )) || (stristr(strtolower(str_replace(' ','',$p->getIdcommande()->getIdpanier()->getIduser()->getEmail())), trim(strtolower($b))) || stristr(  '#'.(string)$p->getId(), trim(strtolower($b))) ||(stristr( date_format($p->getIdcommande()->getDate(), "d-m-Y"), trim(strtolower($b))))||(stristr( date_format($p->getIdcommande()->getDate(), "d/m/Y"), trim(strtolower($b)))))) {

                        $n = $n + 1;
                        $properties[$n] = $p;

                    }
                }else
                    {if ($b) {
                    if ((stristr(trim(strtolower($b)), strtolower(str_replace(' ','',$p->getIdcommande()->getIdpanier()->getIduser()->getEmail()))) ||(stristr(trim(strtolower($b)),  '#'.(string)$p->getId())) || stristr(trim(strtolower($b)),  date_format($p->getIdcommande()->getDate(), "d-m-Y")
                    ) ) || (stristr(strtolower(str_replace(' ','',$p->getIdcommande()->getIdpanier()->getIduser()->getEmail())), trim(strtolower($b))) || stristr(  '#'.(string)$p->getId(), trim(strtolower($b))) ||(stristr( date_format($p->getIdcommande()->getDate(), "d-m-Y"), trim(strtolower($b)))))) {

                        $n = $n + 1;
                        $properties[$n] = $p;

                    }
                }}
                if ($properties[0] == null) {
                    $properties = null;
                }
            }


            return $this->render('pages/com.html.twig', ['form' => $form->createView(), 'properties' => $properties,'pro' => $pro,'indice'=>$indice,'super'=>$super]);

        }
        $properties = $repository->findAll();
        $archi = $repository3->findAll();

foreach ( $properties  as $p)
{
    $stat=$repository3->findByExampleField($p->getId());
    if($stat==null){

        foreach($p->getIdcommande()->getIdpanier()->getQntAcom() as $a)
        {        $em = $this->getDoctrine()->getManager();

            $prod=new Archiveprod();
            $prod->setIdCom($p->getId());
            $prod->setDateCom($p->getIdcommande()->getDate());
            $prod->setQntCom($a->getQteproduit());
            $prod->setIdProd($a->getIdproduit()->getId());
            $prod->setTotal($a->getIdproduit()->getPrix()*$a->getQteproduit());
            $em->persist($prod) ;
            $em->flush();

        }
    }

}

        return $this->render('pages/com.html.twig', ['form' => $form->createView(), 'properties' => $properties,'pro' => $pro,'indice'=>$indice,'super'=>$super]);
    }






































    /**
     * @Route("/comdetail/{id}",name="comdetail")
     * @param Livraison $a
     * @param Request $request
     * @param LivraisonRepository $repository
     * @param SuperadminRepository $repository3

     * @return Response
     */
    public function detail(Livraison $a, Request $request, LivraisonRepository $repository,SuperadminRepository $repository3)
    {$properties = $repository->findAll();
        $super = $repository3->findAll();
        $indice=0;
        foreach ($properties  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )
            {
                $indice= $indice+1;
            }

        }
        $form = $this->createForm(LivraisonType::class, $a);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();


            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        return $this->render('pages/detailcom.html.twig', ['a' => $a, 'form' => $form->createView(),'pro' => $properties,'indice'=>$indice,'super'=>$super]);

    }


    /**
     * @Route("/fact/{id}",name="fact")
     * @param Livraison $a
     * @param Request $request
     * @return Response
     */
    public function detailfact(Livraison $a, Request $request)
    {

        return $this->render('pages/facture.html.twig', ['a' => $a]);

    }

  /**
     * @route("/deletecom/{id}",name="deletecom")
     * @param Livraison $p
   * @return Response
     */

    public function deletecom(Livraison $p)
    {
        $em = $this->getDoctrine()->getManager();

        foreach ( $p->getIdcommande()->getIdpanier()->getQntAcom() as $q) {

            $q->getIdproduit()->removeIdProd($q);
            $p->getIdcommande()->getIdpanier()->removeQntaAcom($q);
        }
        $p->getIdcommande()->getIdpanier()->getIduser()->removeIduser($p->getIdcommande()->getIdpanier());
$em->remove($p->getIdcommande());
$em->remove($p);
        $em->flush();


        echo "<script>
         alert('Produit Supprimer')

         </script>";
        return $this->redirect($_SERVER['HTTP_REFERER']);


    }






}