{if isset($images->cAltAttribut)}
    {assign var=alt value=$images[0]->cAltAttribut|strip_tags|truncate:60|escape:'html'}
{else}
    {assign var=alt value=$Artikel->cName}
{/if}

<div class="portlet-product {$instance->getStyleClasses()|cat:' '|cat:$instance->getAnimationClass()}" style="{$instance->getStyleString()}">
<div class="row">
	{counter assign=imgcounter print=0}
	{foreach from=$images item=image name=images}
		{if $smarty.foreach.images.index <= 2}
			<div class="col-6 col-md-4">
                {link href=$Artikel->cURLFull}
				    {image alt=$alt square=false fluid=true webp=true lazy=true
                        src="{$image->$imageSize}"
                        srcset="{$image->cURLMini} {$Einstellungen.bilder.bilder_artikel_mini_breite}w,
                            {$image->cURLKlein} {$Einstellungen.bilder.bilder_artikel_klein_breite}w,
                            {$image->cURLNormal} {$Einstellungen.bilder.bilder_artikel_normal_breite}w"
                            sizes="auto"
                            data=["id"  => $imgcounter]
                            fluid=true}
                {/link}
			</div>
		{/if}
	{/foreach}
</div>
<div class="row">
	<div class="col-12 col-xl-8 offset-xl-2">
		<div class="productbox-title- text-left mt-5 mb-3" itemprop="name">
            {link href=$Artikel->cURLFull class="text-clamp-2"}
                {$Artikel->cKurzbezeichnung}
            {/link}
        </div>
		{if $Artikel->cName !== $Artikel->cKurzbezeichnung}
            <meta itemprop="alternateName" content="{$Artikel->cName}">
        {/if}
        <meta itemprop="url" content="{$Artikel->cURLFull}">
		{if $shortdescription === true && $Artikel->cKurzBeschreibung}
            <div class="item-list-description" itemprop="description">
                {$Artikel->cKurzBeschreibung}
            </div>
        {/if}

		{include file="productdetails/price.tpl" class="mb-2"}
        <a class="text-uppercase font-weight-bold" href="{$Artikel->cURLFull}">{lang key='text-produkt-entdecken' section='custom'} <i class="fas fa-angle-right"></i></a>
	</div>
</div>
</div>