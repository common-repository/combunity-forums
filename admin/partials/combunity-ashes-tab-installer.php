<h4>Thank you for choosing Combunity!</h4>
<p> There's only one more step left before Combunity is ready to use:</p>
<p>- Just head over to your <a target="_blank" href="<?php echo admin_url('options-permalink.php') ?>">Permalinks</a> page and hit the <strong>Save Changes</strong> button.</p>

<p>
<h3 >How would you like to use Combunity?</h3>
<div class="feature-section two-col">
	<div class="col " style="text-align:center">
		<h4>Using a Combunity WordPress theme</h4>
		<p>If you choose this option, download a theme from below and install it as a WordPress theme. </p>
		<?php
			$response = wp_remote_get( 'http://updatesv2.combunity.com/fseg/combunity-installer-themes/?ver=' . Combunity_Api()->get_version() );
			if( is_array($response) ) {
			  $header = $response['headers']; // array of http header lines
			  $body = $response['body']; // use the content
			  echo $body;
			}
		?>
	</div>
	<div class="col " style="text-align:center">
		<h4>Using my own WordPress theme</h4>
		<p>If you choose this option, your installation is now complete, just choose Combunity from the sidebar and start using it !</p>
	</div>
</div>



</p>

<footer style="margin-top:100px;">
	<hr>
	<div style="float:right; margin-top:5px; font-size:13px;">
		<i>Combunity v<?php echo Combunity_Api()->get_version(); ?></i>
	</div>
	
</footer>
