function validar_tipo_extension(dato)
{
	 var extensionesValidas = ".jpg, .jpeg, .gif, .png, .pdf, .doc, .docx, .jfif";
	 var extension = dato.substring(dato.lastIndexOf('.') + 1).toLowerCase();
 	 var extensionValida = extensionesValidas.indexOf(extension);

	if(extensionValida < 0) 
	{
     alert("Solo se permiten archivos con formato .jpg, .jpeg, .gif, .png, .pdf, .doc, .docx, .jfif")
	 return false;
     }  else 
         return true;
}


function validar_peso(input) 
{
        var pesoPermitido = 1024;
        if (input.files && input.files[0]) 
        {
		    var pesoFichero = input.files[0].size/1024;

		    if(pesoFichero > pesoPermitido) 
		    {
		       alert("Solo se permiten archivos con peso inferior a 1 Mb")
        	   return false;
        	}else
        	   return true;

		    
		}
}

function validar_tipo_extension_video(dato)
{
	 var extensionesValidas = ".mp4";
	 var extension = dato.substring(dato.lastIndexOf('.') + 1).toLowerCase();
 	 var extensionValida = extensionesValidas.indexOf(extension);

	if(extensionValida < 0) 
	{
     alert("Solo se permiten archivos de video con formato .mp4")
	 return false;
     }  else 
         return true;
}


function validar_peso_video(input) 
{
        var pesoPermitido = 1048576;
        if (input.files && input.files[0]) 
        {
		    var pesoFichero = input.files[0].size/1024;

		    if(pesoFichero > pesoPermitido) 
		    {
		       alert("Solo se permiten archivos de video con peso inferior a 1 GB")
        	   return false;
        	}else
        	   return true;

		    
		}
}