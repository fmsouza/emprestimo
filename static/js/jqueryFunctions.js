$(document).ready(function principal(){
	
	$(".cpf").mask("999.999.999-99");
	$(".phone").mask("(99)9999-9999");
	$("#dre").mask("999999999");
	$("#siap").mask("99999999999");
	$(".ano").mask("9999");
	$(".number").mask("999999999");
	$(".date").mask("99/99/9999").datepicker({ dateFormat: 'dd/mm/yy' });
	
	$("#admin-menu").hide();
	$("#menu #sessioname #name").click(function(){
		$("#admin-menu").toggle("fast");
	});
	$("#footer, #header, #content, .menu").click(function(){
		$("#admin-menu").hide("fast");
	});
	$(".clean").click(function(){
		var form = $(this).attr("alt");
		$("#"+form).reset();
	});
	$(".search").focus(function(){
		$(this).val("");
		$(this).attr("style","color:#888");
	});
	
});