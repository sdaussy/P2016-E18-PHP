
/* 3 tests pour l'autocomplete des users : 
$('#autoc').autocomplete({
source:function( request, response ){		
	$.ajax({
				url: 'defi/',
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
});
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
*/

