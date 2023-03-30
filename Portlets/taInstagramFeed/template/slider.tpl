{if isset($instagrams)}
{strip}
	{if $inContainer === false}
		<div class="container-fluid">
	{/if}
	<div id="instagram" class="mt-4 carousel slide" data-interval="false" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
		{assign var="i" value="1"}
		{foreach $instagrams as $instagram}
			{if $i%6==1}
				<div class="carousel-item{if $i ==1} active{/if}">
			{/if}
			<div class="col-md-2" style="float:left">
				<div class="_fade">
					<a href="{$instagram->permalink}" target="_blank">
				
					{if $instagram->media_type == 'VIDEO'}
						<img class="img-fluid img-ig" src="{$instagram->thumbnail_url}">
						
						{*<div class="embed-responsive embed-responsive-16by9">
						 <iframe class="embed-responsive-item"  src="{$instagram->media_url}" frameborder="0" allowfullscreen></iframe>
						</div>*}
					{else}
						<img class="img-fluid img-ig" src="{$instagram->media_url}">
					{/if}
				</div>
			</div>
			{if $i%6==0}
				</div>
			{/if}
			{assign var="i" value="`$i+1`"}
		{/foreach}
		</div>
		<a href="#instagram" class="prev" id="plusSlider" data-slide="prev">&#10094;</a>
		<a href="#instagram" class="next" id="plusSlider" data-slide="next">&#10095;</a>
	</div>
	{if $inContainer === false}
		</div>
	{/if}
{/strip}
{/if}