					<div class="panel panel-default">
					    <div class="panel-heading">
					      <h4 class="panel-title">
					        <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
					          <ul class="nav nav-pills nav-justified">
								  <li>{{$name}}</li>
								  <li>{{$stakeindicator}}</li>
								  <li>{{$stakeamount}}</li>
								  <li>{{$followtype}}</li>
								  <li>{{ Form::open(array('action' => array('TipstersController@getTipster', $id), 'method' => 'get')) }}
										{{ Form::submit('Modifier', array('class' => 'modifbuttontipster btn btn-warning btn-block')) }}
									{{ Form::close() }}
								  </li>
								  <li>{{ Form::open(array('action' => array('TipstersController@deleteTipster', $id), 'method' => 'delete', 'class' => 'formactiontipster')) }}
										{{ Form::submit('Supprimer', array('class' => 'supprtipster btn btn-danger btn-block')) }}
									{{ Form::close() }}</li>
								</ul>
					        </a>
					      </h4>
					    </div>
					    <div id="collapse0" class="panel-collapse collapse ">
					      <div class="panel-body">
					        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					      </div>
					    </div>
					</div>

					