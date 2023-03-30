{if $isPreview}
	<div class="opc-ProductStream" style="{$instance->getStyleString()}">
		<h3>News</h3>
	</div>
{else}
	{$newsList = $portlet->getNewsByCategory($instance)}

	{block name='page-index-additional-content'}
		{if isset($oNews_arr) && $oNews_arr|@count > 0}
		    <section class="index-news-wrapper">
		        {container fluid=true class="{if $Einstellungen.template.theme.left_sidebar === 'Y' && $boxesLeftActive}container-plus-sidebar{/if}"}
		            {block name='page-index-subheading-news'}
		                <div class="blog-header">
		                    <div class="hr-sect h2">
		                        {link href="{get_static_route id='news.php'}"}{lang key='news' section='news'}{/link}
		                    </div>
		                </div>
		            {/block}
		            {block name='page-index-news'}
		                {row itemprop="about"
	                         itemscope=true
	                         itemtype="https://schema.org/Blog"
	                         class="slick-smooth-loading carousel carousel-arrows-inside slick-lazy slick-type-news {if $oNews_arr|count < 3}slider-no-preview{/if}"
	                         data=["slick-type"=>"news-slider"]}
	                        {include file="snippets/slider_items.tpl" items=$newsList type='news'}
	                    {/row}
		            {/block}
		        {/container}
		    </section>
		{/if}
	{/block}

{/if}