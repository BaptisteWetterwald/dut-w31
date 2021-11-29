<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/******************************************************************************
 * Chargement du model
 */

use App\Models\MyUser;

class UserController extends Controller
{
    /**
     * Shows the signin page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin( Request $request )
    {
        return view('signin', ['message'=>$_SESSION['message'] ?? null]);
    }

    /**
     * Shows the signup page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup( Request $request )
    {
        return view('signup', ['message'=>$_SESSION['message'] ?? null]);
    }

    /**
     * Shows the formpassword page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formpassword( Request $request )
    {
        return view('formpassword', ['message'=>$_SESSION['message'] ?? null]);
    }

    /**
     * Shows the signout page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signout( Request $request )
    {
        session_destroy();
        return redirect('signin');
    }

    /**
     * Shows the account page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function account( Request $request )
    {
        return view('account', ['message'=>$_SESSION['message'] ?? null], ['user'=>$_SESSION['user']]);
    }

    /**
     * Shows the auth page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate( Request $request )
    {
        /******************************************************************************
         * Initialisation.
         */


        unset($_SESSION['message']);

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent
        if ( empty($_POST['login']) || empty($_POST['password']) )
        {
            $_SESSION['message'] = "Some POST data are missing.";
            header('Location: signin');
            exit();
        }

        // 3. On sécurise les données reçues
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);

        

        /******************************************************************************
         * Authentification
         */

        // 1. On crée l'utilisateur avec les identifiants passés en POST
        $user = new MyUser($login,$password);

        // 2. On vérifie qu'il existe dans la BDD
        try {
            if ( !$user->exists() )
            {
                $_SESSION['message'] = 'Wrong login/password.';
                header('Location: signin');
                exit();
            }
        }
        catch (PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $_SESSION['message'] = $e->getMessage();
            header('Location: signin');
            exit();
        }
        catch (Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->exists())
            $_SESSION['message'] = $e->getMessage();
            header('Location: signin');
            exit();
        }

        // 3. On sauvegarde le login dans la session
        $_SESSION['user'] = $login;

        // 4. On sollicite une redirection vers la page du compte
        header('Location: admin/account');
        exit();
    }
}
