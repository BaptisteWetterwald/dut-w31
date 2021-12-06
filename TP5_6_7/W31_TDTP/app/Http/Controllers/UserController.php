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
        return redirect()->route('signin');
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
        $input = $request->all();

        unset($_SESSION['message']);

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent
        if ( empty($input['login']) || empty($input['password']) )
        {
            $_SESSION['message'] = "Some POST data are missing.";
            return redirect()->route('signin');
        }

        // 3. On sécurise les données reçues
        $login = htmlspecialchars($input['login']);
        $password = htmlspecialchars($input['password']);

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
                return redirect()->route('signin');
            }
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $_SESSION['message'] = $e->getMessage();
            return redirect()->route('signin');
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->exists())
            $_SESSION['message'] = $e->getMessage();
            return redirect()->route('signin');
        }

        // 3. On sauvegarde le login dans la session
        $_SESSION['user'] = $login;

        // 4. On sollicite une redirection vers la page du compte
        return redirect()->route('account');
    }

    /**
     * Shows the adduser page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adduser( Request $request )
    {
        /******************************************************************************
         * Initialisation.
         */
        $input = $request->all();

        unset($_SESSION['message']);

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent
        if ( empty($input['login']) || empty($input['password']) || empty($input['confirm']) )
        {
            $_SESSION['message'] = "Some POST data are missing.";
            return redirect('signup');
        }

        // 3. On sécurise les données reçues
        $login = htmlspecialchars($input['login']);
        $password = htmlspecialchars($input['password']);
        $confirm = htmlspecialchars($input['confirm']);

        // 4. On vérifie que les deux mots de passe correspondent
        if ( $password !== $confirm )
        {
            $_SESSION['message'] = "The two passwords differ.";
            return redirect('signup');
        }

        /******************************************************************************
         * Ajout de l'utilisateur
         */

        // 1. On crée l'utilisateur avec les identifiants passés en POST
        $user = new MyUser($login,$password);

        // 2. On crée l'utilisateur dans la BDD
        try {
            $user->create();
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $_SESSION['message'] = $e->getMessage();
            return redirect('signup');
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->create())
            $_SESSION['message'] = $e->getMessage();
            return redirect('signup');
        }

        // 3. On indique que le compte a bien été créé
        $_SESSION['message'] = "Account created! Now, signin.";

        // 4. On sollicite une redirection vers la page d'accueil
        return redirect('signin');
    }

    /**
     * Shows the changepassword page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changepassword( Request $request )
    {
        /******************************************************************************
         * Initialisation.
        */
        $input = $request->all();
        unset($_SESSION['message']);

        /******************************************************************************
         * Vérification de la session
        */

        // 1. On vérifie que l'utilisateur est connecté
        if ( empty($_SESSION['user']) )
        {
            return redirect('signin');
        }

        // 2. On récupère le login dans une variable
        $login = $_SESSION['user'];

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent
        if ( empty($input['newpassword']) || empty($input['confirmpassword']) )
        {
            $_SESSION['message'] = "Some POST data are missing.";
            return redirect('admin/formpassword');
        }

        // 3. On sécurise les données reçues
        $newpassword = htmlspecialchars($input['newpassword']);
        $confirmpassword = htmlspecialchars($input['confirmpassword']);

        // 4. On s'assure que les 2 mots de passes sont identiques
        if ( $newpassword != $confirmpassword )
        {
            $_SESSION['message'] = "Error: passwords are different.";
            return redirect('admin/formpassword');
        }

        /******************************************************************************
         * Changement du mot de passe
         */

        // 1. On crée l'utilisateur avec les identifiants passés en POST
        $user = new MyUser($login);

        // 2. On change le mot de passe de l'utilisateur
        try {
            $user->changePassword($newpassword);
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $_SESSION['message'] = $e->getMessage();
            return redirect('admin/formpassword');
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->changePassword())
            $_SESSION['message'] = $e->getMessage();
            return redirect('admin/formpassword');
        }

        // 3. On indique que le mot de passe a bien été modifié
        $_SESSION['message'] = "Password successfully updated.";

        // 4. On sollicite une redirection vers la page du compte
        return redirect('account');
    }

    /**
     * Shows the deleteuser page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteuser( Request $request )
    {
        /******************************************************************************
         * Initialisation.
         */
        $input = $request->all();

        unset($_SESSION['message']);

        /******************************************************************************
         * Vérification de la session
         */

        // 1. On vérifie que l'utilisateur est connecté
        if ( empty($_SESSION['user']) )
        {
            return redirect('signin');
        }

        // 2. On récupère le login dans une variable
        $login = $_SESSION['user'];

        /******************************************************************************
         * Suppression de l'utilisateur
         */

        // 1. On crée l'utilisateur avec les identifiants passés en POST
        $user = new MyUser($login);

        // 2. On détruit l'utilisateur dans la BDD
        try {
            $user->delete();
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $_SESSION['message'] = $e->getMessage();
            return redirect('admin/account');
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->create())
            $_SESSION['message'] = $e->getMessage();
            return redirect('admin/account');
        }

        // 3. On détruit la session
        session_destroy();

        // 4. On crée une nouvelle session

        // 5. On indique que le compte a bien été supprimé
        $_SESSION['message'] = "Account successfully deleted.";

        // 6. On sollicite une redirection vers la page d'accueil
        return redirect('signin');
    }
}
