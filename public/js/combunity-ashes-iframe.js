
	jQuery(document).ready(function(){
		console.log("Combunity iframe client loaded")
		// console.log( tinymce )
		// console.log( combunity )
		console.log( jQuery( 'a.combunity-edit-thread-link').length );
		jQuery(document).on("click", '.combunity-edit-thread-link', function(e){
			alert('Iframe click');
			e.preventDefault();
		});
	});
