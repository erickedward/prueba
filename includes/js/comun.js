function menu(){
	enviar_ajax('/includes/vistas/menu.html',"nav_principal")
}

function enviar_ajax(archivo,div){
	$.ajax({

          url: archivo,
          type: 'POST',
          dataType:"html",
          success: function(data) {
            var inf = data.split("¬");

            if(inf.length>1){
              switch(inf[0]){
                case "0":
                  mostrar_errores(inf[1],"e","contenedor_errores");
                  //$("#contenedor_errores").html();
                break;
                case "1":
                  $("#"+div).html(data);
                break;
                default:
                  mostrar_errores("Disculpe, en estos momentos no podemos procesar su solicitud.","e","contenedor_errores");
                break;
              }
            }else{
              $("#"+div).html(data);
            }//end if
            
          },
          error: function(jqXHR, textStatus, error) {

            alert( "error: " + jqXHR.responseText);
          }
        });
}


function mostrar_errores(errores,tipo,div="mensaje_validacion_extra"){
  var informacion = '';
  if (div!='return') document.getElementById(div).innerHTML = informacion;
  if (errores!=""){
    switch(tipo){
      case "e":
        informacion = '<div class="alert alert-danger"><a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a><div style="padding-left:10px">'+errores+'</div></div>';
      break;
      case "i":
        informacion = '<div class="alert alert-info"><a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a><div style="padding-left:10px">'+errores+'</div></div>';
      break;
      case "w":
        informacion = '<div class="alert alert-warning"><a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a><div style="padding-left:10px">'+errores+'</div></div>';
      break;
      case "s":
        informacion = '<div class="alert alert-success"><a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a><div style="padding-left:10px">'+errores+'</div></div>';
      break;
      default:
        informacion = '<div class="alert alert-info"><a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a><div style="padding-left:10px">'+errores+'</div></div>';
      break;
    }//end switch
    if (div=='return'){
      return informacion;
    }else{
      document.getElementById(div).innerHTML = '<table width="90%" align="center"><tr><td>'+informacion+'</td></tr></table>';
      document.getElementById(div).style.height = 'auto';
      document.location.href = "#ancla";
    }//end if
  }//end if
}//end function
