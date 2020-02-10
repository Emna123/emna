<?php
namespace App\Controller;
use App\Repository\ArchiveprodRepository;
use App\Repository\CommandeRepository;
use App\Repository\LivraisonRepository;
use App\Repository\ProduitRepository;
use App\Repository\SuperadminRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PanierRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
class AccController extends AbstractController
{
    /**
     * @route("/acc",name="acc")
     * @param LivraisonRepository $repository1
     * @param ProduitRepository $repository2
     * @param SuperadminRepository $repository3
     * @param ArchiveprodRepository $repository4
     * @param UserRepository $repository5

     * @return Response
     */




    public function index(LivraisonRepository $repository1, ProduitRepository $repository2,SuperadminRepository $repository3,ArchiveprodRepository $repository4,UserRepository $repository5):Response
    {
        $pro = $repository1->findAll();
        $indice=0;
        foreach ($pro  as $k) {
            if ($k->getDateLivraison() == null ||date_format($k->getDateLivraison(), "YYYY-MM-DD") <= date('YYYY-MM-DD') && $k->getDateLivraison()!=null )

            {
                $indice++;
            }


        }
        $produit = $repository2->findAll();
        $archi = $repository4->findAll();


 $productsold=0;

$result=[];

foreach($produit as $m)
{
      $totale=0;
    foreach ($archi as $k) {

        if ($m->getId() == $k->getIdProd() && date_format($k->getDateCom(), "m/Y") == date("m/Y") ){

            $totale+=$k->getQntCom();
        }
        }


$productsold+=$totale;
    $result[]=['produit'=>$m,
    'quantite'=>$totale*100/$m->getQntInit()];
}
$profi=0;

        foreach ($archi as $k){
           if(date_format($k->getDateCom(), "Y") == date("Y")){
                $profi+=$k->getQntCom()*$k->getTotal();
            }
        }
            $super=$repository3->findAll();
        $cust = $repository5->findAll();

        return $this->render('pages/acc.html.twig',['pro' => $pro,'indice'=>$indice,'result'=>$result,'super'=>$super,'profi'=>$profi,'cust'=>sizeof($cust),'productsold'=>$productsold]);
    }



}