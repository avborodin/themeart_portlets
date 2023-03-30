{$uid = $instance->getUid()}
{$fontBold = ''}
{if $instance->getProperty('bold') === true}
    {$fontBold = ' font-weight-bold'}
{/if}

{if !$isPreview && $instance->getProperty('search') === true}
    <div class="faq-header">
        <div class="form-group form-inline">
            <label class="font-weight-bold">{__(searchFAQ)}</label>
            <input id="search_faq" class="form-control mx-sm-4" value="" size="30" />
        </div>
    </div>
{/if}

{accordion id=$uid style=$instance->getStyleString() class=$instance->getStyleClasses()}
    {foreach $instance->getProperty('groups') as $i => $group}
        {$groupId = $uid|cat:'-'|cat:$i}
        {$areaId = 'group-'|cat:$i}

        {if $isPreview}
            <div class="opc-Accordion-group">
                <div id="heading-{$groupId}">
                    <a href="#" data-toggle="collapse" data-target="#{$groupId}" class="opc-Accordion-head collapsed{$fontBold}"
                       data-parent="#{$uid}">
                        {$group|escape:'html'} <i class="fas fa-chevron-up"></i>
                    </a>
                </div>
                {collapse
                    id=$groupId
                    visible = $i === 0 && $instance->getProperty('expanded') === true
                    data=['parent' => '#'|cat:$uid]
                    aria=['labelledby' => 'heading-'|cat:$groupId]
                    class='opc-Accordion-collapse'
                }
                    <div class="opc-area" data-area-id="{$areaId}">
                        {$instance->getSubareaPreviewHtml($areaId)}
                    </div>
                {/collapse}
            {*{/card}*}
            </div>
        {else}
            {if $i === 0 && $instance->getProperty('expanded') === true}
                {$ariaExpanded = 'true'}
            {else}
                {$ariaExpanded = 'false'}
            {/if}
            {card no-body=true}
                {cardheader id='heading-'|cat:$groupId}
                    {link variant='link' class='menu'|cat:$fontBold 
                            data=['toggle' => 'collapse', 'target' => '#'|cat:$groupId, 'parent' => '#'|cat:$uid]
                            aria=['expanded' => $ariaExpanded, 'controls' => $groupId]
                    }
                        {$group|escape:'html'}
                    {/link}
                {/cardheader}
                {collapse
                    id=$groupId
                    visible = $i === 0 && $instance->getProperty('expanded') === true
                    data=['parent' => '#'|cat:$uid]
                    aria=['labelledby' => 'heading-'|cat:$groupId]
                    class='opc-Accordion-collapse'
                }
                    {cardbody class='opc-area px-0' data=['area-id' => $areaId]}
                        {$instance->getSubareaFinalHtml($areaId)}
                    {/cardbody}
                {/collapse}
            {/card}
        {/if}
    {/foreach}
{/accordion}

{if $instance->getProperty('schema') === true}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {foreach name='gschema' from=$instance->getProperty('groups') item='group'}
    { 
        "@type": "Question",
        "name": "{$group|strip_tags|escape:'html'}",
        "acceptedAnswer": {
            "@type": "Answer",
            "text": "{$instance->getSubareaFinalHtml($areaId)|strip_tags|escape:'html'}"
        }
    }{if !$smarty.foreach.gschema.last},{/if}
    {/foreach}
  ]
}
</script>
{/if}

{if !$isPreview && $instance->getProperty('search') === true}
{inline_script}<script>
	$('#search_faq').keyup(function() {
		var s = $(this).val().trim().toLocaleLowerCase();
		var regExp = RegExp(s);
		if (s === '') {
			$('.accordion .card').show();
			$('.accordion .opc-Accordion-collapse').removeClass('show');
			return true;
		}
		$('.accordion .card').each(function (index, value) { 
			var text = $(this).text().toLocaleLowerCase();
			if (regExp.test(text)) {
				let id = $(this).children().attr('id');
				
				if(typeof(id)  == "undefined") {
					id = '';
				}
				$(this).show();
				
				if(id) {
					let arr = id.split('-');
					id = arr[1]+'-'+arr[2];
					var answer_text = $('#'+id).text().toLocaleLowerCase();
					if (regExp.test(answer_text)) {
						$('#'+id).addClass('show');
					}
				}
			} else {
				$(this).hide();
			}
		});
		return true;
	});
</script>{/inline_script}

{/if}