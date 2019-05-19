<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Changes;
use App\Entity\ChangesSiteChanges;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ChangeController extends AbstractController { 

    /** 
     * @Route("/changes", name="changes")
     * 
    */
    function viewAllChanges(SessionInterface $session) {
        if($session->get('account') !== null) {
            if(isset($_POST['change'])) {
                $change = new Changes();
                $change->setName($_POST['change']);
                $db = $this->getDoctrine()->getManager();
                $db->persist($change);
                $db->flush();
            }
            $changes = $this->getDoctrine()->getRepository(Changes::class)->findAll();
            return $this->render("Change/changes.html.twig", ["changes" => $changes]);
        } else {
            return $this->redirectToRoute("login");
        }
    }

    /** 
     * 
     * @Route("/changes/delete/{id}", name="deleteChange")
    */
    function deleteChange(SessionInterface $session, $id) {
        if($session !== null) {
            $change1 = $this->getDoctrine()->getRepository(ChangesSiteChanges::class)->findBy(["change_id" => $id]);
            $db1 = $this->getDoctrine()->getManager();
            foreach($change1 as $change) {

                $db1->remove($change);

            }
            $change = $this->getDOctrine()->getRepository(Changes::class)->find($id);
            $db = $this->getDoctrine()->getManager();
            $db->remove($change);
            $db->flush();
            return $this->redirectToRoute("changes");
        } else {
            return $this->redirectToRoute("login");
        }
    }

}

