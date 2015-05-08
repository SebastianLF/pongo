<?php
/* controller corresponding to dashboard page */

use Carbon\Carbon;

class DashboardController extends BaseController {

    protected $types_resultat = [ 1 => 'Gagné',2 => 'Perdu',3 => '1/2 Gagné',4 => '1/2 Perdu',5 => 'Remboursé'];
	

	public function __construct(){
        parent::__construct();
		$this->beforeFilter('auth');

	}

	public function showDashboard()
	{
        // premiere connexion au compte
        if( $this->currentUser->devise == 'non' ){
            $devisearray = Devise::all();
        }else{
            $devisearray = '';
        }

        // donnees lors du chargement de la page dashboard
            $dt = Carbon::now();
            return View::make('pages/dashboard', array(
                    'dt' => $dt,
                    //$devisearray ne sert que pour la boite modal affichée pour la premiere connexion
                    'devisearray' => isset($devisearray) ? $devisearray : '',
                )
            );
	}

    public function postDevise(){

            $devise = Devise::find(Input::get('devise_select_input'));
            $this->currentUser->devise = $devise->sigle;
            $this->currentUser->save();
            return Redirect::to('dashboard');
    }


	public function getTipsters(){
		$tipsters = $this->currentUser->tipsters;
		return $tipsters;
	}

	public function showTipsters(){
		if(Request::ajax()){
			;
		}
	}
    
	public function showCurrentBets(){
		$currentbets = $this->currentUser->currentBets()->orderBy('combonum','desc')->get();
		return $currentbets;
	}

    public function showParisEnCours(){
	    $parisencours = $this->currentUser->enCoursParis()->with('selections.equipe1','selections.equipe2','selections.competition','selections.sport','selections.typePari','tipster','compte.bookmaker')->where('pari_long_terme','0')->where('pari_abcd','0')->orderBy('numero_pari','desc')->paginate(5);
        return $parisencours;
    }

    public function showParisLongTerme(){
        $parislongterme = $this->currentUser->enCoursParis()->with('selections.equipe1','selections.equipe2','selections.competition','selections.sport','selections.typePari','tipster','compte.bookmaker')->where('pari_long_terme','1')->paginate(5);
        return $parislongterme;
    }

    public function showRecaps(){
        $recaps = $this->currentUser->recaps()->with('tipster')->orderBy('annee','desc')->orderBy('mois','desc')->orderBy('tipster_id','desc')->orderBy('followtype','desc')->get();
        //$view = View::make('recaps.recaps', array( 'user' => $this->user, 'recaps' => $recaps ));
        Clockwork::info($recaps);
        return Response::json($recaps);
    }

    public function itemTypeCheck($type) {

        switch($type){
            case 'parisencours':
                $parisEnCours = $this->showParisEnCours();
                $countParisEnCours = $parisEnCours->getTotal();
                $view = View::make('bet.parisencours', array( 'parisencours' => $parisEnCours, 'types_resultat' => $this->types_resultat, 'count_paris_encours' => $countParisEnCours ));
                return $view;

                break;
            case 'parislongterme':
                $parisLongTerme = $this->showParisLongTerme();
                $countParisLongTerme = $parisLongTerme->getTotal();
                $view = View::make('bet.parislongterme', array( 'parislongterme' => $parisLongTerme,'types_resultat' => $this->types_resultat, 'count_paris_longterme' => $countParisLongTerme ));
                return $view;

                break;
	        case 'paristermine':
		        $parisTermine = $this->currentUser->termineParis()->with('selections.equipe1','selections.equipe2','selections.competition','selections.sport','selections.typePari','tipster','compte.bookmaker')->get();
		        $countParisTermine = $parisTermine->count();
		        $view = View::make('bet.paristermine', array( 'paristermine' => $parisTermine,'types_resultat' => $this->types_resultat, 'count_paris_termine' => $countParisTermine ));
		        return $view;

		        break;
            default:
                throw new Exception('Invalid type(parisencours|parislongterme) passed');
        }
    }

    }