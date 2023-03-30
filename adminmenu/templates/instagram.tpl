<style>{literal}
.content-header {display:none;}
#content,.container2,#tabs-themeart_portlets .nav-section, #tabs-themeart_portlets .content-section {
	height: calc(100vh - 120px);
}
#content_wrapper { padding: 1.5rem; }
#tabs-themeart_portlets .tab-content {
	box-shadow: none; padding: 2.5rem;
}
#tabs-themeart_portlets .content-section .inner {
	background-color: #fff; height: 100%;
}
{/literal}</style>
<script>
	$('#tabs-themeart_portlets').append('<div class="row"><div class="col-3 nav-section"><h3 class="mb-3">Themy Toolbox</h3></div><div class="col-9 content-section"><div class="inner"></div></div>');
	$('#tabs-themeart_portlets > nav').removeClass('tabs-nav').addClass('ta-nav');
	$('#tabs-themeart_portlets ul.nav').removeClass('nav-tabs').addClass('flex-column nav-pills');
	$("#tabs-themeart_portlets .ta-nav").detach().appendTo("#tabs-themeart_portlets .nav-section");
	$("#tabs-themeart_portlets .tab-content").detach().appendTo("#tabs-themeart_portlets .content-section .inner");
</script>

<form action="plugin.php" method="post">
	<input name="kPlugin" type="hidden" value="{$plugin_id}"/>
	<input name="deleteTokenInstagram" type="hidden" value="1"/>
	{$jtl_token}
	<div class="row">
		<div class="col-12 text-center">
			{if $tokenFromSetting !=0}
				{__('IgIsAuthizored')}
			{else}
				<a class="btn btn-lg btn-outline-primary" onclick="window.location.href='{$api_url}/?redirect_uri={$redirect_uri}&jtl_token={$jtl_token_}'">Authizore</a>
			{/if}
		</div>

	</div>
	{if $tokenFromSetting !=0}	
		<div class="row">
			<div class="col-12 text-center">
				<button name="speichern" type="submit" value="Save" class="btn btn-primary mt-4">
                   {__('IgDiconnect')}
                </button>
			</div>
		</div>
	{/if}
</form>