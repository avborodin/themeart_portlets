{if $isPreview}
	{assign var="data" value=['portlet' => $instance->getDataAttribute()]}
	<div class="opc-Googlemap-preview" style="background:url({$portlet->getBaseUrl()|cat:'preview.png'});background-size:cover;height:300px;"></div>
{/if}
<div class="googleMap {$instance->getAnimationClass()} {$instance->getStyleClasses()}" style="{$instance->getStyleString()}" {$instance->getAnimationDataAttributeString()}>
    {assign var="stringAddress" value=$instance->getProperty("gmap_address")|trim|replace:' ':'+'}
	{if $stringAddress}
		<iframe width="100%" height="{if !empty($instance->getProperty("height"))}{$instance->getProperty("height")}{else}400{/if}" frameborder="0" style="border:0"
				src="https://www.google.com/maps/embed/v1/place?key={$instance->getProperty("gmap_key")|trim}&q={$stringAddress}" allowfullscreen>
		</iframe>
	{/if}
</div>