@extends('template')

@section('contenu')
    <div class="col-sm-offset-4 col-sm-4">
		<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Formulaire d'inscription</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{{ Form::open(array('url' => 'auth/inscription', 'method' => 'post', 'class' => 'form-horizontal panel')) }}	
						<small class="text-danger">{{ $errors->first('name') }}</small>
					  <div class="form-group {{ $errors->has('name') ? 'has-error has-feedback' : '' }}">
					  	{{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nom')) }}
					  </div>
					  <small class="text-danger">{{ $errors->first('email') }}</small>
					  <div class="form-group {{ $errors->has('email') ? 'has-error has-feedback' : '' }}">
					  	{{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email')) }}
					  </div>
					  <small class="text-danger">{{ $errors->first('password') }}</small>
					  <div class="form-group {{ $errors->has('password') ? 'has-error has-feedback' : '' }}">
					  	{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Mot de passe')) }}
					  </div>
					  <div class="form-group">
					  	{{ Form::password('Confirmation_mot_de_passe', array('class' => 'form-control', 'placeholder' => 'Confirmation mot de passe')) }}
					  </div>


						{{ Form::submit('Envoyer', array('class' => 'btn btn-primary pull-right')) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@stop