<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/******************************************************************************
 * Chargement du model
 */

use App\Models\UserEloquent;

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

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 1. On vérifie que la méthode HTTP utilisée est bien POST

        // 2. On vérifie que les données attendues existent

        if ( !$request->filled(['login', 'password']) )
            return redirect()->route('signin')->with('error','Some POST data are missing.');

        /******************************************************************************
         * Authentification
         */

        // 1. On crée l'utilisateur avec les identifiants passés en POST
        //$user = new MyUser($login, $password);

        // 2. On vérifie qu'il existe dans la BDD
        try {
            $user = UserEloquent::where('user', $request->login)->firstOrFail();
            // On vérifie que les mdp sont les mêmes
            $hashedPassword = $user->password;
            if (!Hash::check($request->password, $hashedPassword))
                return redirect()->route('signin')->with('message', "Wrong login/password.");
            // 3. On sauvegarde le login dans la session
            $request->session()->put('user', $user);
        }
        catch (ModelNotFoundException $e)
        {
            return redirect()->route('signin')->with('message', $e->getMessage());
        }
        catch (\PDOException $e) 
        {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            return redirect()->route('signin')->with('message', $e->getMessage());
        }
        catch (\Exception $e) 
        {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->exists())
            return redirect()->route('signin')->with('message', $e->getMessage());
        }

        

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
        //$user = new MyUser($login,$password);

        // 2. On crée l'utilisateur dans la BDD
        try {
            $user = new UserEloquent;
            $user->user = $login;
            $user->password = Hash::make($password);
            $user->save();
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            return redirect('signup')->with('message', $e->getMessage());
        }

        catch (\QueryException $e) {
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
        if ( !$request->session()->has('user') )
        {
            return redirect('signin');
        }

        // 2. On récupère le login dans une variable
        $user = $request->session()->get('user');

        /******************************************************************************
         * Traitement des données de la requête
         */

        // 2. On vérifie que les données attendues existent
        if ( !$request->filled(['newpassword', 'confirmpassword']))
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
        //$user = new MyUser($login);


        // 2. On change le mot de passe de l'utilisateur
        try {
            //$user = UserEloquent::where('user', $login)->firstOrFail();
            $user->password = Hash::make($newpassword);
            $user->save();
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
        return redirect('admin/account')->with('message', "Password successfully updated.");
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
        if ( !$request->session()->has('user') )
        {
            return redirect('signin');
        }

        // 2. On récupère le login dans une variable
        $user = $request->session()->get('user');

        /******************************************************************************
         * Suppression de l'utilisateur
         */

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
