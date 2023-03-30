{if isset($instagrams)}
{strip}
	{if $inContainer === false}
		<div class="container-fluid">
	{/if}
	<div id="instagram" class="mt-4 carousel slide" data-interval="false" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
		{assign var="i" value="1"}
		{foreach $instagrams as $instagram}
			{if $i%4==1}
				<div class="carousel-item{if $i ==1} active{/if}">
			{/if}
			<div class="col-md-3" style="float:left">
				<div class="card mb-4 shadow-sm">
					<div class="card-body">
						<div class="d-flex justify-content-between align-items-center">
							<h4 class="card-title"><a href="https://instagram.com/{$instagram->username}" target="_blank">{$instagram->username}</a></h4>
							<span width="24" height="24" class="fs-sm text-muted">
								<a href="{$instagram->permalink}" target="_blank">{$iconInstagram}</a>
							</span>
						</div>
					</div>
					<a href="{$instagram->permalink}" target="_blank">
					{if $instagram->media_type == 'VIDEO'}
						<img class="img-fluid" src="{$instagram->thumbnail_url}">
					{else}
						<img class="img-fluid" src="{$instagram->media_url}">
					{/if}
					</a>
					<div class="card-body">
						<p class="card-text">{$instagram->caption}</p>
						<div class="d-flex justify-content-between align-items-center">
						{if $instagram->like_count > 0}
							<div class="btn-group">{$iconLike}
								<div style="margin-left: 6px;font-size: 14px;">{$instagram->like_count}</div>
							</div>
						{/if}
						</div>
					</div>
				</div>
			</div>
			{if $i%4==0}
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