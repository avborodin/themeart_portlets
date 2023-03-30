{$selectWidget = $instance->getProperty('selectWidget')}

{if $isPreview}
	<div class="opc-ProductStream" style="{$instance->getStyleString()}">
		<h3>PinterestFeed: {$selectWidget} </h3>
	</div>
{else}
	{if $inContainer === false}
		<div class="container-fluid">
	{/if}

	<div class="row justify-content-center">
	{if $selectWidget == 'pin'}
		<a data-pin-do="embedPin" data-pin-width="{$instance->getProperty('pinSize')}" href="https://www.pinterest.com/pin/{$instance->getProperty('pinNumber')}/"></a>
	{else}
		{if $selectWidget == 'board'}
			{$profiName = $instance->getProperty('bprofiName')}
			{$boardName = $instance->getProperty('boardName')}
			{$width = $instance->getProperty('boardWidth')}	
			{$height = $instance->getProperty('boardHeight')}

			{assign var=do value="embedBoard"}
			{assign var=urlPinterest value="https://www.pinterest.com/$profiName/$boardName/"}
		{else}
			{$profiName = $instance->getProperty('profiName')}
			{$width = $instance->getProperty('profiWidth')}
			{$height = $instance->getProperty('profiHeight')}
			
			{assign var=do value="embedUser"}
			{assign var=urlPinterest value="https://www.pinterest.com/$profiName/"}
		{/if}
		
		<a href="{$urlPinterest}" 
			data-pin-do="{$do}" 
			data-pin-board-width="{$width}" 
			data-pin-scale-height="{$height}" 
			data-pin-scale-width="100">
		</a>
	{/if}
	</div>
	<script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>

	{if $inContainer === false}
		</div>
	{/if}
{/if}