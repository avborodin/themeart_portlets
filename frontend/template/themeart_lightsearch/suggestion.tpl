<div class="snippets-suggestion ta-lightsearch">
	{link href="{$result->cURLFull}" class="w-100 d-flex"}
		{if $settings->getValue("showProductImage") == 'Y'}
			{include file='snippets/image.tpl' item=$result webp=true square=false layzy=true srcSize='xs' stylesizes='40px'}
		{/if}
		<span class="align-self-center">{$result->cName}</span>
		{if $settings->getValue("showProductPrice") == 'Y' && $smarty.session.Kundengruppe->mayViewPrices()}
			{if $result->Preise->fVKNetto == 0}
                <span class="price_label price_on_application align-self-center small ml-auto">{lang key='priceOnApplication'}</span>
            {else}
				<span class="price productbox-price{if (isset($result->Preise->Sonderpreis_aktiv) && $result->Preise->Sonderpreis_aktiv) || $result->Preise->rabatt > 0} special-price{/if} align-self-center ml-auto">
					{$result->Preise->cVKLocalized[$NettoPreise]} <span class="footnote-reference">*</span>
				</span>
			{/if}
		{/if}
	{/link}
</div>