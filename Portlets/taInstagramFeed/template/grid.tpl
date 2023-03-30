{if isset($instagrams)}
{strip}
	{if $inContainer === false}
		<div class="container-fluid">
	{/if}
	{row class="instagramFeed mt-4"}
	{foreach $instagrams as $instagram}
		{col cols=12 md=4 lg=3 xl=3 class="col-img"}
			<a href="{$instagram->permalink}" target="_blank">
				{if $instagram->media_type == 'VIDEO'}
					<img class="img-fluid" src="{$instagram->thumbnail_url}">
				{else}
					<img class="img-fluid img-ig" src="{$instagram->media_url}">
				{/if}
				<div class="overlay">
					<div class="text">{$instagram->caption}</div>
				</div>
			</a>
		{/col}
	{/foreach}
    {/row}
	{if $inContainer === false}
		</div>
	{/if}
{/strip}
{/if}