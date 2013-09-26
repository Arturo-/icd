$(function() { 
	//var urlReg = /^(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)( [a-zA-Z0-9\-\.\?\,\'\/\\\+&%\$#_]*)?$/;
        
        
        $(".submit").click(function(){  
            
            $(".field_empty").fadeOut().remove();
            
            if(!$("input[name='digital_resource_type']:radio").is(':checked')) {  
                //alert("Indique el tipo de recurso a postular"); 
                 $(".indique").focus().after('<span class="field_empty">Indique el tipo de recurso a postular</span>');
                return false; 

            }else{
                
                if($('input:radio[name=digital_resource_type]:checked').val() == 'U' ){
//                    if($(".validDigitalResourceUrl").val() != ""){
//                       if (!urlReg.test($(".validDigitalResourceUrl").val())) {
//                           $(".validDigitalResourceUrl").focus().after('<span class="field_empty">Ingrese un url valido</span>');  
//                           //alert('El campo Correo electrónico alternativo tiene un formato incorrecto.\n\nEl campo se encuentra en la pestaña Información del usuario.');
//                           return false; 
//                       }
//                    }

                    if($(".validDigitalResourceUrl").val() == ""){
                       $(".validDigitalResourceUrl").focus().after('<span class="field_empty">Ingrese una url por favor</span>');  
                        //alert('El campo Correo electrónico alternativo tiene un formato incorrecto.\n\nEl campo se encuentra en la pestaña Información del usuario.');
                        return false; 
                    }
 
                }

                if($('input:radio[name=digital_resource_type]:checked').val() == 'F' ){
                    //alert('hola');
                    $('.arrayDRF').each(function(){
                       //alert($(this).val());
                       segundoElementoEnElArray = $(this).val();
                    });
                    
                    if(segundoElementoEnElArray == ""){
                        alert('Por favor, seleccione algún contenido digital');
                        $(".prueba").focus().after('<span class="field_empty">Por favor, seleccione algún contenido digital</span>');  
                        return false;
                    }
//                    else{
//                        alert('no vacio');
//                    }

                    //alert($("input[name='DigitalResourcesFiles[]']").length);
                }
            }      



//           if($(".validDigitalResourceTitle").val() == ""){
//                $(".validDigitalResourceTitle").focus().after('<span class="field_empty">Por favor, ingrese el título del recurso digital</span>');  
//                //alert('Por favor, ingrese el título del recurso digital');
//                return false; 
//           }

            if($(".validDigitalResourceDescription").val() == ""){
                $(".validDigitalResourceDescription").focus().after('<span class="field_empty">Por favor, ingrese una descripción del recurso digital</span>');  
                //alert('Por favor, ingrese una descripción  del recurso digital');
                return false; 
           }
      
        
    }); 
    

});
