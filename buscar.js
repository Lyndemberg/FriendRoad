flatpickr("#dataViagem", {
	minDate: "today"
});

var map;
var displayObject = false;
origem.onclick=function(){
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
								locationOrigem.value = results[0].geometry.location.lat()+" "+results[0].geometry.location.lng();
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

destino.onclick=function(){
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
					locationDestino.value = results[0].geometry.location.lat()+" "+results[0].geometry.location.lng();
					if (textoOrigem.value != "") {
						criaDirection(textoOrigem.value, textoDestino.value, map);
					} else {
						abrirEscolherLocal(results[0].geometry.location);
					}

				}

			});
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
			locationOrigem.value = results[0].geometry.location.lat()+" "+results[0].geometry.location.lng();
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

function criaDirection(origem, destino, mapa) {
	if (displayObject) {
		displayObject.setMap(null);
	}
	var servico = new google.maps.DirectionsService();
	var render = new google.maps.DirectionsRenderer();
	servico.route({
		origin: origem,
		destination: destino,
		travelMode: google.maps.TravelMode.DRIVING,
	}, function (results, status) {

		if (status == google.maps.DirectionsStatus.OK) {
			render.setDirections(results);
			render.setMap(mapa);
			displayObject = render;
		}
	});
}


function loadScript() {
	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDNRg0GX1uE_jorzRcTAbP2c1r9wx5B9Rs";
	document.body.appendChild(script);
}
window.onload = loadScript;
