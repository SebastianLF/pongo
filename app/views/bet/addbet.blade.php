<div class="col-md-9">
			<div class="panel panel-default ">
				<div class="panel-heading ">
							<a data-toggle="collapse" href="#collapseAdd" aria-expanded="true" aria-controls="collapseAdd">
								Ajouter un pari <span class="caret"></span>
							</a>
						</div>
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
						    <div role="tabpanel" class="tab-pane  bordertab padding10 " id="automatique">
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
								  	<div class="bcggrey panel-body ">
								  		{{ Form::open(array('route' => 'currentbet.store', 'method' => 'post', 'id' => 'manubetform-add', 'class' => '', 'role' => 'form')) }}
								  			<div class="row ">
								  				<input id="followtypeinputdashboard" type="hidden"/>
                                                <input id="stakeunitamountinputdashboard" name="stakeunitamountinputdashboard" type="hidden"/>

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
									    				<input id="stakeunitinputdashboard" name="stakeunitinputdashboard" class="form-control" placeholder="5">
									    			</div>
									    			<div class="col-md-1">
									    				<label>/</label>
									    			</div>
									    			<div class="col-md-6">
									    				<input id="stakeindicatorinputdashboard" name="stakeindicatorinputdashboard" class="form-control" placeholder="10">	
									    			</div>
								    			</div>
									        </div>
									        <div class="row">
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
									    			<select id="letterinputdashboard" name="letterinputdashboard" class="form-control" placeholder="ex: A">
									    				<option></option>
									    				<option>A</option>
									    				<option>B</option>
									    				<option>C</option>
									    				<option>D</option>
									    			</select>
									    		</div>
                                            </div>
								    	<div id="wrapmanubetscontainer">
									    	<table class="tablemanubetlines table table-condensed table-bordered">
												<tr>
													
													<th>DATE RENCONTRE</th>
													<th>SPORT</th>
													<th>LEAGUE</th>
													<th colspan="2" width="200">RENCONTRE</th>

													<th>PARI</th>
													<th>COTE</th>


												</tr>
											  	<tr class="betline">
												  
												  <td> 
												  	<input id="datematchinputdashboard" name="datematchinputdashboard[]" class="form-control" type="date" >
												  </td>
												  <td>
												    <div class="input-group">
                                                        <input id="sportinputdashboard" name="sportinputdashboard[]" class="form-control">
                                                        <div class="input-group-btn">
                                                        <button id="sportsButtonDashboard" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>

                                                        </div><!-- /btn-group -->
                                                    </div><!-- /input-group -->

												  </td>
												  <!-- <td>
												  	<select id="countryinputdashboard" name="countryinputdashboard[]" class="form-control">
												  		<option></option>
												  		<option>france</option>
												  		<option>espagne</option>
												  	</select>
												  </td> -->
												  <td>
												  	<select id="competitioninputdashboard" name="competitioninputdashboard[]" class="form-control">
												  		<option></option>
												  		<option>Liga</option>
												  		<option>premiere league</option>
												  	</select>
												  </td>
												  <!--<td>
												  	<input id="matchnameinputdashboard" name="matchnameinputdashboard[]" class="form-control" placeholder="ex: Madrid vs Barcelona">
												  </td> -->
												  <!--
												  <input type="text" id="equipe1input[]" class="form-control" />
												  -->
												  <td width="200">
                                                        <div class="input-group">
                                                          <input type="text" class="form-control" aria-label="..." placeholder="equipe 1">
                                                          <div class="input-group-btn">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                            </ul>
                                                          </div><!-- /btn-group -->
                                                        </div><!-- /input-group -->


												  </td>
												  <td width="200">
												    <div class="input-group">
                                                                                                              <input type="text" id="equipe2input[]" class="form-control" placeholder="equipe 2"/>
                                                                                                              <div class="input-group-btn">
                                                                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                                                                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                                                                    </ul>
                                                                                                              </div>
                                                                                                        </div>
												  </td>
												  <td>
												  	<input id="picknameinputdashboard" name="picknameinputdashboard[]" class="form-control" placeholder="ex: OVER 2.5">
												  </td>
												  <td>
												  	<input id="oddinputdashboard" name="oddinputdashboard[]" class="form-control" placeholder="ex: 1.83">
												  </td>
												  <td><button type="button" class="btn btn-danger supprlinebet"><span class="glyphicon glyphicon-trash"></span></button></td>
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
												<div class="form-group">
													<button type="submit" class="btn btn-default center-block" id="validationbouton">
														valider la selection
													</button>
															<div id="addbetloader" class="center-block loader">
																<div class="f_circleG" id="frotateG_01">
																</div>
																<div class="f_circleG" id="frotateG_02">
																</div>
																<div class="f_circleG" id="frotateG_03">
																</div>
																<div class="f_circleG" id="frotateG_04">
																</div>
																<div class="f_circleG" id="frotateG_05">
																</div>
																<div class="f_circleG" id="frotateG_06">
																</div>
																<div class="f_circleG" id="frotateG_07">
																</div>
																<div class="f_circleG" id="frotateG_08">
																</div>
															</div> 
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