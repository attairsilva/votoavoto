function CriaRequest() {
     try{
         request = new XMLHttpRequest();
     }catch (IEAtual){

         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");
         }catch(IEAntigo){

             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");
             }catch(falha){
                 request = false;
             }
         }
     }

     if (!request)
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
 }

 /**
  * Função para enviar os dados
  */
 function getDados(a) {

     // Declaração de Variáveis
     var nome   = document.getElementById("txtnome"+a).value;
	 if(nome=='votacao_acao.php') var busca  = document.getElementById("busca").value;
	 if(nome=='votacao_acao_confirma.php') var confirma = document.getElementById("confirma").value;
	 var result = document.getElementById("Resultado");
     var xmlreq = CriaRequest();

     // Exibi a imagem de progresso
     result.innerHTML = '<center><img src="Progresso1.gif" width="30%"/></center>';

     // Iniciar uma requisição
	 if(nome=='votacao_acao_confirma.php') { 
	 	
		xmlreq.open("GET", nome + '?busca='+ busca+'&confirma='+confirma, true); 
	
	}else{ 
	
		if(nome=='votacao_acao.php') { 
				 
				  xmlreq.open("GET", nome + '?busca='+ busca, true); 
				  
		}else{  
		
			  	xmlreq.open("GET", nome, true); 
		
		} 
	}
	

     // Atribui uma função para ser executada sempre que houver uma mudança de ado
     xmlreq.onreadystatechange = function(){

         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {

             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }
