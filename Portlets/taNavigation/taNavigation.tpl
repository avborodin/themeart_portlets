{$navigationType = $instance->getProperty('navigationType')}
{$selector = $instance->getProperty('selector')}
{if $isPreview}
    <div class="opc-Navigation" style="{$instance->getStyleString()}">
        <div>Navigation: {$navigationType}</div>
    </div>
{else}
{strip}
<ul class="ta-navigation nav anchor-menu- {$instance->getStyleClasses()|cat:' '|cat:$instance->getAnimationClass()}" style="{$instance->getStyleString()}">
	{if $navigationType == 'links' || $navigationType == 'subavigation'}
		{foreach name='navi' from=$links item=$link}
			{*if $type == 'links' && $link->getParent() < 1*}
        		<li class="nav-item" id="menu-anchor-html">
					<a class="nav-link{if $smarty.foreach.navi.first} active{/if}" href="{$link->getURL()}">{$link->getName()}</a>
				</li>
			{*/if*}
			{*if $type == 'subavigation'}
        		<li class="nav-item" id="menu-anchor-html">
					<a class="nav-link" href="{$link->getURL()}">=={$link->getName()}</a>
				</li>
			{/if*}
		{/foreach}
	{/if}
</ul>
{/strip}

	{if $navigationType == 'anchor' && !empty($selector)}
		{*inline_script*}
		<script>
		$(document).ready(function() {
			var html = '';
			$("{$selector}").each(function() {
				var heading = $(this);
				var headingtext = heading.text().toLowerCase().trim().replace(/[\.,-\/#!?$%\^&\*;:{}=\-_`~()]/g,"");
				heading.attr("id",headingtext );
				html +='<li class="nav-item" id="menu-anchor-css"><a class="nav-link" href="#'+headingtext+'">'+heading.text()+'</a></li>';
			});
			$('.ta-navigation').append(html);
		});
		</script>
		{*/inline_script*}
	{/if}
{/if}