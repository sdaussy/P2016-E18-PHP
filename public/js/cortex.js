$('.index a').on('click',function(e){
	e.preventDefault();
	$('input[name="name"]').focus();
	var $this=$(this);
	if($this.hasClass('on')){
		$('.users').html('');
		$this.removeClass('on');
	}
	else{
	$.ajax({
		url:$(this).attr('href')

	})
	.success(function(data){
		$('.users').html(data);
		$('.index a.on').removeClass('on');
		$this.addClass('on');
	});
	}
	$('input[name="name"]').val();
});

$('.users').on('click','a:first-of-type',function(e){
	e.preventDefault();
	$.ajax({
		url:$(this).attr('href')
	})
	.success(function(data){
		$('section + section').html(data);
	});
})
.on('click','a.fav',function(e){
e.preventDefault();
var $this=($this);
$.getJSON($(this).attr('href'))
.success(function(data){
	if(data.status=='false'){
		$this.removeClass('on');
	}
	else{
		$this.addClass('on');
	}
})
})

$('input[name="pseudo"]').on('keyup',function(){
	console.log('dedans');
	var $this=$(this);
	var $form=$(this).parent('form');
	var datas={'name':$this.val()};
	datas.filter=$('.index a.on').data('filter');
	//convention var $nomvariable on met le dollar pour dire que dans cette var JS on stocke une var jquery
	$.ajax({
		url:$form.attr('action'),
		method:$form.attr('method'),
		data:datas

		//serialize renvoie un json name : valeur 
		//creer sous forme de notation objet les données du form
	})
	.success(function(data){
		$('.users').html(data);
		console.log('user envoyé');

	})
});




