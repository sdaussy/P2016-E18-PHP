$('.index a').on('click',function(e){
	e.preventDefault();
	$.ajax({
		url:$(this).attr('href')

	})
	.success(function(data){
		$('.users').html(data);
	});
});
$('.users').on('click','a',function(e){
	e.preventDefault();
	$.ajax({
		url:$(this).attr('href')
	})
	.success(function(data){
		$('section + section').html(data);
	});
});

$('input[name="name"]').on('keyup',function(){
	var $form=$(this).parent('form');
	//convention var $nomvariable on met le dollar pour dire que dans cette var JS on stocke une var jquery
	$.ajax({
		url:$form.attr('action'),
		method:$form.attr('method'),
		data:$form.serialize()
		//creer sous forme de notation objet les données du form
	})
	.success(function(data){
		$('.users').html(data);
	})
});












>>>>>>> ff49ae3d67c0d9d9d1ee21bfcfea5a11ff0aa6bd
