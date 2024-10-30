<?php
$scripts = apply_filters('combunity_get_scripts', array() );
// echo json_encode( $scripts );
?>

<style type="text/css" >
	.combunity-iframe{
		border:0;
		overflow:hidden;height:100%;width:100%
	}
	
</style>
<div class="combunity-loader-iframe" style="text-align:center">
	<?php include_once('loader.php') ?>
</div>

<iframe src="<?php echo $this->_p->Pages->getlink('view') ?>" id="cpost<?php the_ID() ?>" class="combunity-cpost combunity-iframe" frameborder="0" width="3000"></iframe>

<script>
	// jQuery(document).ready(function(){

		// function addscripttag( url ){
		// 	var script=document.createElement('script');
		// 	script.type='text/javascript';
		// 	script.src=url;
		// 	return script
		// }
		// jQuery('#cpost<?php the_ID() ?>').load(function() {
		//   // jQuery('#cpost<?php the_ID() ?>').contents().find('body').append('<scr' + 'ipt type="text/javascript" src="'+combunity.jquery_url+'"></scr' + 'ipt>');    
		// });
	    // jQuery('.combunity-cpost').ready(function(){
	    // 	var iframe = jQuery('.combunity-cpost')
	    // 	var style = jQuery(".combunity-forums-plugin-stylesheet").text();
	    // 	var contents = jQuery('.cpost-html').html()
	    // 	iframe.contents().find('body').html(contents);
	    // 	iframe.contents().find('body').append("<style type='text/css'>"+style+"</style>");
	    // 	iframe.css("height", iframe.contents().find('body').height());
	    	// window.combunity.actions.editthread(e, this);
	    	// console.log( combunity )
	    	
	    	

	    	// jQuery('#cposthtml<?php the_ID() ?>').remove();

	        
	        // jQuery('#cpost<?php the_ID() ?>').contents().find('body').find('a').setAttribute('target','_blank');
	        


	        // iframe.contents().find('body').append('<scr' + 'ipt type="text/javascript" src="'+combunity.jquery_url+'"></scr' + 'ipt>'); 

	        // jQuery('#cpost<?php the_ID() ?>').contents().find('body').append('<scr' + 'ipt type="text/javascript" src="'+combunity.script_url+'"></scr' + 'ipt>'); 

	        // jQuery('#cpost<?php the_ID() ?>').contents().find('body').append('<scr' + 'ipt type="text/javascript" src="'+combunity.iframe_url+'"></scr' + 'ipt>'); 

	        // jQuery('#cpost<?php the_ID() ?>').contents().find('body').append('<scr' + 'ipt type="text/javascript" src="'+combunity.tinymce_url+'"></scr' + 'ipt>'); 


	        // jQuery('#cpost<?php the_ID() ?>')[0].contentWindow.jQuery = jQuery

	        // jQuery('#cpost<?php the_ID() ?>')[0].contentWindow.combunity = combunity


	        // jQuery('#cpost<?php the_ID() ?>').contents().find('body').combunity = combunity;

	  //       var script = addscripttag(combunity.jquery_url)
			// jQuery('#cpost<?php the_ID() ?>').contents().find('body').append(script);

			// var script = addscripttag(combunity.script_url)
			// jQuery('#cpost<?php the_ID() ?>').contents().find('body').append(script);

	        


	        // jQuery('#cpost<?php the_ID() ?>').contents().find('body a.combunity-edit-thread-link').on("click", function(e){
	        	// e.preventDefault();
	        	// CKEDITOR.replace( 'editor1' );
	        	 // jQuery('#cpost<?php the_ID() ?>').contents().find('#editor1').ckeditor();
	        	// console.log(jQuery('#cpost<?php the_ID() ?>')[0].contentWindow.combunity.actions)

	        	// jQuery('#cpost<?php the_ID() ?>').contents().find('body a.combunity-edit-thread-link').click();

	        	// jQuery('#cpost<?php the_ID() ?>')[0].contentWindow.combunity.actions.editthread(e, this)
	        	// combunity.tinymceconfig.selector = '';
	        	// console.log( jQuery(this).parent().parent().find(".combunity-rte").length );
	        	// combunity.tinymceconfig.target = 
	        	// jQuery('#cpost<?php the_ID() ?>')[0].contentWindow.somefunction();
	        	// window.combunity.actions.editthread(e, this);
	  //       	var currentElement = this;
			// 	console.log("Edit thread");
			// 	e.preventDefault();
			// 	var submissionData = {};
			// 	submissionData.id = jQuery(this).data("id");
			// 	var container = jQuery(currentElement).closest('.post-body').find(".post-container")
			// 	var form = new FormBuilder({
			// 		action:'combunity_get_edit_thread_form_meta', 
			// 		action_save : 'combunity_post_thread',
			// 		id: submissionData.id ,
			// 		container : container,
			// 		labels: false
			// 	});
			// });


	//     });
	// });
	    // obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';

</script>