<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Accounts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class AccountController  extends AbstractController {

/**
 * @Route("/", name="login")
 *  */
    public function loginPageView(SessionInterface $session) {
        if($session->get('account') !== null) {
            return $this->redirectToRoute("sites");
        }
        $message="";
        $db = $this->getDoctrine()->getRepository(Accounts::class);
        if(isset($_POST['submit'])) {
            if(preg_match("/^[a-zA-Z0-1-_]{1,20}$/", $_POST["login"]) && preg_match("/^[a-zA-Z0-9-_]{1,20}$/", $_POST["pass"])) {
                $account = $db->findOneBy(["login" => $_POST["login"], "pass" => $_POST["pass"]]);
                if($account != null) {
                    $session->set('account', $account->getLogin()); 
                    return $this->redirectToRoute("sites");
                }
                $message = "Konto o podanych danych nie istnieje.";
            } else {
                $message="Użyto nie dozwolonych znaków.";
            }
        }
        return $this->render('Account/login.html.twig', [
            'message' => $message,
        ]);
       
    }


    
/**
 * @Route("/logout", name="logout")
 *  */
    public function logOut(SessionInterface $session) {
        if($session->get('account') !== null) {
            $session->set('account', null);
            return $this->render('Account/login.html.twig', [
                'message' => "Wylogowano"
            ]); 
        }       
    }

}