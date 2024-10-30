 <?php wp_logout(); ?> 

<br>
<br>
<div style="text-align:center">
	<span style="font-size: 29px;"><?php echo __('Logged out', 'combunity') ?></span><br>
	<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIyNHB4IiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0cHgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6c2tldGNoPSJodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2gvbnMiIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48dGl0bGUvPjxkZXNjLz48ZGVmcy8+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBpZD0ibWl1IiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSI+PGcgaWQ9IkFydGJvYXJkLTEiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0zOTUuMDAwMDAwLCAtNDA3LjAwMDAwMCkiPjxnIGlkPSJzbGljZSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjE1LjAwMDAwMCwgMTE5LjAwMDAwMCkiLz48cGF0aCBkPSJNMzk2LDQwOCBMMzk2LDQzMCBMNDExLDQzMCBMNDExLDQyNCBMNDA5LDQyNCBMNDA5LDQyOCBMMzk4LDQyOCBMMzk4LDQxMCBMNDA5LDQxMCBMNDA5LDQxNCBMNDExLDQxNCBMNDExLDQwOCBMMzk2LDQwOCBaIE00MTEuNjM2MDM5LDQxNS40NjQ0NjYgTDQxMy4wNTAyNTMsNDE0LjA1MDI1MyBMNDE4LDQxOSBMNDEzLjA1MDI1Myw0MjMuOTQ5NzQ3IEw0MTEuNjM2MDM5LDQyMi41MzU1MzQgTDQxNC4xNzA0ODUsNDIwLjAwMTA4OCBMNDAzLjAwMDQ5OSw0MjAuMDAxMDg4IEw0MDMuMDAwNDk5LDQxOC4wMDI2NSBMNDE0LjE3NDIyMyw0MTguMDAyNjUgTDQxMS42MzYwMzksNDE1LjQ2NDQ2NiBaIiBmaWxsPSIjMDAwMDAwIiBpZD0iY29tbW9uLWxvZ291dC1zaWdub3V0LWV4aXQtZ2x5cGgiLz48L2c+PC9nPjwvc3ZnPg==" width="300" height="300">
	<br>
	<a class="combunity-link" href="<?php echo get_permalink( get_option( 'combunity_frontpage' )  )?>"><?php echo __('Click here to continue', 'combunity') ?></a>
</div>

	<?php do_action('combunity_print_scripts'); ?>

	<?php do_action('combunity_print_styles'); ?>

	<?php do_action('combunity_echo_scripts'); ?>