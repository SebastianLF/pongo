function gestionTipsters(){function t(){$.ajax({url:"my-tipsters-view-list",type:"get",success:function(t){alert(t),$(_).html(t),e(),s()}})}function r(){var r=$("#tipsterform-add");r.submit(function(e){e.preventDefault();r.find("#name_tipster"),r.find("#amount_tipster"),r.find("#suivi_tipster"),r.find("#nameinputerror"),r.find("#unitnumberinputerror"),r.find("#followtypeselecterror");$("#tipsterAddModal").on("hide.bs.modal",function(){r.find("#name_container").removeClass("has-error"),r.find("#amount_container").removeClass("has-error"),r.find("#suivi_container").removeClass("has-error"),r.find("#name_error").empty(),r.find("#amount_error").empty(),r.find("#suivi_error").empty(),r.find(n).val(""),r.find(p).val(""),r.find(d).find('option[value="n"]').attr("selected",!0)}),$.ajax({url:"tipster",data:$("#tipsterform-add").serialize(),type:"POST",dataType:"json",success:function(e){0==e.success?(e.errors.name_tipster?(r.find("#name_container").addClass("has-error"),r.find("#name_error").html(e.errors.name_tipster)):(r.find("#name_container").removeClass("has-error"),r.find("#name_error").empty()),e.errors.amount_tipster?(r.find("#amount_container").addClass("has-error"),r.find("#amount_error").html(e.errors.amount_tipster)):(r.find("#amount_container").removeClass("has-error"),r.find("#amount_error").empty()),e.errors.suivi_tipster?(r.find("#suivi_container").addClass("has-error"),r.find("#suivi_error").html(e.errors.suivi_tipster)):(r.find("#suivi_container").removeClass("has-error"),r.find("#suivi_error").empty())):(t(),toastr.success("Le tipster à été crée avec <strong>succès</strong>!","Tipster"),$("#tipsterAddModal").modal("hide"))}})})}function e(){var t=$("#tipsterform-edit");$(".tipsterEditButton").click(function(){var r=$(this).attr("data-suivi");t.find(c).val($(this).attr("data-id")),t.find(n).val($(this).attr("data-name")),t.find(p).val($(this).attr("data-mt")),t.find(d+' option[value="'+r+'"]').prop("selected",!0)})}function i(){var r=$("#tipsterform-edit");r.submit(function(e){e.preventDefault();var i=$(this).find(c).val(),s=$(this).serialize();$("#tipsterEditModal").on("hide.bs.modal",function(){r.find(a).removeClass("has-error"),r.find(f).removeClass("has-error"),r.find(u).removeClass("has-error"),r.find(o).empty(),r.find(m).empty(),r.find(l).empty(),r.find(n).val(""),r.find(p).val(""),r.find(d).find('option[value="n"]').attr("selected",!0)}),$.ajax({url:"tipster/"+i,method:"PUT",data:s,dataType:"json",success:function(e){e.state?(t(),toastr.success("Le tipster à été modifié avec <strong>succès</strong>!","Tipster"),$("#tipsterEditModal").modal("hide")):(e.errors.name_tipster?(r.find(a).addClass("has-error"),r.find(o).html(e.errors.name_tipster)):(r.find(a).removeClass("has-error"),r.find(o).empty()),e.errors.amount_tipster?(r.find(f).addClass("has-error"),r.find(l).html(e.errors.amount_tipster)):(r.find(f).removeClass("has-error"),r.find(l).empty()),e.errors.suivi_tipster?(r.find(u).addClass("has-error"),r.find(m).html(e.errors.suivi_tipster)):(r.find(u).removeClass("has-error"),r.find(m).empty()))}})})}function s(){$("#tipsterstable").on("click",".tipsterDeleteButton",function(r){r.preventDefault();var e=$(this).parents("tr"),i=e.find(v).text(),s="tipster/"+i;swal({title:"Supprimer",text:"Etes vous sur ?",type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Oui, supprimer",cancelButtonText:"Non, annuler",closeOnConfirm:!0,closeOnCancel:!0},function(r){if(r){$.ajax({url:s,method:"DELETE",dataType:"json",success:function(r){1==r.state?(toastr.success("supprimé avec <strong>succès</strong> !","Tipster"),t()):2==r.state?swal("Attention!","Vous devez d'abord supprimer les tickets en cours liés à ce tipster.","error"):0==r.state&&swal("Attention!","Ce tipster n'existe pas","error")}})}})})}var n="input[name='name_tipster']",a="#name_container",o="#name_error",d="select[name='suivi_tipster']",u="#suivi_container",m="#suivi_error",p="input[name='amount_tipster']",f="#amount_container",l="#amount_error",c="input[name='id']",v=".idtipstertd",_="#tipsters-pagination";t(),r(),i()}gestionTipsters();