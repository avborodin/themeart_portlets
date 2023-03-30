{$imgAttribs = $instance->getImageAttributes()}

{$maxSizes = ''}
{$imgFluid = true}
{if !empty($instance->getProperty('max-width'))}
    {$maxSizes = 'max-width:'|cat:$instance->getProperty('max-width')|cat:';height:auto;'}
    {$imgFluid = false}
{/if}
{if !empty($instance->getProperty('max-height'))}
    {$maxSizes = 'max-height:'|cat:$instance->getProperty('max-height')|cat:';width:auto;'}
    {$imgFluid = false}
{/if}

{if $isPreview && empty($imgAttribs.src)}
    <div class="opc-Image" style="{$instance->getStyleString()}">
        <div>
            <i class="far fa-image"></i>
            <span>{__('Image')}</span>
        </div>
    </div>
{elseif !empty($imgAttribs.src)}
    {$alignCSS = ''}
    {if $instance->getProperty('align') === 'left'}
        {$alignCSS = 'd-block mr-auto'}
    {elseif $instance->getProperty('align') === 'right'}
        {$alignCSS = 'd-block ml-auto'}
    {elseif $instance->getProperty('align') === 'center'}
        {$alignCSS = 'd-block m-auto'}
    {/if}
    {if $isPreview}
        <div class="opc-Image-with-image">
    {/if}
    <div style="max-width:{$imgAttribs.realWidth}px;" class="{$instance->getStyleClasses()}">
        {$isLink = $instance->getProperty('is-link')}
        {$href = $instance->getProperty('url')}

        {if $isLink && !$isPreview && !empty($href)}
            <a href="{$href|escape:'html'}"
                {if !empty($instance->getProperty('link-title'))}
                    title = "{$instance->getProperty('link-title')|escape:'html'}"
                {/if}
                {if $instance->getProperty('new-tab') === true}
                    target = "_blank"
                {/if}>
        {/if}
        {image
            src=$imgAttribs.src
            srcset=$imgAttribs.srcset
            sizes=$imgAttribs.srcsizes
            class='img-aspect-ratio '|cat:$alignCSS
            width=$imgAttribs.realWidth
            height=$imgAttribs.realHeight
            alt=$imgAttribs.alt|escape:'html'
            title=$imgAttribs.title
            style=$maxSizes|cat:$instance->getStyleString()
            rounded=$portlet->getRoundedProp($instance)
            thumbnail=$portlet->getThumbnailProp($instance)
            fluid-grow=$imgFluid
            webp=true
            attribs=['draggable'=>'false']
        }
        {if $isLink && !$isPreview && !empty($href)}
            </a>
        {/if}
    </div>
    {if $isPreview}
        </div>
    {/if}
{/if}