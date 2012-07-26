$(document).ready(function principal(){
	
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
		messages: {
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
	
	$(".cpf").mask("999.999.999-99");
	$(".phone").mask("(99)9999-9999");
	$("#dre").mask("999999999");
	$("#siap").mask("99999999999");
	
	
});