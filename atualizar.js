		
		var map;
		var displayObject = false;
		var origemGeo;
		var destinoGeo;
		var passagens = [];
		var passagensGeo = [];
		var dataChegada;
		var horaChegada;
		var dataViagem;
		var horaViagem;
	
		var dataAntiga;
		var horaAntiga;

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
				waypoints: passagens
			}, function (results, status) {

				if (status == google.maps.DirectionsStatus.OK) {
					render.setDirections(results);
					render.setMap(map);
					var rota = results.routes[0];
					var quantidadeLegs = rota.legs.length;
					var totalDistancia = null;
					for (var i = 0; i < quantidadeLegs; i++) {
						totalDistancia = totalDistancia + rota.legs[i].distance.value;
					}
					totalDistancia = totalDistancia / 1000;
					textoDistancia.value = totalDistancia.toFixed(1);
					var totalSegundos = null;
					for (var k = 0; k < quantidadeLegs; k++) {
						totalSegundos = totalSegundos + rota.legs[k].duration.value;
					}

					if (dataViagem != null && horaViagem != null) {
						calculaHoraChegada(totalSegundos);
					}

					displayObject = render;
				}

			});

		}

		data.onchange = function(){
			dataViagem = data.value;
			if (horaViagem != null) {
				criaDirection(textoOrigem.value, textoDestino.value, map);
			}
		}
		hora.onchange = function(){
			horaViagem = hora.value;
			if (dataViagem != null) {
				criaDirection(textoOrigem.value, textoDestino.value, map);
			}
		}
		
		

		function calculaHoraChegada(segundos) {
			//PEGANDO O VALOR DA DATA DO INPUT E QUEBRANDO
			var dataInput = dataViagem;
			var ano = dataInput[0] + dataInput[1] + dataInput[2] + dataInput[3];
			var mes = dataInput[5] + dataInput[6];
			var dia = dataInput[8] + dataInput[9];
			//PEGANDO O VALOR DA HORA DO INPUT E QUEBRANDO
			var horaInput = horaViagem;
			var hora = horaInput[0] + horaInput[1];
			var minuto = horaInput[3] + horaInput[4];

			var data = new Date(ano, (mes - 1), dia);
			data.setHours(hora);
			data.setMinutes(minuto);

			data.setTime(data.getTime() + (segundos * 1000));

			textoHora.value = data.toLocaleDateString() + " às " + data.toLocaleTimeString();
		}

		function removePassagem(item) {
			var elemento = "passagem" + item[5];
			//$("#"+item).remove();
			$("#" + elemento).remove();
			passagens.splice(item[5], 1);
			passagensGeo.splice(item[5], 1);
			criaDirection(textoOrigem.value, textoDestino.value, map);
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
								passagensGeo.push(results[0].geometry.location.lat() + " " + results[0].geometry.location.lng());
								criaDirection(textoOrigem.value, textoDestino.value, map);
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
							destinoGeo = results[0].geometry.location.lat() + " " + results[0].geometry.location.lng();
							if (textoOrigem.value != "") {
								criaDirection(textoOrigem.value, textoDestino.value, map);
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
										origemGeo = results[0].geometry.location.lat() + " " + results[0].geometry.location.lng();
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
					origemGeo = results[0].geometry.location.lat() + " " + results[0].geometry.location.lng();
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

		$('#buttonAtualizar').click(function () {
			$.ajax({
					method: "POST",
					url: "enviaAtualizar.php",
					data: {
						dataAntiga: dataAntiga,
						horaAntiga: horaAntiga,
						origem: textoOrigem.value,
						destino: textoDestino.value,
						origemGeo: origemGeo,
						destinoGeo: destinoGeo,
						passagensGeo: JSON.stringify(passagensGeo),
						passagens: JSON.stringify(passagens),
						dataViagem: data.value,
						horaViagem: hora.value,
						distancia: textoDistancia.value,
						horaChegada: textoHora.value,
						ajuda: ajudaCusto.value,
					}
				})
				.done(function (retorno) {
				
					if (retorno == true) {
						swal("Sucesso", "A sua carona foi atualizada com sucesso!", "success");
						setTimeout(function () {
							window.location.href = "telaInicial.php";
						}, 2000);

					} else {
						swal("Falha", "A sua carona não foi atualizada", "error");
					}

				});
		});



	
