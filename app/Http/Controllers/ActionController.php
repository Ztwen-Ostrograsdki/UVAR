<?php

namespace App\Http\Controllers;

use App\ModelsHelpers\ImageStores\Storer;
use App\Models\Action;
use App\Models\ShoppingAction;
use App\Traits\Validators\ActionsValidators;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    use ActionsValidators;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('actions.index');
    }

    public function getActions()
    {
        $actions = Action::where('id', '>', 0)->latest()->get();
        $totalBoughtByAction = [];
        foreach ($actions as $action) {
            $totalBoughtByAction[$action->id] = $action->totalBought();
        }
        return response()->json(['actions' => $actions, 'totalBoughtByAction' => $totalBoughtByAction]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $this->validateAction($request->all());

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()]);
        }
        else{
            $action = Action::create(['name' => $request->name, 'description' => $request->description, 'price' => (int)$request->price, 'total' => (int)$request->total]);

            if ($action) {
                if ($request->image !== "" &&  $request->image !== null) {
                    $storer = (new Storer($request->image, $action->id))->__ACTION_STORER();
                    if ($storer) {
                        return response()->json(['success' => "L'action {$action->name} a bien été créé"]);
                    }
                    else{
                        return response()->json(['success' => "L'action {$action->name} a bien été créé, mais une erreure s'est produite lors du stockage de l'image jointe"]);
                    }
                }
                else{
                    return response()->json(['success' => "L'action {$action->name} a bien été créé"]);
                }
            }

            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {

        $action = Action::find($id);
        if (!is_int($id) || !$action) {
            return abort(404, 'Page introuvable');
        }
        $oldName = Action::where('name', $request->name)->first();
        $storer = false;
        $make = false;

        if ($oldName && $oldName->id == $id) {
            $v = $this->validateAction($request->all(), 'name');
        }
        else{
            $v = $this->validateAction($request->all());
        }
        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()]);
        }
        if (!$action) {
            return abort(403, "Requête non autorisée");
        }
        if ($request->image !== "" &&  $request->image !== null) {
            $storer = (new Storer($request->image, $id))->__ACTION_STORER();
        }
        if ($storer) {
            $make = $action->update(['name' => $request->name, 'description' => $request->description, 'price' => $request->price, 'total' => $request->total]);
            if ($make) {
                return response()->json(['success' => "Mise à jour réussie!"]);
            }
        }
        else{
            return response()->json(["errors" => "Erreure de stockage de l'image"]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $action = Action::find($id);
        if ($action) {
            $alreadyBought = $action->buyers();
            if (count($alreadyBought) > 0) {
                return response()->json(['errors' => "Cette action a déjà des détenteurs, vous ne pouvez pas la supprimer! Veuillez essayez la procedure de forçage de suppression sécurisée"]);
            }
            $delete = $action->forceDelete();
            if ($delete) {
                return response()->json(['success' => $alreadyBought]);
            }
            else{
                return response()->json(['errors' => "Erreure lors de la suppression!"]);
            }
        }
        return response()->json(['errors' => "Requête inconnue, veuillez vérifier votre requête!"]);
        
    }
}
