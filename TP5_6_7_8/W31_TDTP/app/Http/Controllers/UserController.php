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
        return view('signin', ['message'=>$request->session()->get('message') ?? null]);
    }

    /**
     * Shows the signup page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup( Request $request )
    {
        return view('signup', ['message'=>$request->session()->get('message') ?? null]);
    }

    /**
     * Shows the formpassword page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formpassword( Request $request )
    {
        return view('formpassword', ['message'=>$request->session()->get('message') ?? null]);
    }

    /**
     * Shows the signout page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signout( Request $request )
    {
        $request->session()->flush();
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
        return view('account', ['message'=>$request->session()->get('message') ?? null], ['user'=>$request->session()->get('user')]);
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

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent
        if ( empty($input['login']) || empty($input['password']) )
        {
            return redirect()->route('signin')->with('message', "Some POST data are missing.");
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
                return redirect()->route('signin')->with('message', "Wrong login/password.");
            }
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            return redirect()->route('signin')->with('message', $e->getMessage());
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->exists())
            return redirect()->route('signin')->with('message', $e->getMessage());
        }

        // 3. On sauvegarde le login dans la session
        $request->session()->put('user', $login);

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

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent
        if ( empty($input['login']) || empty($input['password']) || empty($input['confirm']) )
        {
            return redirect('signup')->with('message', "Some POST data are missing.");
        }

        // 3. On sécurise les données reçues
        $login = htmlspecialchars($input['login']);
        $password = htmlspecialchars($input['password']);
        $confirm = htmlspecialchars($input['confirm']);

        // 4. On vérifie que les deux mots de passe correspondent
        if ( $password !== $confirm )
        {
            return redirect('signup')->with('message', "The two passwords differ.");
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
            return redirect('signup')->with('message', $e->getMessage());
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->create())
            return redirect('signup')->with('message', $e->getMessage());
        }

        // 4. On sollicite une redirection vers la page d'accueil
        return redirect('signin')->with('message', "Account created! Now, signin.");
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
        /******************************************************************************
         * Vérification de la session
        */

        // 1. On vérifie que l'utilisateur est connecté
        if ( empty($request->session()->get('user')) )
        {
            return redirect('signin');
        }

        // 2. On récupère le login dans une variable
        $login = $request->session()->get('user');

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent
        if ( empty($input['newpassword']) || empty($input['confirmpassword']) )
        {
            return redirect('admin/formpassword')->with('message', "Some POST data are missing.");
        }

        // 3. On sécurise les données reçues
        $newpassword = htmlspecialchars($input['newpassword']);
        $confirmpassword = htmlspecialchars($input['confirmpassword']);

        // 4. On s'assure que les 2 mots de passes sont identiques
        if ( $newpassword != $confirmpassword )
        {
            return redirect('admin/formpassword')->with('message', "Error: passwords are different.");
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
            return redirect('admin/formpassword')->with('message', $e->getMessage());
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->changePassword())
            return redirect('admin/formpassword')->with('message', $e->getMessage());
        }

        // 4. On sollicite une redirection vers la page du compte
        return redirect('account')->with('message', "Password successfully updated.");
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

        /******************************************************************************
         * Vérification de la session
         */

        // 1. On vérifie que l'utilisateur est connecté
        if ( empty($request->session()->get('user')) )
        {
            return redirect('signin');
        }

        // 2. On récupère le login dans une variable
        $login = $request->session()->get('user');

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
            return redirect('admin/account')->with('message', $e->getMessage());
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->create())
            return redirect('admin/account')->with('message', $e->getMessage());
        }

        // 3. On détruit la session
        $request->session()->flush();

        // 4. On crée une nouvelle session

        // 6. On sollicite une redirection vers la page d'accueil
        return redirect('signin')->with('message', "Account successfully deleted.");
    }
}
