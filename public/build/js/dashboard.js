function loadBookmakersOnDashboard(){$.ajax({url:"comptes",type:"get",success:function(e){$("#comptes_par_bookmakers").html(e)},error:function(e){console.log("la récuperation des comptes bookmakers vers le dashboard n'a pas fonctionné")}})}function loadGeneralRecapsOnDashboard(){var e=$("#defaultrange input").val();$.ajax({url:"generalrecap",type:"get",data:{range:e},success:function(e){$("#tipsters-general-recap").html(e.tipsters_view),$("#total-recap-profits-devise").html(e.total_profit_devise),$("#total-recap-profits-unites").html(e.total_profit_unites)}})}function addManualCouponSelection(){function e(){q.addClass("hidden"),T.addClass("hidden"),G.addClass("hidden"),V.addClass("hidden"),K.addClass("hidden"),U.addClass("hidden"),ue.addClass("hidden"),le.prop("disabled",!0)}function a(){de.click(function(){ue.toggleClass("hidden"),de.is(":checked")?(le.prop("disabled",!1),de.parents("span").addClass("checked")):(le.prop("disabled",!0),de.parents("span").removeClass("checked"))})}function r(){f.find(".sportinputdashboard").select2({allowClear:!0,placeholder:"Choisir un sport",cache:!0,ajax:{url:"sports",dataType:"json",data:function(e){return{q:e.term}},processResults:function(e){return{results:e}}}}).change(function(){M.html(""),y.val("").trigger("change"),w.val("").trigger("change"),S.val("").trigger("change"),M.val("").trigger("change"),E.val("").trigger("change"),N.val("").trigger("change"),z.val("").trigger("change"),Y.val("").trigger("change"),H.val("").trigger("change"),Q.val("").trigger("change")})}function t(){function e(e){if(!e.id)return e.text;var a=$('<span><img src="img/flags/'+e.country.shortname+'.png" class="img-flag" /> '+e.text+"</span>");return a}f.find(".competitioninputdashboard").select2({allowClear:!0,placeholder:"Choisir une competition",cache:!0,language:"fr",ajax:{url:"competitions",dataType:"json",data:function(e){return{sport_id:f.find(".sportinputdashboard").val(),q:e.term}},processResults:function(e){return{results:e}}},templateResult:e})}function n(){f.find(".marketinputdashboard").select2({allowClear:!0,placeholder:"Choisir un type de pari",cache:!0,ajax:{url:"markets",dataType:"json",data:function(e){return{sport_id:f.find(".sportinputdashboard").val(),q:e.term}},processResults:function(e){return{results:e}}}}).change(function(){l(),c();var e=f.find(".marketinputdashboard").val();""==e?(T.fadeOut().addClass("hidden"),q.fadeOut().addClass("hidden")):(T.fadeIn().removeClass("hidden"),q.fadeIn().removeClass("hidden")),7==e?(M.select2({tags:!0,allowClear:!0,placeholder:"Nom de l'équipe ou du joueur vainqueur"}),I.html("Vainqueur <span class='glyphicon glyphicon-save'></span>")):8==e?(E.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),N.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),q.fadeIn().removeClass("hidden"),M.select2({data:m,minimumResultsForSearch:1/0}),I.html("Résultat du match"),ee.text("Equipe Handicap"),U.fadeIn().removeClass("hidden"),U.addClass("col-md-6"),Q.select2({data:h,minimumResultsForSearch:1/0,placeholder:"Equipe/Joueur"}),J.html('Handicap <span class="glyphicon glyphicon-save"></span>'),G.fadeIn().removeClass("hidden"),G.addClass("col-md-6"),z.html('<option value=""></option>'),z.select2({tags:!0,allowClear:!0,placeholder:"2.5 ou -2.5"})):9==e?(p=[{id:"1X",text:"1X"},{id:"X2",text:"X2"},{id:"12",text:"12"}],M.select2({data:p,minimumResultsForSearch:1/0}),E.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),N.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),I.html("Choix")):11==e?(p=[{id:"1/1",text:"1/1"},{id:"1/X",text:"1/X"},{id:"1/2",text:"1/2"},{id:"X/1",text:"X/1"},{id:"X/X",text:"X/X"},{id:"X/2",text:"X/2"},{id:"2/1",text:"2/1"},{id:"2/X",text:"2/X"},{id:"2/2",text:"2/2"}],M.select2({data:p,minimumResultsForSearch:1/0}),E.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),N.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),I.html("Choix")):43==e?(E.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),N.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),M.select2({data:m,minimumResultsForSearch:1/0})):46==e?(E.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),N.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),M.select2({data:h,minimumResultsForSearch:1/0})):48==e?(E.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),N.html('<option value=""></option>').val("").trigger("change").prop("disabled",!1),M.select2({data:h,minimumResultsForSearch:1/0}),G.removeClass("hidden"),J.text("Handicap"),z.select2({placeholder:"-2.5 ou 2.5",tags:!0})):(f.find(".pickinputdashboard").html(""),f.find(".pickinputdashboard").val("").trigger("change"))})}function o(){f.find(".scopeinputdashboard").select2({allowClear:!0,placeholder:"Choisir une portée",cache:!0,ajax:{url:"scopes",dataType:"json",data:function(e){return{sport_id:f.find(".sportinputdashboard").val(),q:e.term}},processResults:function(e){return{results:e}}}})}function s(){f.find(".pickinputdashboard").select2()}function i(){function e(e){if(!e.id)return e.text;var a=$('<span><img src="img/flags/'+e.country.shortname+'.png" class="img-flag" /> '+e.text+"</span>");return a}f.find(".team1inputdashboard").select2({allowClear:!0,placeholder:"Equipe/Joueur Domicile",cache:!0,ajax:{url:"equipes",dataType:"json",data:function(e){return{sport_id:f.find(".sportinputdashboard").val(),q:e.term}},processResults:function(e){return{results:e}}},templateResult:e}),f.find(".team2inputdashboard").select2({allowClear:!0,placeholder:"Equipe/Joueur Exterieur",cache:!0,ajax:{url:"equipes",dataType:"json",data:function(e){return{sport_id:f.find(".sportinputdashboard").val(),q:e.term}},processResults:function(e){return{results:e}}},templateResult:e})}function d(){f.submit(function(e){e.preventDefault();var a,r=f.serialize();a=f.find("#live").is(":checked")?1:0,$.ajax({url:"manualcoupon",type:"post",data:r+"&live="+a,success:function(e){0==e.etat?(e.errors.date?(f.find("#date_container").addClass("has-error"),f.find("#date_error").html(e.errors.date)):(f.find("#date_container").removeClass("has-error"),f.find("#date_error").empty()),e.errors.sport?(f.find("#sport_container").addClass("has-error"),f.find("#sport_error").html(e.errors.sport)):(f.find("#sport_container").removeClass("has-error"),f.find("#sport_error").empty()),e.errors.competition?(f.find("#competition_container").addClass("has-error"),f.find("#competition_error").html(e.errors.competition)):(f.find("#competition_container").removeClass("has-error"),f.find("#competition_error").empty()),e.errors.market?(f.find("#market_container").addClass("has-error"),f.find("#market_error").html(e.errors.market)):(f.find("#market_container").removeClass("has-error"),f.find("#market_error").empty()),e.errors.scope?(f.find("#scope_container").addClass("has-error"),f.find("#scope_error").html(e.errors.scope)):(f.find("#scope_container").removeClass("has-error"),f.find("#scope_error").empty()),e.errors.team1?(f.find("#team1_container").addClass("has-error"),f.find("#team1_error").html(e.errors.team1)):(f.find("#team1_container").removeClass("has-error"),f.find("#team1_error").empty()),e.errors.team2?(f.find("#team2_container").addClass("has-error"),f.find("#team2_error").html(e.errors.team2)):(f.find("#team2_container").removeClass("has-error"),f.find("#team2_error").empty()),e.errors.pick?(f.find("#pick_container").addClass("has-error"),f.find("#pick_error").html(e.errors.pick)):(f.find("#pick_container").removeClass("has-error"),f.find("#pick_error").empty()),e.errors.odd_doubleParam?(f.find("#odd_doubleParam_container").addClass("has-error"),f.find("#odd_doubleParam_error").html(e.errors.odd_doubleParam)):(f.find("#odd_doubleParam_container").removeClass("has-error"),f.find("#odd_doubleParam_error").empty()),e.errors.odd_doubleParam2?(f.find("#odd_doubleParam2_container").addClass("has-error"),f.find("#odd_doubleParam2_error").html(e.errors.odd_doubleParam2)):(f.find("#odd_doubleParam2_container").removeClass("has-error"),f.find("#odd_doubleParam2_error").empty()),e.errors.odd_doubleParam3?(f.find("#odd_doubleParam3_container").addClass("has-error"),f.find("#odd_doubleParam3_error").html(e.errors.odd_doubleParam3)):(f.find("#odd_doubleParam3_container").removeClass("has-error"),f.find("#odd_doubleParam3_error").empty()),e.errors.bookmaker?(f.find("#bookmaker_container").addClass("has-error"),f.find("#bookmaker_error").html(e.errors.bookmaker)):(f.find("#bookmaker_container").removeClass("has-error"),f.find("#bookmaker_error").empty()),e.errors.odd_value?(f.find("#odd_container").addClass("has-error"),f.find("#odd_error").html(e.errors.odd_value)):(f.find("#odd_container").removeClass("has-error"),f.find("#odd_error").empty()),e.errors.score?(f.find("#score_container").addClass("has-error"),f.find("#score_error").html(e.errors.score)):(f.find("#score_container").removeClass("has-error"),f.find("#score_error").empty())):(refreshSelections(),u())}})})}function l(){S.html("").val("").trigger("change"),T.addClass("hidden"),T.removeClass("has-error"),R.empty(),M.html("").val("").trigger("change"),q.addClass("hidden"),q.removeClass("has-error"),X.empty(),z.html("").val("").trigger("change"),G.addClass("hidden"),G.removeClass("has-error"),L.empty(),Y.html("").val("").trigger("change"),V.addClass("hidden"),V.removeClass("has-error"),W.empty(),H.html("").val("").trigger("change"),K.addClass("hidden"),K.removeClass("has-error"),Z.empty(),Q.html("").val("").trigger("change"),U.addClass("hidden"),U.removeClass("has-error"),ae.empty()}function c(){E.html("").val("").trigger("change").prop("disabled",!0),N.html("").val("").trigger("change").prop("disabled",!0)}function u(){g.val(null).trigger("change"),v.removeClass("has-error"),b.empty(),C.val(null).trigger("change"),k.removeClass("has-error"),_.empty(),y.val(null).trigger("change"),x.removeClass("has-error"),P.empty(),w.val(null).trigger("change"),j.removeClass("has-error"),D.empty(),S.val(null).trigger("change"),T.removeClass("has-error"),R.empty(),E.val(null).trigger("change"),O.removeClass("has-error"),B.empty(),N.val(null).trigger("change"),F.removeClass("has-error"),A.empty(),M.val(null).trigger("change"),q.removeClass("has-error"),X.empty(),z.val(null).trigger("change"),G.removeClass("has-error"),L.empty(),Y.val(null).trigger("change"),V.removeClass("has-error"),W.empty(),H.val(null).trigger("change"),K.removeClass("has-error"),Z.empty(),Q.val(null).trigger("change"),U.removeClass("has-error"),ae.empty(),oe.val(null).trigger("change"),ie.removeClass("has-error"),se.empty(),te.val(null).trigger("change"),re.removeClass("has-error"),ne.empty(),te.val(null),ue.removeClass("has-error").addClass("hidden"),ce.empty(),le.val("").prop("disabled",!0),de.parents("span").removeClass("checked"),de.prop("checked",!1)}var p="",m=[{id:"1",text:"Home"},{id:"2",text:"Away"},{id:"X",text:"Draw"}],h=[{id:"1",text:"Home"},{id:"2",text:"Away"}],f=($("#automaticform-add"),$("#manualselectionform-add")),g=($("#manualBetAddModal").modal("hide"),f.find('input[name="date"]')),v=f.find("#date_container"),b=f.find("#date_error"),C=f.find('select[name="sport"]'),k=f.find("#sport_container"),_=f.find("#sport_error"),y=f.find('select[name="competition"]'),x=f.find("#competition_container"),P=f.find("#competition_error"),w=f.find('select[name="market"]'),j=f.find("#market_container"),D=f.find("#market_error"),S=f.find('select[name="scope"]'),T=f.find("#scope_container"),R=f.find("#scope_error"),E=f.find('select[name="team1"]'),O=f.find("#team1_container"),B=f.find("#team1_error"),N=f.find('select[name="team2"]'),F=f.find("#team2_container"),A=f.find("#team2_error"),M=f.find('select[name="pick"]'),q=f.find("#pick_container"),I=q.find("label"),X=f.find("#pick_error"),z=f.find('select[name="odd_doubleParam"]'),G=f.find("#odd_doubleParam_container"),J=G.find("label"),L=f.find("#odd_doubleParam_error"),Y=f.find('select[name="odd_doubleParam2"]'),V=f.find("#odd_doubleParam2_container"),W=f.find("#odd_doubleParam2_error"),H=f.find('select[name="odd_doubleParam3"]'),K=f.find("#odd_doubleParam3_container"),Z=f.find("#odd_doubleParam3_error"),Q=f.find('select[name="odd_participantParameterName"]'),U=f.find("#odd_participantParameterName_container"),ee=U.find("label"),ae=f.find("#odd_participantParameterName_error"),re=f.find("#bookmaker_container"),te=f.find('select[name="bookmaker"]'),ne=f.find("#bookmaker_error"),oe=f.find('input[name="odd_value"]'),se=f.find("#odd_error"),ie=f.find("#odd_container"),de=f.find("#live"),le=f.find('input[name="score"]'),ce=f.find("#score_error"),ue=f.find("#score_container");te.select2({allowClear:!0,placeholder:"Choisir un bookmaker",cache:!0,ajax:{url:"bookmakers",dataType:"json",data:function(e){return{q:e.term}},processResults:function(e){return{results:e}}}}),e(),$.fn.modal.Constructor.prototype.enforceFocus=function(){},$.fn.datetimepicker.dates.fr={days:["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"],daysShort:["Dim","Lun","Mar","Mer","Jeu","Ven","Sam","Dim"],daysMin:["D","L","Ma","Me","J","V","S","D"],months:["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],monthsShort:["Jan","Fev","Mar","Avr","Mai","Jui","Jul","Aou","Sep","Oct","Nov","Dec"],today:"Aujourd'hui",suffix:[],meridiem:"",weekStart:1},g.datetimepicker({format:"dd/mm/yyyy hh:ii",todayBtn:!0,autoclose:"true",language:"fr",pickerPosition:"bottom-left"}),u(),d(),a(),r(),t(),n(),o(),s(),i()}function refreshSelections(){var e=$("#automaticform-add");$.ajax({url:"selections",success:function(a){e.find("#automatic-selections").html(a.vue),supprimerSelection(),misAjourCompteBookmaker(),openOrCloseSelectionsCouponAccordeonWhenSelectionsCouponIsRefreshed(a.count)},error:function(a){e.find("#automatic-selections").html("<p>impossible de récuperer les selections</p>")}})}function openOrCloseSelectionsCouponAccordeonWhenSelectionsCouponIsRefreshed(e){e>0?($("#panier-selections-add-ticket").collapse("show"),$("#infos-generales-add-ticket").collapse("show")):($("#panier-selections-add-ticket").collapse("hide"),$("#infos-generales-add-ticket").collapse("hide"))}function supprimerSelection(){var e=$("#automaticform-add");e.find("#automatic-selections .boutonsupprimer").on("click",function(e){e.preventDefault();var a=$(this).parents("tr"),r=a.find(".selection_id").text();$.ajax({url:"coupon/"+r,method:"delete",success:function(e){refreshSelections()}})})}function misAjourCompteBookmaker(){$.ajax({url:"updateaccountform",success:function(e){$("#automaticform-add").find("#accountsinputdashboard").html(""),e.length>0?$("#automaticform-add").find("#accountsinputdashboard").select2({data:e,minimumResultsForSearch:1/0}).val(e[0].id).trigger("change"):$("#automaticform-add").find("#accountsinputdashboard").select2({minimumResultsForSearch:1/0,placeholder:"Choisir un compte de bookmaker"}).val("").trigger("change").html("")}})}function gestionTicket(){function e(){r(),w.on("click",function(){$(this).is(":checked")?(y.removeClass("hide"),x.val(null).trigger("change").prop("disabled",!1),P.val(null).trigger("change").prop("disabled",!1)):(y.addClass("hide"),x.val(null).trigger("change").prop("disabled",!0),P.val(null).trigger("change").prop("disabled",!0))})}function a(){c.submit(function(e){e.preventDefault(),m.prop("disabled",!1);var a=$(this).serialize(),t=c.find(".betline").length;if(""==t)swal({title:"Erreur!",text:"Ajoutez au moins une selection pour pouvoir valider le ticket!",type:"warning",confirmButtonText:"OK"});else if(t>=1){var n,o,s;n=w.is(":checked")?1:0,o=j.is(":checked")?1:0,s=D.is(":checked")?1:0,$.ajax({url:"encourspari/auto",type:"post",data:a+"&linesnum="+t+"&ticketABCD="+n+"&ticketGratuit="+o+"&ticketLongTerme="+s,dataType:"json",success:function(e){var a;if(0==e.etat)if(console.log(e.msg),console.log($.isArray(e.msg)),$.isArray(e.msg))for(key in e.msg)a=key,toastr.error(e.msg[a],"Erreur:");else toastr.error(e.msg,"Erreur:");else 1==e.etat&&(p.val(null).trigger("change"),r(),refreshSelections(),toastr.success(e.msg,"Pari"),loadParisEnCours(),loadBookmakersOnDashboard())},error:function(e){console.log("erreur ajout de pari")},complete:function(){m.prop("disabled",!0)}})}})}function r(){m.val(null).trigger("change").prop("disabled",!0),h.val(null),f.val("u").trigger("change"),b.val(0).prop("disabled",!0),k.val(0).prop("disabled",!0),v.val(0),_.val(null).trigger("change").html("").prop("disabled",!0),y.addClass("hide"),x.val(null).trigger("change").prop("disabled",!0),P.val(null).trigger("change").prop("disabled",!0),S.addClass("hidden"),T.addClass("hidden"),R.addClass("hidden"),t()}function t(){w.prop("checked",!1),w.parents("span").removeClass("checked"),j.prop("checked",!1),j.parents("span").removeClass("checked"),D.prop("checked",!1),D.parents("span").removeClass("checked")}function n(){c.find("#selection-refresh").click(function(e){e.preventDefault(),refreshSelections()})}function o(){p.select2({allowClear:!0,placeholder:"Choisir un tipster",cache:!0,ajax:{url:"tipsters",dataType:"json",data:function(e){return{q:e.term}},processResults:function(e){return{results:e}}}}).change(function(){var e=p.select2("data");b.val(0),k.val(0),v.val(0),""==p.val()?(r(),m.val(null).trigger("change"),h.val(null),S.addClass("hidden"),T.addClass("hidden"),R.addClass("hidden")):(S.fadeIn().removeClass("hidden"),T.fadeIn().removeClass("hidden"),R.fadeIn().removeClass("hidden"),"n"==e[0].followtype?(m.val("n").trigger("change"),_.prop("disabled",!1),T.removeClass("hidden"),misAjourCompteBookmaker()):"b"==e[0].followtype&&(m.val("b").trigger("change"),_.prop("disabled",!0),T.addClass("hidden")));var a=Number(e[0].montant_par_unite);h.val(isNaN(a)?"":a)}),m.select2({cache:!0,minimumResultsForSearch:1/0,data:[{id:"",text:""},{id:"n",text:"normal"},{id:"b",text:"à blanc"}]}).prop("disabled",!0)}function s(){var e=[{id:"u",text:"en unités"},{id:"f",text:"en devise"}];f.select2({minimumResultsForSearch:1/0,cache:!0,data:e}),C.hide(),f.on("change",function(){"f"==f.val()?(v.val(0).prop("disabled",!0),b.val(0),k.val(0).prop("disabled",!1),g.hide(),C.show()):(k.val(0).prop("disabled",!0),v.val(0).prop("disabled",!1),b.val(0),g.show(),C.hide())})}function i(){_.select2({allowClear:!0,placeholder:"Choisir un compte",cache:!0,minimumResultsForSearch:1/0,ajax:{url:"accounts",dataType:"json",data:function(e){return{book_id:$(u+" .bookinputdashboard").val(),q:e.term}},processResults:function(e){return{results:e}}}})}function d(){x.select2({allowClear:!0,placeholder:"Choisir une serie",tags:!0,cache:!0,ajax:{url:"parisabcd",dataType:"json",data:function(e){return{q:e.term}},processResults:function(e){return{results:e}}}}),P.select2({allowClear:!0,placeholder:"Choisir une lettre",cache:!0,minimumResultsForSearch:1/0,ajax:{url:"lettreabcd",dataType:"json",data:function(e){return{serie_nom:x.val(),q:e.term}},processResults:function(e){console.log(e);var a=[];return $.each(e,function(e,r){a.push({id:r,text:r})}),{results:a}}}})}function l(){v.keyup(function(){var e=h.val(),a=Number(v.val()),r=Number(e)*Number(a),t=Math.round(100*r)/100;b.val(isNaN(t)||0>t?0:t)})}var c=$("#automaticform-add"),u="#automaticform-add",p=c.find("#tipstersinputdashboard"),m=c.find("#followtypeinputdashboard"),h=c.find("#amountperunit"),f=c.find("#typestakeinputdashboard"),g=c.find(".typestakeunites"),v=c.find("#stakeunitinputdashboard"),b=c.find("#amountconversion"),C=c.find(".typestakeflat"),k=c.find("#amountinputdashboard"),_=c.find("#accountsinputdashboard"),y=c.find("#methodeabcdcontainer"),x=c.find("#serieinputdashboard"),P=c.find("#letterinputdashboard"),w=c.find("#ticketABCD"),j=c.find("#ticketGratuit"),D=c.find("#ticketLongTerme"),S=c.find("#optionscontainer"),T=c.find("#bookmakercontainer"),R=c.find("#typestakecontainer");e(),n(),refreshSelections(),a(),o(),s(),l(),i(),d()}function automaticBetForm(){function e(){l.submit(function(e){e.preventDefault();var r=$(this).serialize(),t=l.find(".betline").length;if(""==t)swal({title:"Erreur!",text:"Ajoutez au moins une selection pour pouvoir valider le ticket!",type:"warning",confirmButtonText:"OK"});else if(t>=1){var n,o,i;n=p.is(":checked")?1:0,o=m.is(":checked")?1:0,console.log(p.is(":checked")),i=h.is(":checked")?1:0,$.ajax({url:"encourspari/auto",type:"post",data:r+"&linesnum="+t+"&ticketABCD="+n+"&ticketGratuit="+o+"&ticketLongTerme="+i,dataType:"json",success:function(e){var r;if(0==e.etat)if($.isArray(e.msg))for(key in e.msg)r=key,toastr.error(e.msg[r],"Erreur:");else toastr.error(e.msg,"Erreur:");else 1==e.etat&&(s(),a(),toastr.success(e.msg,"Pari"),loadParisEnCours(),loadBookmakersOnDashboard())},error:function(e){console.log("erreur ajout de pari")}})}})}function a(){var e=u.val();$.ajax({url:"selections",success:function(a){l.find("#automatic-selections").html(a.vue),r(),$.ajax({url:"allbookmakers",dataType:"json",success:function(r){l.find(".bookinputdashboard").select2({minimumResultsForSearch:1/0,cache:!0,data:r}),"à blanc"==e?(l.find(".bookinputdashboard").val("").trigger("change"),l.find("#accountsinputdashboard").val("").trigger("change")):(l.find(".bookinputdashboard").prop("disabled",!1),l.find("#accountsinputdashboard").prop("disabled",!1),l.find(".bookinputdashboard").val(a.bookmaker_id).trigger("change")),o(a.bookmaker_id)}}),a.msg.length>0&&swal({title:"Erreur!",text:a.msg,type:"warning",confirmButtonText:"OK"})},error:function(e){l.find("#automatic-selections").html("<p>impossible de récuperer les selections</p>")}})}function r(){l.find("#automatic-selections .boutonsupprimer").on("click",function(e){e.preventDefault();var r=$(this).parents("tr"),t=r.find(".selection_id").text();$.ajax({url:"coupon/"+t,method:"delete",success:function(e){a(),l.find(".bookinputdashboard").val(null).trigger("change"),l.find('select[name="accountsinputdashboard"]').val(null).trigger("change")},error:function(e){}})})}function t(){l.find("#selection-refresh").click(function(e){e.preventDefault(),a()})}function n(){var e=l.find("select[name=typestakeinputdashboard]");l.find(".typestakeflat").hide(),e.on("change",function(){"f"==$(this).val()?(l.find("#stakeunitinputdashboard").val(0),l.find("#amountconversion").val(0),l.find("#amountinputdashboard").val(0),l.find("#flattounitconversion").val(0),l.find(".typestakeunites").hide(),l.find(".typestakeflat").show()):(l.find("#amountinputdashboard").val(0),l.find("#flattounitconversion").val(0),l.find("#stakeunitinputdashboard").val(0),l.find("#amountconversion").val(0),l.find(".typestakeunites").show(),l.find(".typestakeflat").hide())})}function o(e){l.find("#tipstersinputdashboard").select2({allowClear:!0,placeholder:"Choisir un tipster",cache:!0,ajax:{url:"tipsters",dataType:"json",data:function(e){return{q:e.term}},processResults:function(e){return{results:e}}}}).change(function(){var e=$(this).select2("data");""==l.find("#tipstersinputdashboard").val()?(s(),l.find("#WithoutTipsterPart").fadeOut().addClass("hidden"),u.val(null).trigger("change"),l.find("#amountperunit").val("")):(l.find("#WithoutTipsterPart").fadeIn().removeClass("hidden"),"n"==e[0].followtype?u.val("n").trigger("change"):"b"==e[0].followtype&&u.val("b").trigger("change"));var a=Number(e[0].montant_par_unite);l.find("#amountperunit").val(isNaN(a)?"":a)}),u.select2({cache:!0,minimumResultsForSearch:1/0,data:[{id:"n",text:"normal"},{id:"b",text:"à blanc"}]}).prop("disabled",!0)}function s(){l.find("#stakeunitinputdashboard").val(null),l.find("#amountinputdashboard").val(null),l.find("#accountsinputdashboard").val(null).trigger("change"),l.find(".methodeabcdcontainer").addClass("hide"),l.find("#serieinputdashboard").val(null).trigger("change").prop("disabled",!0),l.find("#letterinputdashboard").val(null).trigger("change").prop("disabled",!0),l.find("#amountconversion").val(0),l.find("#flattounitconversion").val(0),l.find("#amountinputdashboard").val(0),l.find("#stakeunitinputdashboard").val(0),i()}function i(){p.prop("checked",!1),p.parents("span").removeClass("checked"),m.prop("checked",!1),m.parents("span").removeClass("checked"),h.prop("checked",!1),h.parents("span").removeClass("checked")}function d(){console.log(u.val()),u.val("b").trigger("change"),l.find("#WithoutTipsterPart").addClass("hidden"),s(),l.find("#ticketABCD").on("click",function(){$(this).is(":checked")?(l.find(".methodeabcdcontainer").removeClass("hide"),l.find("#serieinputdashboard").val(null).trigger("change").prop("disabled",!1),l.find("#letterinputdashboard").val(null).trigger("change").prop("disabled",!1)):(l.find(".methodeabcdcontainer").addClass("hide"),l.find("#serieinputdashboard").val(null).trigger("change").prop("disabled",!0),l.find("#letterinputdashboard").val(null).trigger("change").prop("disabled",!0))})}var l=$("#automaticform-add"),c="#automaticform-add",u=l.find("#followtypeinputdashboard"),p=l.find("#ticketABCD"),m=l.find("#ticketGratuit"),h=l.find("#ticketLongTerme"),f=[{id:"u",text:"en unités"},{id:"f",text:"en devise"}];l.find("#typestakeinputdashboard").select2({minimumResultsForSearch:1/0,cache:!0,data:f}),l.find("#accountsinputdashboard").select2({allowClear:!0,placeholder:"Choisir un compte",cache:!0,minimumResultsForSearch:1/0,ajax:{url:"accounts",dataType:"json",data:function(e){return{book_id:$(c+" .bookinputdashboard").val(),q:e.term}},processResults:function(e){return{results:e}}}}),l.find("#serieinputdashboard").select2({allowClear:!0,placeholder:"Choisir une serie",tags:!0,cache:!0,ajax:{url:"parisabcd",dataType:"json",data:function(e){return{q:e.term}},processResults:function(e){return{results:e}}}}),l.find("#letterinputdashboard").select2({allowClear:!0,placeholder:"Choisir une lettre",cache:!0,minimumResultsForSearch:1/0,ajax:{url:"lettreabcd",dataType:"json",data:function(e){return{serie_nom:$(c+" #serieinputdashboard").val(),q:e.term}},processResults:function(e){console.log(e);var a=[];return $.each(e,function(e,r){a.push({id:r,text:r})}),{results:a}}}}),l.find("#stakeunitinputdashboard").keyup(function(){var e=$(c+" #amountperunit").val(),a=Number($(c+" #stakeunitinputdashboard").val()),r=Number(e)*Number(a),t=Math.round(100*r)/100;isNaN(t)||0>t?$(c+"#amountconversion").val("0"):$(c+" #amountconversion").val(t)}),l.find("#amountinputdashboard").keyup(function(){var e=$(c+" #amountperunit").val(),a=$(c+" #amountinputdashboard").val(),r=Number(a)/Number(e),t=Math.round(100*r)/100;$(c+" #flattounitconversion").val(isNaN(t)||0>t||""==e?"0":t)}),d(),t(),a(),e(),n()}function loadParisEnCours(){var e=$("#onglet_paris_en_cours"),a=e.find("span"),r=$("#parisencourstable");$.ajax({url:"dashboard/ajax/parisencours",data:{page:1},type:"get",success:function(e){$("#tab_15_1").html(e.vue),r.find(".subbetclick a").click(function(){$(this).find("i").hasClass("glyphicon-chevron-right")?($(this).find("i").removeClass("glyphicon-chevron-right"),$(this).find("i").addClass("glyphicon-chevron-down")):($(this).find("i").addClass("glyphicon-chevron-right"),$(this).find("i").removeClass("glyphicon-chevron-down"))}),0==e.count_paris_encours?a.text(""):a.html(e.count_paris_encours),featuresParisEnCours(),paginationParisEnCours()},error:function(e){$("#tab_15_1").html("<p>impossible de récuperer les paris</p>")}})}function loadParisTermine(){var e=$("#paristerminetable");$.ajax({url:"dashboard/ajax/paristermine",data:{page:1},type:"get",success:function(a){$("#tab_15_4").html(a),parisTermineDelete(),e.find(".boutonsupprimer").click(function(e){e.stopPropagation()}),$(".subbetclick a").click(function(){$(this).find("i").hasClass("glyphicon-chevron-right")?($(this).find("i").removeClass("glyphicon-chevron-right"),$(this).find("i").addClass("glyphicon-chevron-down")):($(this).find("i").addClass("glyphicon-chevron-right"),$(this).find("i").removeClass("glyphicon-chevron-down"))}),$(function(){$(".slimScrollTermine").slimScroll({height:"350px",allowPageScroll:!1,wheelStep:10,alwaysVisible:!0})}),$("#paristerminetable").tableSearch({})},error:function(e){$("#tab_15_4").html("<p>impossible de récuperer les paris terminés</p>")}})}function featuresParisEnCours(){$('[data-toggle="tooltip"]').tooltip(),$("[data-hover='tooltip']").tooltip(),$("#parisencourstable .boutonvalider").click(function(e){e.stopPropagation()}),$("#parisencourstable .boutonsupprimer").click(function(e){e.stopPropagation()}),$("#parisencourstable .boutoncashout").click(function(e){e.stopPropagation()}),$("#parisencourstable .boutonshowticket").click(function(e){e.stopPropagation()}),$("select[name='resultatDashboardInput']").click(function(e){e.stopPropagation()}),parisEnCoursCalculateStatus("#parisencourstable"),parisEnCoursEnclose("#parisencourstable",".validerform","historique"),parisEnCoursDelete("#parisencourstable",".supprimerform","encourspari/")}function paginationParisEnCours(){$("#tab_15_1").on("click",".pagination a",function(e){e.preventDefault();var a=getPaginationSelectedPage($(this).attr("href"));$.ajax({url:"dashboard/ajax/parisencours",data:{page:a},success:function(e){$("#tab_15_1").html(e.vue),featuresParisEnCours()},error:function(e){console.log("erreur: pagination par click")}})})}function loadParisEnCoursWithPage(e){var a=$("#parisencourstable .id").length,r=$("#tab_15_1").find(".active").find("span").text();"delete"==e&&1==a&&(r-=1),r?$.ajax({url:"dashboard/ajax/parisencours",data:{page:r},type:"get",success:function(e){$("#tab_15_1").html(e),featuresParisEnCours()}}):loadParisEnCours()}function cashOut(){var e=$("#cashoutModal");e.on("show.bs.modal",function(e){var a=$(e.relatedTarget).data("id");$(e.currentTarget).find('input[name="ticket-id"]').val(a)});var a=$("#cashout-update"),r=a.find("#cashout-select"),t=[{id:"c",text:"classic cash out"},{id:"p",text:"partial cash out"}];r.select2({minimumResultsForSearch:1/0,cache:!0,data:t}).change(function(){}),a.submit(function(r){r.preventDefault();var t=a.serialize();$.ajax({url:"cashout",type:"post",data:t,dataType:"json",success:function(a){if(a.etat)toastr.success(a.msg,a.head),loadParisEnCours(),loadParisTermine(),loadBookmakersOnDashboard(),loadParisLongTerme(),loadGeneralRecapsOnDashboard(),e.hide();else for(key in a.msg)keyname=key,toastr.error(a.msg[keyname],"Erreur:")},error:function(){}})})}function loadParisLongTerme(){$.ajax({url:"dashboard/ajax/parislongterme",data:{page:"1"},type:"get",success:function(e){$("#tab_15_2").html(e),$('[data-toggle="tooltip"]').tooltip(),$("#onglet_paris_long_terme span").text($("#parislongtermetable #count").text());{var a=($("#parislongtermetable"),$("#parislongtermetable .boutonvalider")),r=$("#parislongtermetable .boutonsupprimer"),t=$("#parislongtermetable .validerform"),n=$("#parislongtermetable .supprimerform"),o=$("#parislongtermetable select[name='resultatDashboardInput']");$("#parislongtermetable select[name='resultatDashboardInput'] option:selected")}$('[data-toggle="tooltip"]').tooltip(),a.click(function(e){e.stopPropagation()}),r.click(function(e){e.stopPropagation()}),o.click(function(e){e.stopPropagation()}),o.change(function(e){var a=$(this).closest(".mainrow"),r=a.find(".tdcote").text(),t=a.find(".tdmise .tdsubmise").text(),n=a.find(".tdretour span.subretour"),o=a.find(".tdretour");switch(result=a.find("select[name='resultatDashboardInput'] option:selected").text()){case"--Selectionnez--":n.empty(),o.css("color","black");break;case"Gagné":var s=parseFloat(t*r);o.css("color","green"),a.find(".tdretour span.subretour").text(s);break;case"Perdu":var s=parseFloat(t);o.css("color","red"),a.find(".tdretour span.subretour").text(s);break;case"1/2 Gagné":var s=parseFloat((t*r-t)/2)+parseFloat(t);o.css("color","green"),a.find(".tdretour span.subretour").text(s);break;case"1/2 Perdu":var s=parseFloat(t/2);o.css("color","red"),a.find(".tdretour span.subretour").text(s);break;case"Remboursé":o.css("color","black");var s=parseFloat(t);a.find(".tdretour span.subretour").text(s);
break;case"Annulé":o.css("color","black");var s=parseFloat(t);a.find(".tdretour span.subretour").text(s)}}),t.submit(function(e){e.preventDefault();var a=$(this).closest(".mainrow"),r=a.find(".tdretour span.subretour");if(r.text().length>0){var t=a.find(".tdcote").text(),n=a.find(".tdmise .tdsubmise").text(),o=$(this).serialize();$.ajax({url:"historique",type:"post",data:o+"&cote="+t+"&mise="+n+"&retour="+r,success:function(e){loadParisLongTerme()},error:function(){console.log("valider un pari long terme ne fonctionne pas")}})}else alert("Vous devez préciser un status pour ce pari.")}),n.submit(function(e){e.preventDefault();{var a=$(this).closest(".mainrow"),r=a.find(".id").text();a.find(".tdretour span.subretour"),a.find(".tdcote").text(),a.find(".tdmise .tdsubmise").text(),$(this).serialize()}confirm("Etes vous sur?")&&$.ajax({url:"historique/"+r,type:"delete",success:function(e){loadParisLongTerme()},error:function(){console.log("supprimer un pari long terme ne fonctionne pas")}})})},error:function(e){console.log("le chargement des paris long terme n'a pas fonctionné")}})}function calculProfits(e,a,r,t,n,o){var s,i,d=n,l=d,c=r,u=t,p=o,m=!1,h=!1,f=1,g="font-green-sharp",v="font-red-haze";if("simple"==e){var b=Number(c.find(".tdcote").text());0==a?s=1:1==a?f*=b:2==a?(f*=0,i=1):3==a?f*=[(b-1)/2+1]:4==a?f=.5*f:5==a&&(f+=0),s&&!i?(l="",m=!1,h=!0):(m=!0,l=f*d,l-=d,l=Number(Math.round(100*l)/100)),l>0?(u.addClass(g),p.addClass(g),u.removeClass(v),p.removeClass(v),u.removeClass("font-gray"),p.removeClass("font-gray")):0>l?(u.addClass(v),p.addClass(v),u.removeClass(g),p.removeClass(g),u.removeClass("font-gray"),p.removeClass("font-gray")):(u.addClass("font-gray"),p.addClass("font-gray"),u.removeClass(g),p.removeClass(g),u.removeClass(v),p.removeClass(v)),m?p.removeClass("hide"):p.addClass("hide"),l>0?h?u.html("+"+l):u.text("+"+l):h?u.html(l):u.text(l)}else c.find(".child-table-tr").each(function(){var e=Number($(this).find(".cote-td").text()),a=$(this).find('select[name="resultatSelectionDashboardInput[]"]').val();0==a?s=1:1==a?f*=e:2==a?(f*=0,i=1):3==a?f*=[(e-1)/2+1]:4==a?f=.5*f:5==a&&(f+=0)}),s&&!i?(l="",m=!1):(m=!0,l=f*d,l-=d,l=Number(Math.round(100*l)/100)),l>0?(u.addClass(g),p.addClass(g),u.removeClass(v),p.removeClass(v),u.removeClass("font-gray"),p.removeClass("font-gray")):0>l?(u.addClass(v),p.addClass(v),u.removeClass(g),p.removeClass(g),u.removeClass("font-gray"),p.removeClass("font-gray")):(u.addClass("font-gray"),p.addClass("font-gray"),u.removeClass(g),p.removeClass(g),u.removeClass(v),p.removeClass(v)),m?p.removeClass("hide"):p.addClass("hide"),u.text(l>0?"+"+l:l)}function statusBoutonValider(e,a,r){var t=a,n=r,o=new Array;if("simple"==e){var s=t.find('select[name="resultatSelectionDashboardInput[]"]').val();"0"==s?n.prop("disabled",!0):n.prop("disabled",!1)}else t.find(".child-table-tr").each(function(){var e=$(this).find('select[name="resultatSelectionDashboardInput[]"]').val();o.push(e)}),-1!==$.inArray("2",o)||-1==$.inArray("2",o)&&-1==$.inArray("0",o)?n.prop("disabled",!1):n.prop("disabled",!0)}function parisEnCoursCalculateStatus(e){$(e+" select[name='resultatSelectionDashboardInput[]']").change(function(){var a,r=($(e),$(this).closest(".mainrow")),t=$(this).val(),n=$(this).parents().hasClass("subrow");if(a=n?"combine":"simple","simple"==a){var a=r.find(".type").text(),o=(r.find(".tdcote").text(),r.find(".tdsubmise").text()),s=r.find(".profits"),i=r.find(".devise"),d=r.find(".boutonvalider");statusBoutonValider(a,r,d),calculProfits(a,t,r,s,o,i)}else{var l=$(this).closest(".subrow"),c=l.prev(),a=c.find(".mainrow").text(),d=c.find(".boutonvalider"),u=$(this).closest(".child-table-tr"),o=(u.find(".child-id").text(),u.find('input[name="childrowsinput[]"]').val(),c.find(".tdsubmise").text()),s=c.find(".profits"),i=c.find(".devise");statusBoutonValider(a,l,d),calculProfits(a,"",l,s,o,i)}})}function parisEnCoursDelete(e,a,r){var t=($(e),$(a),r);$(e+" "+a).submit(function(e){e.preventDefault();{var a=$(this).closest(".mainrow"),r=a.find(".id").text();a.find(".tdretour span.subretour"),a.find(".tdcote").text(),a.find(".tdmise .tdsubmise").text(),$(this).serialize()}swal({title:"Supprimer le ticket",text:"Etes-vous sur?",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Oui!",cancelButtonText:"Non, annuler",closeOnConfirm:!0,closeOnCancel:!0},function(e){e&&$.ajax({url:t+r,type:"delete",success:function(e){loadParisEnCours(),loadBookmakersOnDashboard(),0==e.etat?toastr.error(e.msg,"Suppression"):(toastr.success(e.msg,"Suppression"),loadBookmakersOnDashboard())},error:function(){console.log("supprimer un pari en cours ne fonctionne pas")}})})})}function parisEnCoursEnclose(e,a,r){var t=($(e),$(a),r);$(e+" "+a).submit(function(e){e.preventDefault();var a=$(this).closest(".mainrow"),r=($(this).closest(".wrapperRow"),a.find(".tdretour span.subretour"),a.find(".id").text()),n=[],o=[],s=(a.next().find(".child-row input"),a.find(".type").text());"simple"==s?(n=a.find('select[name="resultatSelectionDashboardInput[]"]').serialize(),o=a.find('input[name="childrowsinput[]"]').serialize()):(n=a.next().find('select[name="resultatSelectionDashboardInput[]"]').serialize(),o=a.next().find('input[name="childrowsinput[]"]').serialize()),$.ajax({url:t,type:"post",data:n+"&"+o+"&ticket-id="+r,dataType:"json",success:function(e){0==e.etat?toastr.error(e.msg,"Validation"):(toastr.success(e.msg,"Validation"),loadParisEnCours(),loadParisTermine(),loadBookmakersOnDashboard(),loadGeneralRecapsOnDashboard())},error:function(){console.log("valider un pari en cours ne fonctionne pas")}})})}function parisTermineDelete(){var e="#paristerminetable",a=".supprimerform",r="historique/";$(e+" "+a).submit(function(e){e.preventDefault();var a=$(this).closest(".mainrow"),t=a.find(".id").text();swal({title:"Supprimer le ticket",text:"Etes-vous sur?",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Oui!",cancelButtonText:"Non, annuler",closeOnConfirm:!0,closeOnCancel:!0},function(e){e&&$.ajax({url:r+t,type:"delete",success:function(e){0==e.etat?toastr.error(e.msg,"Suppression"):(toastr.success(e.msg,"Suppression"),loadParisTermine(),loadBookmakersOnDashboard(),loadGeneralRecapsOnDashboard())},error:function(){console.log("supprimer un pari en cours ne fonctionne pas")}})})})}parisEnCoursDelete(),getBookmakersForSelection(),loadParisEnCours(),cashOut(),loadParisLongTerme(),loadParisTermine(),loadGeneralRecapsOnDashboard(),loadBookmakersOnDashboard(),gestionTicket(),addManualCouponSelection(),$("#defaultrange").daterangepicker({opens:"left",format:"DD/MM/YYYY",timeZone:moment("Europe/Paris"),ranges:{"Aujourd'hui":[moment(),moment()],Hier:[moment().subtract(1,"days"),moment().subtract(1,"days")],"Cette Semaine":[moment().startOf("isoweek"),moment().endOf("isoweek")],"Semaine Précédente":[moment().subtract(1,"week").startOf("isoweek"),moment().subtract(1,"week").endOf("isoweek")],"Ce Mois":[moment().startOf("month"),moment().endOf("month")],"Mois Précédent":[moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]}},function(e,a){$("#defaultrange input").val(e.format("DD/MM/YYYY")+" - "+a.format("DD/MM/YYYY"))}).on("apply.daterangepicker",function(e,a){loadGeneralRecapsOnDashboard()}),$("#WelcomeModal").modal({keyboard:!1,backdrop:"static"});