$(document).ready(function(){
	$(".cadastrar-imagem").click(function(){
		$(".show-formularios").removeClass('hidden');
	});
	$(".aniimated-thumbnials").lightGallery({
		thumbnail:true
	}); 
});