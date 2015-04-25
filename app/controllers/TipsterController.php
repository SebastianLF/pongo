<?php

class TipsterController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $regles = array(
            'name_tipster' => 'required|max:30|unique:tipsters,name,NULL,id,user_id,'.$this->currentUser.',deleted_at,NULL',
            'suivi_tipster' => 'required|in:n,b',
            'indice_tipster' => 'required|in:3,5,10',
            'amount_tipster' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        );
        $messages = array(
            'name_tipster.required' => 'Un nom est nécéssaire',
            'name_tipster.max' => 'Nom trop long, 30 caracteres maximum',
            'name_tipster.unique' => 'Ce nom existe deja',
            'suivi_tipster.required' => "Un type de suvi est nécéssaire",
            'suivi_tipster.alpha' => "le type de suivi ne doit comporter que des lettres",
            'indice_tipster.required' => 'Vous devez entrer un indice.',
            'indice_tipster.in' => 'Entrez un indice valide',
            'amount_tipster.required' => 'Vous devez entrer un montant par indice.',
            'amount_tipster.regex' => "l'unité de mise doit etre un nombre. Si vous rentrez un nombre decimal, remplacez la virgule par un point ex: 45.78",

        );
        $validator = Validator::make(Input::all(), $regles, $messages);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {
            $name = Input::get('name_tipster');
            $stakeindicator = Input::get('indice_tipster');
            $stakeamount = Input::get('amount_tipster');
            $followtype = Input::get('suivi_tipster');

            /*crée le tipster dans la table tipsters (create() fonctionne que si on a renseigné
                fillable ou guarded dans le modele*/
            $tipster = new Tipster(array(
                'name' => $name,
                'indice_unite' => $stakeindicator,
                'montant_par_unite' => $stakeamount,
                'followtype' => $followtype,
            ));

            $mtunitelogs = new MtUniteLogs(array(
                'montant_par_unite' => $stakeamount,
                'followtype' => $followtype,
            ));

            $followtypelogs = new FollowtypeLogs(array(
                'followtype' => $followtype
            ));

            // enregistrement du tipster.
            $tipsterfinal = $this->currentUser->tipsters()->save($tipster);

            // creation d'un log montant unité.
            $tipsterfinal->mtUniteLogs()->save($mtunitelogs);

            // creation d'un log montant unité.
            $tipsterfinal->FollowtypeLogs()->save($followtypelogs);

            /* données qui doivent etre traitées par le callback ajax */
            return Response::json(array(
                'success' => true,
                'tipster' => $tipsterfinal,
            ));
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    public function update($id)
    {

        $regles = array(
            'nameTipsterEditInput' => 'required|max:30|unique:tipsters,name,' . $id . ',id,user_id,' . $this->currentUserId . ',deleted_at,NULL',
            'indiceTipsterEditSelect' => 'required|in:3,5,10',
            'mtTipsterEditInput' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'suiviTipsterEditSelect' => 'required|in:n,b',
        );
        $messages = array(
            'nameTipsterEditInput.required' => 'Un nom est nécéssaire',
            'nameTipsterEditInput.max' => 'Nom trop long, 30 caracteres maximum',
            'nameTipsterEditInput.unique' => 'Ce nom existe deja',
            'indiceTipsterEditSelect.required' => 'Un indice de confiance est nécéssaire',
            'indiceTipsterEditSelect.in' => 'L\'indice doit etre de 3,5 ou 10',
            'mtTipsterEditInput.required' => 'Une unité de mise est nécéssaire',
            'mtTipsterEditInput.regex' => "le montant par unité doit etre de type 0.00 ou 0",
            'suiviTipsterEditSelect.required' => "Un type de suvi est nécéssaire",
            'suiviTipsterEditSelect.in' => 'Le suivi doit etre normal ou à blanc'
        );
        $validator = Validator::make(Input::all(), $regles, $messages);
        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {
            // récuperation des entrées
            $name = Input::get('nameTipsterEditInput');
            $stakeindicator = Input::get('indiceTipsterEditSelect');
            $stakeamount = Input::get('mtTipsterEditInput');
            $followtype = Input::get('suiviTipsterEditSelect');

            // trouver le tipster
            $tipsterfinal = Tipster::find($id);

            // gestion du montant_par_unite
            // creation d'un nouveau montant_par_unite
            $mtunitelogs = new MtUniteLogs(array(
                'montant_par_unite' => $stakeamount,
            ));

            // uniquement si la nouvelle valeur est differente de celle du tipster actuellement.
            if ($tipsterfinal->montant_par_unite != $stakeamount) {
                // creation d'un nouveau mt unite logs
                $tipsterfinal->mtUniteLogs()->save($mtunitelogs);
            }

            // creation d'un nouveau log de type de suivi.
            $followtypelogs = new FollowtypeLogs(array(
                'followtype' => $followtype,
            ));

            // uniquement si la nouvelle valeur est differente de celle du tipster actuellement.
            if ($tipsterfinal->followtype != $followtype) {
                // creation d'un nouveau followtype log
                $tipsterfinal->followtypeLogs()->save($followtypelogs);
            }


            // mis a jour du tipster apres toutes les gestions effectuées.
            Tipster::where('id', '=', $id)->update(array('name' => $name, 'indice_unite' => $stakeindicator, 'montant_par_unite' => $stakeamount, 'followtype' => $followtype));

            return Response::json(array(
                'success' => true,
                'tipster' => $tipsterfinal,
            ));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */

    public function destroy($id)
    {
        $tipster = Tipster::find($id);
        // si il y a un pari ou plus en cours associé a ce tipster, il faut d'abord les supprimer.
        if($tipster->enCoursParis()->count() >= 1){
            return Response::json(array(
                'success' => 0,
                'tipster' => $tipster
            ));
        }else{
            $tipster->delete();
            return Response::json(array(
                'success' => 1,
                'tipster' => $tipster
            ));
        }
    }

    public function mtUniteLogs()
    {

        $id = Input::get('id');
        $tipster = Tipster::find($id);
        $mtunitelogs = $tipster->mtUniteLogs()->lists('created_at', 'montant_par_unite');
        //$mtunitelogs->offsetSet(0, array('devise' => $devise));

        return $mtunitelogs;
    }


}
