@extends('template')

@section('contenu')

	<div class="col-md-4 col-sm-offset-5">
		<img src="{{asset('img/raizer.png')}}" alt=""/>
	</div>

    <div class="col-sm-offset-4 col-sm-4">
    <div class="center">SEA BETS AND SUN</div>
    {{ link_to('auth/inscription', 'Inscription !', array('class' => 'btn btn-warning '))}}
		<br>
		@if(Session::has('error'))
			<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif		
		<div class="panel panel-primary">	
			<div class="panel-heading">Connectez-vous !</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{{ Form::open(array('url' => 'auth/login', 'method' => 'post', 'class' => 'form-horizontal panel')) }}	
						<small class="text-danger">{{ $errors->first('name') }}</small>
					  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					  	{{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nom')) }}
					  </div>
					  <small class="text-danger">{{ Session::get('pass') }}</small>
					  <div class="form-group {{ Session::has('pass') ? 'has-error' : '' }}">
					  	{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Mot de passe')) }}
					  </div>
						<div class="checkbox">
						  {{ Form::checkbox('souvenir') }}Se rappeler de moi
						</div>
						{{ Form::submit('Envoyer', array('class' => 'btn btn-primary pull-right')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
		{{ link_to('password/remind', 'J\'ai oublié mon mot de passe !', array('class' => 'btn btn-warning pull-right')) }}
		
	</div>



@stop