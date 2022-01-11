<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Recipe;


class RecipeController extends Controller
{
    /**
     * Shows the basic page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formRecipe( Request $request )
    {
        return view('formRecipe', ['message'=>$request->session()->get('message') ?? null]);
    }

    public function addRecipe( Request $request )
    {
        /******************************************************************************
         * Initialisation.
         */
        $input = $request->all();

        if ( !$request->filled(['name', 'timetoprepare', 'ingredients', 'instructions']) )
            return redirect()->route('formRecipe')->with('error','Some POST data are missing.');

        try {
            $user = $request->session()->get('user');
            $recipe = new Recipe;
            $recipe->creator_id = $user->user_id;
            $recipe->name = $input['name'];
            $recipe->timetoprepare = $input['timetoprepare'];
            $recipe->ingredients = $input['ingredients'];
            $recipe->instructions = $input['instructions'];

            $recipe->save();
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            return redirect('formRecipe')->with('message', $e->getMessage());
        }

        catch (\QueryException $e) {
            return redirect('formRecipe')->with('message', $e->getMessage());
        }

        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->create())
            return redirect('formRecipe')->with('message', $e->getMessage());
        }

        // 4. On sollicite une redirection vers la page d'accueil
        return redirect('account')->with('message', "Recipe created!");
    }
}
