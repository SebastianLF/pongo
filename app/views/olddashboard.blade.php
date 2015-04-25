@extends('templatenav')


@section('contenu')
<div class="container-fluid paddingt10">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<a data-toggle="collapse" href="#collapseHistorique" aria-expanded="true" aria-controls="collapseHistorique">
						Historique <span class="caret"></span>
					</a>
				</div>
				<div id="collapseHistorique" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
			      <table class="table table-condensed ">
							<tr>
								<th>TYPE</th>
								<th>DATE</th>
								<th>SPORT</th>
								<th>LEAGUE</th>
								<th>RENCONTRE</th>
								<th>PARI</th>
								<th>STAKE</th>
								<th>COTE</th>
								<th>BOOKMAKER</th>
								<th>TIPSTER</th>
								<th>ETAT</th>
								<th>GAIN/PERTE</th>
							</tr>
						  	<tr>
							  <td>simple</td>
							  <td>21/01/14</td>
							  <td>football</td>
							  <td>ligue 1</td>
							  <td>psg -vs- monaco</td>
							  <td>PSG -1 AH</td>
							  <td>3/10</td>
							  <td>1.83</td>
							  <td>pinnacle</td>
							  <td>rugby betting</td>
							  <td class="etat"> 
							  	<select>
							  		<option></option>
							  		<option>victoire</option>
							  		<option>defaite</option>
							  		<option>remboursé</option>
							  		<option>annulé</option>
							  		<option>1/2 victoire</option>
							  		<option>1/2 defaite</option>
							  	</select> 
							  </td>
							  <td>+ 40 €</td>
							</tr>
						</table>
			    </div>
			    
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<a data-toggle="collapse" href="#collapseLongTerme" aria-expanded="true" aria-controls="collapseLongTerme">
						Paris long terme <span class="caret"></span>
					</a>
				</div>
				<div id="collapseLongTerme" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
			      <div class="panel-body">
			        
			      </div>
			    </div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a data-toggle="collapse" href="#collapseDerniersParis" aria-expanded="true" aria-controls="collapseDerniersParis">
						Derniers paris <span class="caret"></span>
					</a>
				</div>
				<div id="collapseDerniersParis" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body ">
						<table class="table table-condensed table-bordered">
							<tr>
								<th>TYPE</th>
								<th>DATE</th>
								<th>SPORT</th>
								<th>LEAGUE</th>
								<th>RENCONTRE</th>
								<th>PARI</th>
								<th>STAKE</th>
								<th>COTE</th>
								<th>BOOKMAKER</th>
								<th>TIPSTER</th>
								<th>ETAT</th>
								<th>GAIN/PERTE</th>
							</tr>
						  	<tr>
							  <td>simple</td>
							  <td>21/01/14</td>
							  <td>football</td>
							  <td>ligue 1</td>
							  <td>psg -vs- monaco</td>
							  <td>PSG -1 AH</td>
							  <td>3/10</td>
							  <td>1.83</td>
							  <td>pinnacle</td>
							  <td>rugby betting</td>
							  <td class="etat"> 
							  	<select>
							  		<option></option>
							  		<option>victoire</option>
							  		<option>defaite</option>
							  		<option>remboursé</option>
							  		<option>annulé</option>
							  		<option>1/2 victoire</option>
							  		<option>1/2 defaite</option>
							  	</select> 
							  </td>
							  <td>+ 40 €</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default panel-ajouterpari">
			    <div id="collapseAdd" class="panel-collapse">
			      	<div class="panel-body">
				      	
				      	<div role="tabpanel" class="">
					      	<ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" class=" strong"><a  href="#automatique"  role="tab" data-toggle="tab">AUTOMATIQUE</a></li>
							    <li role="presentation" class="active strong"><a  href="#manuel"  role="tab" data-toggle="tab">MANUEL</a></li>
						    </ul>
				    	</div>
				    	<div class="tab-content">
				    		<!--  auto  -->
						    <div role="tabpanel" class="tab-pane  bordertab padding10" id="automatique">
						    	<div class="panel panel-default">
						  <div class="bcggrey panel-body">
						    <div class=" wrapbetscontainer">
							    	
							    	
							    	<p class="text-danger center-block " id="changementtype"><strong></strong> </p>
									
									
										<!-- <ul class="titlewrapbets tablebet">
											<li>type</li>
											<li>sport</li>
											<li >league</li>
											<li >rencontre</li>
											<li >selection</li>
											<li><span class="glyphicon glyphicon-trash"></span></li>
										</ul> -->

										<div class="wrapbet">
											<ul class="betheader tablebet">
												<li>Mercredi 21 janvier 20:30</li>
												
												<li>football</li>
												<li >LIGUE 1</li>
												<li >PSG -vs- MONACO</li>
												<li class="selectioncolor">PSG -1 AH</li>
												<li><button class="btn btn-danger btn-xs supprbet"><span class="glyphicon glyphicon-trash"></span></button></li>
											</ul>
											<!-- <ul class="betheader tablebet">
												<li>20/02/06 (dans 3 jours)</li>
												<li>15:30</li>
												<li>football</li>
												<li >LIGUE 1</li>
												<li >MARSEILLE -vs- CAEN</li>
												<li class="selectioncolor">MARSEILLE -1 AH</li>
												<li><button class="btn btn-danger btn-xs supprbet"><span class="glyphicon glyphicon-trash"></span></button></li>
											</ul> -->
											
											<ul class="betfooter tablebet">
												<li>type : <span class="type typecolor">pari simple</span></li>
												<li>serie : <span class="serie seriecolor">#212 (A)</span></li>
												<li>stake : <span class="stake stakecolor">1/10</span></li>
												<li>cote : <span class="odd oddcolor">1.83</span></li>
												<li>bookmaker : <span class="bookmaker bookmakercolor">PINNACLE</span> </li>
												<li>tipster : <span class="tipster tipstercolor">rugby betting</span></li>
											</ul>
										</div>
									<button class="btn btn-default center-block" id="validationbouton"><span class="glyphicon glyphicon-ok"></span>valider la selection</button>
								</div>
						  </div>
						  
						</div>
						    	<iframe id="frame1"  src="http://portal.betbrain.com/" width="100%" height="600px"></iframe>
						    </div>

						     <!--  manuel  -->
						    <div role="tabpanel" class="tab-pane active bordertab padding10" id="manuel">
						    	<div class="panel panel-default">
								  	<div class="bcggrey panel-body">
								  		{{ Form::open(array('route' => 'transaction.store', 'method' => 'post', 'id' => 'betform-add', 'class' => '', 'role' => 'form')) }}
								  			<div class="row">
								  				<input id="followtypeinputdashboard" type="hidden">
												<div class="form-group col-md-2">
									    			<div class="">
									    				<label>tipster:</label>
									    			</div>
										    			<select id="tipstersinputdashboard" name="tipstersinputdashboard" class="form-control">
										    				<option></option>
										    			</select>
									    		</div>
									    		<div class="form-group col-md-3">
									    			<div class="">
									    				<label id="stakelabeldashboard">mise:</label>
									    			</div>
									    			<div class="col-md-4">
									    				<input class="form-control" placeholder="5">
									    			</div>
									    			<div class="col-md-1">
									    				<label>/</label>
									    			</div>
									    			<div class="col-md-6">
									    				<input id="stakeinputdashboard" name="stakeinputdashboard" class="form-control" placeholder="10">	
									    			</div>
								    			</div>
									    		
									    		<div class="form-group col-md-2">
									    			<div class="">
									    				<label>bookmaker:</label>
									    			</div>
									    			<select id="bookinputdashboard" name="bookinputdashboard" class="form-control" placeholder="ex: Pinnacle">
									    				<option></option>
									    			</select>	
									    		</div>
									    		<div class="form-group col-md-2">
									    			<div class="">
									    				<label>account:</label>
									    			</div>
									    			<select id="accountsinputdashboard" name="accountsinputdashboard" class="form-control" placeholder="ex: Pinnacle#1">
									    				<option></option>
									    			</select>	
									    		</div>
									    		<div class="form-group col-md-2">
									    			<div class="">
									    				<label>n° serie (ABC)</label>
									    			</div>
									    			<input id="serieinputdashboard" name="serieinputdashboard" class="form-control" placeholder="ex: 346">	
									    		</div>
									    		<div class="form-group col-md-1">
									    			<div class="">
									    				<label>lettre:</label>
									    			</div>
									    			<select id="lettreinputdashboard" name="lettreinputdashboard" class="form-control" placeholder="ex: A">
									    				<option></option>
									    				<option>A</option>
									    				<option>B</option>
									    				<option>C</option>
									    				<option>D</option>
									    			</select>
									    		</div>
									    	</div>
								    	<div class=" wrapbetscontainer">
									    	<table class="table table-condensed table-bordered">
												<tr>
													
													<th>DATE RENCONTRE</th>
													<th>SPORT</th>
													<th>PAYS</th>
													<th>LEAGUE</th>
													<th>RENCONTRE</th>
													<th>PARI</th>
													<th>COTE</th>
													<th></th>

												</tr>
											  	<tr>
												  
												  <td> 
												  	<input class="form-control" type="date" > 
												  </td>
												  <td>
												  	<select class="form-control">
												  		<option></option>
												  		<option>football</option>
												  		<option>basketball</option>
												  	</select>
												  </td>
												  <td>
												  	<select class="form-control">
												  		<option></option>
												  		<option>france</option>
												  		<option>espagne</option>
												  	</select>
												  </td>
												  <td>
												  	<select class="form-control">
												  		<option></option>
												  		<option>Liga</option>
												  		<option>premiere league</option>
												  	</select>
												  </td>
												  <td>
												  	<input class="form-control" placeholder="ex: Madrid vs Barcelona">
												  </td>
												  <td>
												  	<input class="form-control" placeholder="ex: OVER 2.5">
												  </td>
												  <td>
												  	<input class="form-control" placeholder="ex: 1.83">
												  </td>
												  <td><button type="button" class="btn btn-danger supprbet"><span class="glyphicon glyphicon-trash"></span></button></td>
												</tr>
												<tr id="addbetbuttontr">
													<td><button id="addbetbutton" type="button" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span>ajouter une ligne</button></td>
												</tr>
											</table>
									    	
									    	<p class="text-danger center-block " id="changementtype"><strong></strong> </p>
											
											
												<!-- <ul class="titlewrapbets tablebet">
													<li>type</li>
													<li>sport</li>
													<li >league</li>
													<li >rencontre</li>
													<li >selection</li>
													<li><span class="glyphicon glyphicon-trash"></span></li>
												</ul> -->
											
									    	<div class="row">
												<div class="form-group ">
													<button type="submit" class="btn btn-default center-block" id="validationbouton"><span class="glyphicon glyphicon-ok"></span>valider la selection</button>
												</div>	
											</div>
										</div>
										{{ Form::close() }}
								  </div>
						  
								</div>
						    </div>

						</div>
			      	 
				      	<div class="row">
					    	<div class="col-md-12">
					    		<div class="row formenajout">	
									<div class="col-md-12">		
					        			<p class="text-danger center-block titreinfos" id=""><strong> </strong> </p>
										
											
										
									</div>
								</div> 
								
								
								
							</div>
						</div>
			    </div>
			  </div>
			</div>
			
			  
			
			
			  
			</div> 
		

		<div class="col-md-3 ">
			<div class="panel panel-default ">
				<div class="panel-heading bcgblack colorwhite">Bookmakers</div>
				<div class="panel-body">
					<ul class="list-group">
					  <li class="list-group-item well-sm">
					    <span class="badge">140 €</span>
					    Pinnacle
					    <span class="caret"></span>
					  </li>
					  <li class="list-group-item well-sm">
					    <span class="badge">780 €</span>
					    Bet365
					    <span class="caret"></span>
					  </li>
					  <li class="list-group-item  well well-sm">
					    <span class="badge">14 €</span>
					    Sbobet
					    <span class="caret"></span>
					  </li>
					  <li class="list-group-item list-group-item-success well-lg">
					    <span class="badge ">934 €</span>
					    Total Bankroll
					  </li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-md-3 pull-right">
			<div class="panel panel-default ">
				<div class="panel-heading bcgblack colorwhite">Cumul unités Mois en cours</div>
				<div class="panel-body">
					@include('subview.profitmonth')
				</div>
			</div>
		</div>
		<div class="col-md-3 pull-right">
			<div class="panel panel-default ">
				<div class="panel-heading bcgblack colorwhite">Abonnements tipsters actuels</div>
				<div class="panel-body">
					<ul class="list-group">
					  <li class="list-group-item well-sm">
					    <span class="badge">- 100 € / mois</span>
					</ul>
				</div>
			</div>
		</div>
		</div>
		</div>
	</div>

@stop
	
