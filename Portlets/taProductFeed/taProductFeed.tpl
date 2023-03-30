{$style = $instance->getProperty('listStyle')}
{$itemClass = $instance->getProperty('itemClass')}

{if $isPreview}
    <div class="opc-ProductStream" style="{$instance->getStyleString()}">
        <h3>ProductFeed: {$style}</h3>
    </div>
{else}
    {$productlist = $portlet->getFilteredProducts($instance)}
    
    {if $style === 'list' || $style === 'gallery'}
        {if $style === 'list'}
            {$grid = '12'}
            {$eqHeightClasses = ''}
        {else}
            {$grid   = '6'}
            {$gridmd = '4'}
            {$gridlg = '3'}
            {$eqHeightClasses = 'row-eq-height row-eq-img-height'}
        {/if}
        {if $inContainer === false}
            <div class="container-fluid">
        {/if}
        {row class=$style|cat:' '|cat:$eqHeightClasses|cat:' product-list opc-ProductStream opc-ProductStream-'|cat:$style|cat:' '|cat:$instance->getStyleClasses()
            itemprop="mainEntity"
            itemscope=true
            itemtype="http://schema.org/ItemList"
            style="{$instance->getStyleString()}"}
            {foreach $productlist as $Artikel}
                {col cols={$grid} md="{if isset($gridmd)}{$gridmd}{/if}" lg="{if isset($gridlg)}{$gridlg}{/if}"
                     class="product-wrapper {if !($style === 'list' && $Artikel@last)}mb-4{/if}"
                     itemprop="itemListElement" itemscope=true itemtype="http://schema.org/Product"}
                    {if $style === 'list'}
                        {include file='productlist/item_list.tpl' tplscope=$style isOPC=true idPrefix=$instance->getUid()}
                    {elseif $style === 'gallery'}
                        {include file='productlist/item_box.tpl' tplscope=$style class='thumbnail' idPrefix=$instance->getUid()}
                    {/if}
                {/col}
            {/foreach}
        {/row}
        {if $inContainer === false}
            </div>
        {/if}
    {elseif $style === 'simpleSlider'}
        <div id="{$instance->getUid()}"
             class="carousel carousel-arrows-inside evo-slider slick-lazy opc-ProductStream opc-ProductStream-slider slick-type-product {$instance->getStyleClasses()}"
             data-slick-type="product-slider" 
             data-slick='{literal}{"slidesToShow": 5, "slidesToScroll": 5}{/literal}'
             style="{$instance->getStyleString()}">
            {foreach $productlist as $Artikel}
                <div class="product-wrapper">
                    <a href="{$Artikel->cURLFull}">
                        <div class="square square-image">
                            <div class="inner {$itemClass}">
                                {include file='snippets/image.tpl' item=$Artikel square=false srcSize='sm' class='product-image'}
                            </div>
                        </div>
                    </a>
                </div>
            {/foreach}
        </div>
    {elseif $style === 'slider'}
        {if $inContainer === false}
            <div class="container-fluid">
        {/if}
        <div class="opc-product-slider {$instance->getStyleClasses()}" style="{$instance->getStyleString()}">
            {include file='snippets/product_slider.tpl' tpl='item_box' productlist=$productlist isOPC=true idPrefix=$instance->getUid()}
        </div>
        {if $inContainer === false}
            </div>
        {/if}
    {elseif $style === 'box-slider'}
        <div class="opc-product-slider {$instance->getStyleClasses()}" style="{$instance->getStyleString()}">
            {include file='snippets/product_slider.tpl' productlist=$productlist tplscope='box' isOPC=true idPrefix=$instance->getUid()}
        </div>
    {/if}
{/if}