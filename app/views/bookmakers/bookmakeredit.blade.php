@extends('templatenav')


@section('contenu')
<div class="container">

		<?php  ?>
	<div class="panel panel-default">

	  <div class="panel-heading">
	    <h3 class="panel-title">{{$bookmaker->pivot->accountname}}</h3>
	  </div>
	  <div class="panel-body">
	  						
	  
	  
	  							<div id="msgalert" class="collapse alert alert-success"><p class="text-center"><?php echo Session::get('message'); ?></p></div>
								
	    {{ Form::open(array('url' => 'bookmaker/'.$bookmaker->pivot->id, 'method' => 'put', 'id' => 'bookmakerform-edit', 'class' => 'form-horizontal', 'role' => 'form')) }}
	    								
	    								<small class="text-danger">{{ $errors->books->first('booknamemodifselect') }}</small>
	    								<div class="booknamemodifcontainer form-group">
											<label class="col-sm-2 control-label">bookmaker</label>
											<div class="col-sm-2">
											
												<select id="booknamemodifselect" name="booknamemodifselect" class="form-control"  >
													<option selected="selected" value="{{ $bookmaker->name }}">{{ $bookmaker->name }}</option >
												    @foreach($allbookmakers as $one)
												    	<option>{{$one->name}}</option>
												    @endforeach
												</select>
											</div>
										</div>

										<small class="text-danger">{{ $errors->books->first('accountnamemodifinput') }}</small>
									    <div class="accountnamemodifcontainer form-group">
										    <label class="col-sm-2 control-label">n° ou nom compte :</label>
										    
										    <div class="col-sm-2">
										      	<input id="accountnamemodifinput" type="text" name="accountnamemodifinput" class="form-control" value="{{ $bookmaker->pivot->accountname }}">
										    </div>
									    </div>
									  	
									  	<small class="text-danger">{{ $errors->books->first('bankrollinvestedmodifinput') }}</small>
										<div class="bankrollinvestedmodifcontainer form-group">
											<label class="col-sm-2 control-label">montant total deposé:</label>
											<div class="col-sm-2">
										      	<input id="bankrollinvestedmodifinput" name="bankrollinvestedmodifinput" class="form-control"  placeholder="0.00" value="{{ $bookmaker->pivot->bankrollinvested }}">
										   	</div>
									   	</div>

									   	<small class="text-danger">{{ $errors->books->first('bonusmodifinput') }}</small>
									   	<div class="bonusmodifcontainer form-group">
											<label class="col-sm-2 control-label">bonus:</label>
											<div class="col-sm-2">
										      	<input id="bonusmodifinput" name="bonusmodifinput" class="form-control"  placeholder="0.00" value="{{ $bookmaker->pivot->bonus }}">
										   	</div>
									   	</div>

									   	<small class="text-danger">{{ $errors->books->first('bankrollamountmodifinput') }}</small>
									   	<div class="bankrollamountmodifcontainer form-group">
											<label class="col-sm-2 control-label">montant total:</label>
											<div class="col-sm-2">
										      	<input id="bankrollamountmodifinput" name="bankrollamountmodifinput" class="form-control"  placeholder="0.00" value="{{ $bookmaker->pivot->bankrollamount }}">
										   	</div>
									   	</div>

									 	
										
								  	<input id="bookmakerformmodifinput" value="Enregistrer" type="submit" class="btn btn-success center-block"/>
								{{ Form::close() }}
	  </div>
	</div>
	<a href="{{url('config')}}" class="btn btn-default">
		<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
	</a>
</div>

@stop