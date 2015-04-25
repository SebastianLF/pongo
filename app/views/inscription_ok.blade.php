@extends('template')

@section('contenu')
    <div class="col-sm-offset-4 col-sm-4">
		<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Inscription validée</div>
			<div class="panel-body">
				Vous etes desormais inscrit ! 
			</div>
			
		</div>
	</div>
	<div class="col-sm-offset-4 col-sm-4">
	{{ link_to('home', 'retourner à l\'accueil', array('class' => 'btn btn-warning '))}}
	</div>
@stop