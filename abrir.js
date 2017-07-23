var map;
var displayObject = false;
var passagens = [];

function criaDirection(origem, destino, mapa, passagens) {
	if (displayObject) {
		displayObject.setMap(null);
	}
	var servico = new google.maps.DirectionsService();
	var render = new google.maps.DirectionsRenderer();
	servico.route({
		origin: origem,
		destination: destino,
		travelMode: google.maps.TravelMode.DRIVING,
		waypoints: passagens
	}, function (results, status) {

		if (status == google.maps.DirectionsStatus.OK) {
			render.setDirections(results);
			render.setMap(mapa);

			displayObject = render;
		}

	});

}

function removePassagem(item){
	var elemento = "passagem"+item[5];
	//$("#"+item).remove();
	$("#"+elemento).remove();
	passagens.splice(item[5],1);
	criaDirection(textoOrigem.value, textoDestino.value, map, passagens);
	
}

function adicionaPassagemHTML(passagem) {
	$("#recebePassagens").append("<div id='passagem" + (passagens.length - 1) + "' class='chip'>" + passagem + "<span onclick='removePassagem(this.id)' id='fecha" + (passagens.length - 1) + "' class='closebtn'>&times;</span></div>");
	//$("#"+passagem+""+passagens.length-1).append("");
	
	//$("#recebePassagens").append("<div id=passagem" + (passagens.length - 1) + " class='chip'>"+passagem+"</div>").append( "<span //onclick='removePassagem(this.id)' id=fecha" + (passagens.length - 1) + " class='closebtn'>&times;</span>");
}



passagem.onclick = function () {
	if (textoOrigem.value && textoDestino.value) {
		swal({
				title: "Ponto de passagem",
				text: "Digite abaixo o ponto de passagem",
				type: "input",
				showCancelButton: true,
				closeOnConfirm: true,
				animation: "slide-from-top",
				inputPlaceholder: "Escreva aqui..."
			},
			function (inputValue) {
				if (inputValue === false) return false;

				if (inputValue === "") {
					swal.showInputError("Não pode ser vazio");
					return false
				}

				var geocoder = new google.maps.Geocoder();

				geocoder.geocode({
					address: inputValue,
					region: "br"
				}, function (results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						passagens.push({
							location: inputValue
						});
						criaDirection(textoOrigem.value, textoDestino.value, map, passagens);
						adicionaPassagemHTML(inputValue);
					}
				});
			});
	} else {
		sweetAlert("Oops...", "Defina primeiro a origem e destino	", "error");
	}

}
destino.onclick = function () {
	swal({
			title: "Escreva o seu destino",
			text: "Digite abaixo o lugar de destino",
			type: "input",
			showCancelButton: true,
			closeOnConfirm: true,
			animation: "slide-from-top",
			inputPlaceholder: "Escreva aqui..."
		},
		function (inputValue) {
			if (inputValue === false) return false;

			if (inputValue === "") {
				swal.showInputError("Não pode ser vazio");
				return false
			}
			var geocoder = new google.maps.Geocoder();

			geocoder.geocode({
				address: inputValue,
				region: "br"
			}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					textoDestino.value = inputValue;
					if (textoOrigem.value != "") {
						criaDirection(textoOrigem.value, textoDestino.value, map, passagens);
					} else {
						abrirEscolherLocal(results[0].geometry.location);
					}

				}

			});
		});
}

origem.onclick = function () {
	swal({
			title: "Definir local",
			text: "Escolha uma das duas opções",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Outro local",
			cancelButtonText: "Local atual",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function (isConfirm) {
			if (isConfirm) {
				swal({
						title: "Escreva o lugar",
						text: "Digite abaixo um lugar",
						type: "input",
						showCancelButton: true,
						closeOnConfirm: true,
						animation: "slide-from-top",
						inputPlaceholder: "Escreva aqui..."
					},
					function (inputValue) {
						if (inputValue === false) return false;

						if (inputValue === "") {
							swal.showInputError("Não pode ser vazio");
							return false
						}
						var geocoder = new google.maps.Geocoder();
						geocoder.geocode({
							address: inputValue,
							region: "br"
						}, function (results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								textoOrigem.value = inputValue;
								if (textoDestino.value != "") {
									criaDirection(textoOrigem.value, textoDestino.value, map);
								} else {
									abrirEscolherLocal(results[0].geometry.location);
								}

							}

						});

					});
			} else {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(abrirLocalAtual);
				} else {
					swal("Seu navegador não tem suporte a geolocalização");
				}

			}
		});

}

function abrirEscolherLocal(lugar) {

	map = new google.maps.Map(document.getElementById('mapa'), {
		center: lugar,
		zoom: 8
	});

	var marker = new google.maps.Marker({
		position: lugar,
		map: map,
		title: 'Hello World!'
	});

}

function abrirLocalAtual(position) {
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		location: {
			lat: position.coords.latitude,
			lng: position.coords.longitude
		},
		region: "br"
	}, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			textoOrigem.value = results[1].formatted_address;
			if (textoDestino.value != null) {
				criaDirection(textoOrigem.value, textoDestino.value, map);
			}
		}

	});



	map = new google.maps.Map(document.getElementById('mapa'), {
		center: {
			lat: position.coords.latitude,
			lng: position.coords.longitude
		},
		zoom: 8
	});

	var marker = new google.maps.Marker({
		position: {
			lat: position.coords.latitude,
			lng: position.coords.longitude
		},
		map: map,
		title: 'Sua localização atual!'
	});
	marker.setLabel("Você está aqui");


}

function loadScript() {
	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDNRg0GX1uE_jorzRcTAbP2c1r9wx5B9Rs";
	document.body.appendChild(script);
}
window.onload = loadScript;