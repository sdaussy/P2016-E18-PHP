//API SORTANTE : questions et réponses correspondantes
$.ajax({
	'url':'api/question',
	'dataType':'json',
	'method':'POST'
})

.success(function(data){
	console.log(data); 
});


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

/*$('#autoc').autocomplete({
source:function( request, response ){		
	$.ajax({
				url: 'app/Models/User_model.php',
				method: 'get',
				datatype: 'json',
				async : true
			})
			.success(function(data){
				console.log('user envoyé');
							
			})
}

	
});
$( "#autoc" ).autocomplete({
    source: function(req, add){
        //pass request to server
        $.ajax({
            url:'users/search/',
            type:"get",
            dataType: 'json',
            data: req,
            async: true,
            cache: true,
            success: function(data){
              var ul=$('<ul>');
				for(var i=0;i<data.length;i++){
					var liste=$('<li>');
					var lien=$('<a>');
					var madata=$data[0];
					$(lien).append(madata);	
					$(liste).append(lien);	
					$(ul).append(liste);
				}
				$('#autoc').append(ul);
				console.log('user envoyé');
            }
        });
    }
});*/
$('input[name="a_qui"]').on('keyup',function(){
	console.log('dedans');
	var $this=$(this);
	var $form=$(this).parent('form');
	var datas={'name':$this.val()};
	console.log(datas);
	$.ajax({
		url: 'users/search/',//$form.attr('action'),
		method: 'post', //$form.attr('method'),
		data: datas
	})
	.success(function(data){
		console.log('user envoyé');

	})
	.fail(function() {
		console.log( "error users récup php" );
	})
});




/*var ul=$('<ul>');
		for(var i=0;i<data.length;i++){
			var liste=$('<li>');
			var lien=$('<a>');
			var madata=$data[0];
			$(lien).append(madata);	
			$(liste).append(lien);	
			$(ul).append(liste);
		}
		$('.users').append(ul);
		$('.users').append('jlmj');*/
		//$('.users').html(data);

jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
	var slideCount = $('#slider ul li').length;
	var slideWidth = $('#slider ul li').width();
	var slideHeight = $('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	
	$('#slider').css({ width: slideWidth, height: slideHeight });
	
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});    
