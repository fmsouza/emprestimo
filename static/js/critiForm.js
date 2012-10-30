$(document).ready(function criticize(){
	
	$("#cadastro_usuario").validate({
		rules:{
			cpf: "required",
			nome: "required",
			identidade: "required",
			endereco: "required",
			profissao: "required",
			email: "required",
			tel_fixo: "required",
			tel_celular: "required",
			senha: {
				required: true,
				minlength: 6
			},
			csenha: {
				required: true,
				minlength: 6,
				equalTo: "#senha"
			}
		},
		messages:{
			cpf: "<span class='validate'>Digite seu CPF corretamente</span>",
			nome: "<span class='validate'>Digite seu nome corretamente</span>",
			identidade: "<span class='validate'>Digite sua identidade corretamente</span>",
			endereco: "<span class='validate'>Digite seu endereço corretamente</span>",
			profissao: "<span class='validate'>Digite sua profissão corretamente</span>",
			email: "<span class='validate'>Digite um e-mail válido</span>",
			tel_fixo: "<span class='validate'>Digite um número de telefone fixo válido</span>",
			tel_celular: "<span class='validate'>Digite um número de telefone celular válido</span>",
			senha: {
				required: "<span class='validate'>Digite uma senha</span>",
				minlength: "<span class='validate'>Sua senha deve ter, no mínimo, 6 caracteres</span>"
			},
			csenha: {
				required: "<span class='validate'>Digite uma senha</span>",
				minlength: "<span class='validate'>Sua senha deve ter, no mínimo, 6 caracteres</span>",
				equalTo: "<span class='validate'>Senhas não conferem</span>"
			}
		}
	});
	
	$("#cadastro_mapas").validate({
		rules:{
			titulo: "required",
			ano: "required",
			prazo: "required",
			valor: "required",
			autor: "required"
		},
		messages:{
			titulo: "<span class='validate'>Digite o título corretamente</span>",
			ano: "<span class='validate'>Digite o ano corretamente</span>",
			prazo: "<span class='validate'>Preencha o prazo corretamente</span>",
			valor: "<span class='validate'>Digite o valor corretamente</span>",
			autor: "<span class='validate'>Digite o nome do autor</span>"
		}
	});
	
	$("#cadastro_teses").validate({
		rules:{
			titulo: "required",
			ano: "required",
			editora: "required",
			prazo: "required",
			valor: "required",
			autor: "required"
		},
		messages:{
			titulo: "<span class='validate'>Digite o título corretamente</span>",
			ano: "<span class='validate'>Digite o ano corretamente</span>",
			editora: "<span class='validate'>Digite o nome da editora</span>",
			prazo: "<span class='validate'>Preencha o prazo corretamente</span>",
			valor: "<span class='validate'>Digite o valor corretamente</span>",
			autor: "<span class='validate'>Digite o nome do autor</span>"
		}
	});
	
	$("#cadastro_equip").validate({
		rules:{
			titulo: "required",
			ano: "required",
			prazo: "required",
			valor: "required",
			patrimonio: "required",
			marca: "required",
			registro_ibge: "required"
		},
		messages:{
			titulo: "<span class='validate'>Digite o título corretamente</span>",
			ano: "<span class='validate'>Digite o ano corretamente</span>",
			prazo: "<span class='validate'>Preencha o prazo corretamente</span>",
			valor: "<span class='validate'>Digite o valor corretamente</span>",
			patrimonio: "<span class='validate'>Digite o número da patrimônio</span>",
			marca: "<span class='validate'>Digite o nome da marca</span>",
			registro_ibge: "<span class='validate'>Digite o número do registro no IBGE</span>"
		}
	});
});