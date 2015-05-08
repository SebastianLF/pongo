<div class="note note-success">
    <p>
        Pour <strong>vos paris perso</strong>, creez vous un tipster se nommant 'moi' ou 'Michel' par exemple.
    </p>
</div>
<div class="portlet-body form">
<form action="javascript:;" class="form-horizontal">
											<div class="form-body">
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label col-md-3">tipster</label>
															<div class="col-md-9">
																<input type="text" class="form-control input-sm" placeholder="Chee Kin">
															</div>
														</div>
													</div>
													<div class="col-md-6">
                                                    														<div class="form-group">
                                                    															<label class="control-label col-md-3">Gender</label>
                                                    															<div class="col-md-9">
                                                    																<select id="tipstersinputdashboard" name="tipstersinputdashboard" class="form-control input-sm" tabindex="-1" style="display: none;">
                                                                                                                                        <option></option>
                                                                                                                                    </select>
                                                    															</div>
                                                    														</div>
                                                    													</div>
												</div>
												<!--/row-->
												<div class="row">

													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Date of Birth</label>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="dd/mm/yyyy">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">

													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Membership</label>
															<div class="col-md-9">
																<div class="radio-list">
																	<label class="radio-inline">
																	<div class="radio"><span><input type="radio" name="optionsRadios2" value="option1"></span></div>
																	Free </label>
																	<label class="radio-inline">
																	<div class="radio"><span class="checked"><input type="radio" name="optionsRadios2" value="option2" checked=""></span></div>
																	Professional </label>
																</div>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn green">Submit</button>
																<button type="button" class="btn default">Cancel</button>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										</form>
    <!-- BEGIN FORM-->
    {{ Form::open(array('method' => 'post', 'id' => 'manubetform-add', 'class' => 'form-horizontal form-row-seperated', 'role' => 'form')
            ) }}
    <div class="form-body">
        <div class="form-group form-group-manual-bet">
            <div class="col-md-2">
                <div class="">
                    <label class="bold">Tipster</label>
                </div>
                <select id="tipstersinputdashboard" name="tipstersinputdashboard" class="form-control input-sm">
                    <option></option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="">
                    <label class="bold">Suivi</label>
                </div>
                <input id="followtypeinputdashboard" name="followtypeinputdashboard"
                       class="form-control input-sm"
                       type="text"
                       readonly/>
            </div>
            <div class="col-md-2">
                <div class="">
                    <label class="bold">Montant par unité</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">€</div>
                    <input id="amountperunit" name="amountperunit" class="form-control input-sm" type="text"
                           readonly/></input>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <div class="">
                    <label class="bold" id="stakelabeldashboard">Mise</label>
                </div>
                <div class="">
                    <select name="typestakeinputdashboard" id="typestakeinputdashboard"
                            class="form-control input-sm">
                        <option value="u">en unités</option>
                        <option value="f">manuel</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 typestakeunites">
                <div class="">
                    <label class="bold" id="">Mise en unités</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">u</div>
                    <input id="stakeunitinputdashboard" name="stakeunitinputdashboard"
                           class="form-control"
                           placeholder="5">
                </div>
            </div>
            <div class="col-md-2 typestakeunites">
                <div class="">
                    <label class="bold" id="">Conversion en {{$user->devise}}</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">{{$user->devise}}</div>
                    <input id="amountconversion" name="amountconversion" class="form-control"
                           type="text"
                           value="0" readonly/></input>
                </div>
            </div>
            <div class="col-md-2 typestakeflat">
                <div class="">
                    <label class="bold" id="">Mise en {{$user->devise}}</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">{{$user->devise}}</div>
                    <input id="amountinputdashboard" name="amountinputdashboard"
                           class="form-control"
                           placeholder="10">
                </div>
            </div>

            <div class="col-md-2 typestakeflat">
                <div class="">
                    <label class="bold" id="">Conversion en unités</label>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">u</div>
                    <input id="flattounitconversion" name="flattounitconversion"
                           class="form-control"
                           type="text"
                           value="0" readonly/></input>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-2 bookmaker-line">
                <div class="">
                    <label class="bold">Bookmaker</label>
                </div>
                <select id="bookinputdashboard" name="bookinputdashboard" class="form-control">
                    <option></option>
                </select>
            </div>
            <div class="col-md-2 bookmaker-line">
                <div class="">
                    <label class="bold">Comptes associés</label>
                </div>
                <select id="accountsinputdashboard" name="accountsinputdashboard" class="form-control ">
                    <option></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="">
                <label id="">Options</label>
            </div>
            <label class="radio-inline">
                <input type="radio" name="RadioOptions" id="aucun" value="aucun" checked="checked">aucun
            </label>
            <label class="radio-inline">
                <input type="radio" name="RadioOptions" id="parislongterme" value="parislongterme">pari long
                terme
            </label>
            <label class="radio-inline">
                <input type="radio" name="RadioOptions" id="systemeABCD" value="systemeABCD">systeme abcd
            </label>
        </div>
        <div id="methodeabcdcontainer" class="form-group">
            <div class="col-md-2">
                <div class="">
                    <label>n° série ou nom</label>
                </div>
                <select name="serieinputdashboard" id="serieinputdashboard" class="form-control input-sm">
                </select>
            </div>
            <div class="col-md-2">
                <div class="">
                    <label>lettre:</label>
                </div>
                <select id="letterinputdashboard" name="letterinputdashboard" class="form-control input-sm">
                </select>
            </div>
        </div>
    </div>
    </div>
{{ Form::close() }}