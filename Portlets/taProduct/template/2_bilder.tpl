{if isset($images->cAltAttribut)}
    {assign var=alt value=$images[0]->cAltAttribut|strip_tags|truncate:60|escape:'html'}
{else}
    {assign var=alt value=$Artikel->cName}
{/if}

<div class="portlet-product productbox {$instance->getStyleClasses()|cat:' '|cat:$instance->getAnimationClass()}" style="{$instance->getStyleString()}">
    <div class="row">
        {counter assign=imgcounter print=0}
        {foreach from=$images item=image name=images}
            {if $smarty.foreach.images.index <= 1}
            <div class="col-6">
                <div class="productbox-image">
                    {if $smarty.foreach.images.index == 0}
                        {include file='snippets/ribbon.tpl'}
                    {/if}
                    <div class="productbox-images list-gallery">
                    {link href=$Artikel->cURLFull}
                        <div class="productbox-image square square-image first-wrapper">
                            <div class="inner">
                                {image alt=$alt square=false fluid=true webp=true lazy=true
                                    src="{$image->$imageSize}"
                                    srcset="{$image->cURLMini} {$Einstellungen.bilder.bilder_artikel_mini_breite}w,
                                        {$image->cURLKlein} {$Einstellungen.bilder.bilder_artikel_klein_breite}w,
                                        {$image->cURLNormal} {$Einstellungen.bilder.bilder_artikel_normal_breite}w"
                                        sizes="auto"
                                        width="100"
                                        height="100"
                                        data=["id"  => $imgcounter]}
                            </div>
                        </div>
                    {/link}
                    </div>
                </div>
            </div>
            {/if}
        {/foreach}
    </div>
	<div class="productbox-title h3 font-weight-bold text-left mt-3 mb-3" itemprop="name">
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
    <div class="productbox-options" itemprop="offers" itemscope=true itemtype="https://schema.org/Offer">
        <link itemprop="businessFunction" href="https://purl.org/goodrelations/v1#Sell" />
        <div class="item-list-price">
	        {include file="productdetails/price.tpl" class="mb-2" Artikel=$Artikel tplscope='gallery'}
        </div>
        {link class="btn btn-outline-primary" role="button" href=$Artikel->cURLFull}
            {lang key='articledetails' section='productDetails'}
        {/link}
    </div>
</div>