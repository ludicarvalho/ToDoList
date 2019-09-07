function Grv() {
	val = $("#txtDescricao").val();
	$.ajax({
		type: "POST",
		url: "gravar.php",
		data: {descricao: val},
		success: null,
		dataType: "json"
	}).done(function(response) {
		if (response.status == true) {
			//alert("Gravou com sucesso.");
			//Colocar a função Gravar neste escopo
			Cartao(response.lstid, val, response.dt, response.hora);
		}
		else
			alert("A requisição falhou.");
	}).fail(function(xhr, desc, err) {
		/*
		* Caso haja algum erro na chamada Ajax,
		* o utilizador é alertado e serão enviados detalhes
		* para o console do javascript que pode ser visualizada 
		* através das ferramentas de desenvolvedor do navegador.
		*/
		alert('Ops! Ocorreu algum erro!');
		console.log(xhr);
		console.log("Detalhes: " + desc + "\nErro:" + err);
	});
}
function Contar() {
	var campo = document.getElementById("txtDescricao");
	var resul = document.getElementById("res");

	if (campo.value != "")
		resul.innerHTML = '<strong>' + (250 - campo.value.length) + '</strong> caracteres restantes.';
	else
		resul.innerHTML = 'Até <strong>250</strong> caracteres.';
}
function Apagar(id) {
	if (confirm("Deseja apagar anotação " + id + "?") == true) {
		cardExcluir = document.querySelector("div[data-id='" + id + "']");
		cardExcluir.parentNode.removeChild(cardExcluir);
		AbrirPopUp("apagar.php?id=" + id, 150,150);
	}
	else
		return;
}
function Editar(id) {
	AbrirPopUp("editar.php?id=" + id, 460,370);
}
function AbrirPopUp(pagina,largura,altura) {
	if (largura != null) {
		window.open(pagina, "", "width=" + largura + ",height=" + altura + ",scrollbars=no,top=125,left=350,resizable=no");
	}
	else {
		window.open(pagina, "", "scrollbars=no,resizable=no,top=100,left=250,width=1100,height=600");
	}
}

function Cartao(id, descricao, data, hora) {
	//inserir dentro de div#corpo
	var card = document.createElement("div");
	card.classList.add("card");
	card.setAttribute("data-id", id);

	var cardHeader = document.createElement("div");
	cardHeader.classList.add("card-header");

	var cardBody = document.createElement("div");
	cardBody.classList.add("card-body");

	var cardFooter = document.createElement("div")
	cardFooter.classList.add("card-footer");

	/* Cabeçalho */
	var spTxt = document.createElement("span");

	spTxt.classList.add("float-left");

	var titulo = 'Anotação: <span id="contador">' + id + '</span>' +
				'<span class="float-right btn btn-sm btn-danger" title="Excluir" onclick="Apagar(' + id + ')">' +
				'<strong>X</strong>' +
				'</span>' +
				'<span class="float-right btn btn-sm btn-warning" title="Aletrar" onclick="Editar(' + id + ')">'+
				'<strong>O</strong>' +
				'</span>';
	cardHeader.innerHTML = titulo;
	card.appendChild(cardHeader);
	/*          */

	/* Corpo */
	var txtCorpo = '<div class="text-card">' + descricao + '</div>';
	cardBody.innerHTML = txtCorpo;
	card.appendChild(cardBody);
	/*        */

	/* Rodapé */
	var txtRodape = '<small class="text-muted"><strong>Data: </strong>' + data + '</small>' +
					'<br />' +
					'<small class="text-muted"><strong>Hora: </strong>' + hora + '</small>';
	cardFooter.innerHTML = txtRodape;
	card.appendChild(cardFooter);
	/*        */

	var local = document.getElementById("corpo");
	local.appendChild(card);

}
