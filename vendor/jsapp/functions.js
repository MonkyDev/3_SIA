

function calcularPeriodo (grado, ciclo, anio, plan_esc){

	var periodos = new Array();
	periodos["sem"] = [null, "01-06", "08-12"];
	periodos["cua"] = [null, "01-04", "05-08", "09-12"];

	grado_actual = grado, anio_actual = anio, ciclo_actual = parseInt(ciclo), entry = 0;
	periodo_actual ="";
	modalidad = plan_esc.toLowerCase();
	mod = modalidad.substring(0, 3);
	no_per =  (periodos[mod].length) - 1;

	switch (mod) {
		case "cua":
			if (ciclo_actual <= 1)
				indx_periodo = 1;
			else if (ciclo_actual > 1 && ciclo_actual < 9)
				indx_periodo = 2;
			else
				indx_periodo = 3;			
			break;

		case "sem":
			if (ciclo_actual <= 1)
				indx_periodo = 1;
			else 
				indx_periodo = 2;				
			break;

		default:
			indx_periodo = false;
			break;
	}

	for (var i = grado_actual; 1 <= i; i--) {

		if (no_per === 2) { 
			if (indx_periodo > 1){ //indx_periodo = 2
					periodo_actual = /*i+"=>"+*/periodos[mod][indx_periodo]+"-"+(anio_actual)
					indx_periodo = 1;
					entry = 0;

			} else { //indx_periodo = 1 			
				if (entry < 1){ //entry = 0
					periodo_actual = /*i+"=>"+*/periodos[mod][indx_periodo]+"-"+(anio_actual--);
					indx_periodo = 2;
					entry++;
				}			
			}

		} else if(no_per === 3) {
			if (indx_periodo > 2) { //indx_periodo = 3
				if (entry > 0 && entry < 2) { //entry = 1
					periodo_actual = /*i+"=>"+*/periodos[mod][indx_periodo]+"-"+(anio_actual);
					indx_periodo = 2;
					entry++;
				}	
			} else if (indx_periodo > 1 && indx_periodo < 3) { //indx_periodo = 2
				periodo_actual = /*i+"=>"+*/periodos[mod][indx_periodo]+"-"+(anio_actual);
				indx_periodo = 1;
				entry = 0;

			} else { //indx_periodo = 1
				if (entry < 1) { //entry = 0
					periodo_actual = /*i+"=>"+*/periodos[mod][indx_periodo]+"-"+(anio_actual--);
					indx_periodo = 3;
					entry++; 
				} 
			}

		} else 
			return null;
	}

return periodo_actual;
}




function trun(elmt, lng, typ){
	
	var frm = $('form').attr('class');
	val = $("."+frm+' #'+elmt).val();
	$("."+frm+' #'+elmt).attr("maxlength", lng);

	var regex;
	switch (typ) {
		case 1: /*any numbers*/
			regex = /^[0-9]+$/i;
			break;
		case 2: /*when is celular*/
			regex = /^\+?([0-9]|[-|' '])+$/i;
			break;
		case 3: /*when is numbers, acept slash and space*/
			regex = /^\+?([0-9]|[/|' '])+$/i;
			break;
		case 4: /*when is letras*/
            regex = /^([A-zÀ-ÿ\u00f1\u00d1]|[' '])+$/i;
			break;
		case 5: /*when is search*/
            regex = /^([A-z0-9À-ÿ\u00f1\u00d1]|[-' '])+$/i;
			break;
		case 'id': /*when is id*/
            regex = /^([A-z0-9]|[-_/])+$/i;
			break;

	}
	jsRegex = new RegExp(regex).test(val);
    if( val && !jsRegex ){
    	reval = val.substring(0,val.length-1);
 			$("."+frm+' #'+elmt).val(reval);
	  }
}


function newPick() 
{
  document.getElementById("ocho").disabled = false;
  document.getElementById("ocho").style.display = "block";
  document.getElementById("max").disabled = false;
  document.getElementById("btn").style.display = "none";
}