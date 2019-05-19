<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Sites;
use App\Entity\Changes;
use App\Entity\SiteChanges;
use App\Entity\ChangesSiteChanges;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SiteController extends AbstractController {



/**
 * @Route("/site/add", name="addNewSite")
 *  */
function addNewSite(SessionInterface $session) {
  if($session->get('account') !== null) {
    if(isset($_POST["submit"])) {
      if(strlen($_POST["company"]) >= 3  && strlen($_POST["company_url"]) >= 3) {
        $site = new Sites();
        $site->setName($_POST["company"]);
        $site->setUrl($_POST["company_url"]);
        $site->setMail($_POST["company_mail"]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($site);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return $this->redirectToRoute("sites");

      }
    }
  
    return $this->render("site/addNewSite.html.twig", []);
  } else {
   return $this->redirectToRoute("login");
  }
}



    /**
     * @Route("/sites", name="sites")
     *  */
    function viewAllSites(SessionInterface $session) {
        if($session->get('account') !== null) {
            $en = $this->getDoctrine()->getRepository(Sites::class);
            $sites = $en->findAll();
            return $this->render("site/sites.html.twig", ["sites" => $sites, "account" => $session->get('account')]);
        } else {
             return $this->redirectToRoute("login");
        }
    }

/**
 * @Route("/site/{site}", name="selectedSite")
 *  */
function viewSelectedSite(SessionInterface $session, $site) {
  if($session->get('account') !== null) {
    $en = $this->getDoctrine()->getRepository(Sites::class);
    $sites = $en->findOneBy(['site_id' => $site ]);

    $en1 = $this->getDoctrine()->getRepository(SiteChanges::class);
    //$changes = $en1->findAll();
    $changes = $en1->findBy(['site_id' => $site ]);
    //echo "<script>console.log('".var_dump($changes)."')</script>";
    return $this->render("site/selectedSite.html.twig", ["site" => $sites, "changes" => $changes]);
  } else {
     return $this->redirectToRoute("login");
  }
}

/** 
 * @Route("/sitechanges/{site}/add", name="addChangesOnSite")
*/
function addChangesOnSite(SessionInterface $session, $site) {
  if($session->get('account') !== null) {
    if(isset($_POST['submit']) && !empty($_POST['changesarray'])) {
      $en = $this->getDoctrine()->getRepository(Sites::class)->findOneBy(["name" => $site]);
      
      $sitechanges = new SiteChanges;
      $sitechanges->setSiteId($en);
      $date1 = date_parse($_POST['forDate']);
      $date2 = $date1["year"]."-".$date1["month"]."-".$date1["day"];
      $sitechanges->setChangeDate(date($date2));
      $en2 = $this->getDoctrine()->getManager();
      $en2->persist($sitechanges);
      $en2->flush();
 
      $changesOnSite = $_POST['changesarray'];
      for($i=0; $i < count($changesOnSite); $i++){
        $change1 = new ChangesSiteChanges;
        $change1->setSiteChangesId($sitechanges);
            $en3 = $this->getDoctrine()->getRepository(Changes::class)->findOneBy(["change_id" => $changesOnSite[$i]]);
        $change1->setChangeId($en3);
        $repository2 = $this->getDoctrine()->getManager();
        $repository2->persist($change1);
        $repository2->flush();
      } 
       return $this->redirectToRoute("sites"); 
    }
    $repository = $this->getDoctrine()->getRepository(Changes::class);
    $changes = $repository->findAll();
    return $this->render("site/addchangesOnSite.html.twig", ["changes" => $changes, "site" => $site]);

  } else {
    return $this->redirectToRoute("login");
  }
}

/**
 * @Route("/sitechanges/{site}", name="viewChangesOnSite")
 */
function viewChangesOnSite(SessionInterface $session, $site) {
  if($session->get('account') !== null) {
    $repository = $this->getDoctrine()->getRepository(ChangesSiteChanges::class);
    $changes = $repository->findBy(["site_changes_id" => $site]);

    return $this->render("site/changesOnSite.html.twig", ["changes" => $changes]);
  } else {
    return $this->redirectToRoute("login");
  }
}

/** 
 * @Route("/sites/delete/{site}", name="siteDelete")
*/
function deleteChangesOnSite(SessionInterface $session, $site) {
  if($session->get('account') !== null) {
    $changesOnsite = $this->getDoctrine()->getRepository(ChangesSiteChanges::class)->findBy(["site_changes_id" => $site]);
    $db = $this->getDoctrine()->getManager();
    foreach($changesOnsite as $change) {
      $db->remove($change);
      $db->flush();
    }
    $change = $this->getDoctrine()->getRepository(SiteChanges::class)->findOneBy(["site_changes_id" => $site]);
    $db->remove($change);
    $db->flush();

    return $this->redirectToRoute("sites");

  } else {
    return $this->redirectToRoute("login");
  }

}

}