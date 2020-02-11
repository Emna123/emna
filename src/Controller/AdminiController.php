<?php
namespace App\Controller;
use App\Entity\Admini;
use App\Entity\Superadmin;
use App\Form\AdminiType;
use App\Form\RechadminType;
use App\Repository\AdminiRepository;
use App\Repository\LivraisonRepository;
use App\Repository\PanierRepository;
use App\Repository\SuperadminRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class AdminiController extends AbstractController
{
    /**
     * @var AdminiRepository
     */
    private $repository;


    public function __construct(AdminiRepository $repository)
    {
        $this->repository=$repository;

    }


    /**
     *@route("/admin",name="admin")
     * @param AdminiRepository $repository
       * @param Request $request
     * @param LivraisonRepository $repository1
     * @param SuperadminRepository $repository2
 * @return Response
     */

    public function index(AdminiRepository $repository, Request $request, LivraisonRepository $repository1, SuperadminRepository $repository2):Response
    {
        $properties []=null;
        $super = $repository2->findAll();

        $pro = $repository1->findAll();
        $indice=0;
        foreach ($pro  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )

            {
                $indice= $indice+1;
            }

        }


        $form = $this->createForm(RechadminType::class);
        $c = $form->getData();
        if($form->handleRequest($request)->isSubmitted()) {
            $c = $form->getData();


            $proo = $repository->findAll();
            $n=-1;
            foreach($proo as $p)
            {
                $b=implode($c);
                $b=str_replace(' ','',$b);
                if($b)
                {
                if ((stristr(trim(strtolower ($b)), strtolower ($p->getNom()) ) || stristr(trim(strtolower ($b)), strtolower ($p->getPrenom()) )) || (stristr( strtolower ($p->getNom()) ,trim(strtolower ($b))) || stristr( strtolower ($p->getPrenom()),trim(strtolower ($b)) ))){

                    $n=$n+1;
                    $properties[$n] = $p ;

            }}
if($properties[0]==null){$properties=null;}
            }


            return $this->render('pages/admin.html.twig',['form'=>$form->createView(),'properties' => $properties,'pro' => $pro,'indice'=>$indice,'super'=>$super]) ;

        }

        $properties=$repository->findAll();










        return $this->render('pages/admin.html.twig',['form'=>$form->createView(),'properties' => $properties,'pro' => $pro,'indice'=>$indice,'super'=>$super]) ;

    }






    /**
     * @Route("/ajout",name="ajout")
     * @param Request $request
     * @param LivraisonRepository $repository1
     * @param SuperadminRepository $repository3

     * @return Response
     */
    public function ajout(Request $request,LivraisonRepository $repository1,SuperadminRepository $repository3
    ){
        $admini=new Admini();
        $super = $repository3->findAll();

        $form= $this->createForm(AdminiType::class,$admini);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($admini) ;
            $em->flush();


            $this->addFlash('success', 'Admin Ajouter');

            return $this->redirect($_SERVER['HTTP_REFERER']);

        }
        $pro = $repository1->findAll();
        $indice=0;
        foreach ($pro  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )
            {
                $indice= $indice+1;
            }

        }

        return $this->render('pages/new.html.twig',['admini' => $admini,'form'=>$form->createView(),'pro' => $pro,'indice'=>$indice,'super'=>$super]) ;

    }


    /**
     * @route("/delete/{id}",name="deleteadmi")
     * @param Admini $p
     * @return Response
     */

    public function delete(Admini  $p)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($p);
        $em->flush();

        $this->addFlash('success', 'Admin supprimer');


      return $this->redirect($_SERVER['HTTP_REFERER']);


    }




    /**
     * @Route("/admindetail/{id}",name="admindetail")
     * @param Admini $a
     * @param Request $request
     * @param LivraisonRepository $repository1
     * @param SuperadminRepository $repository3

     * @return Response
     */
public function detail(Admini $a,Request $request,LivraisonRepository $repository1,SuperadminRepository $repository3)
{    $super= $repository3->findAll();

    $form= $this->createForm(AdminiType::class,$a);
   $form->handleRequest($request);
   if($form->isSubmitted() && $form->isValid() ){

       $em = $this->getDoctrine()->getManager();

       $em->flush();

       $this->addFlash('success', 'Coordonnées Modifier');


       return $this->redirect($_SERVER['HTTP_REFERER']);
   }
    $pro = $repository1->findAll();
    $indice=0;
    foreach ($pro  as $k) {
        if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )
        {
            $indice= $indice+1;
        }

    }

    return $this->render('pages/create.html.twig',['a' =>$a,'form'=>$form->createView(),'pro' => $pro,'indice'=>$indice,'super'=>$super]) ;

}





}