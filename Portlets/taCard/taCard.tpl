
{$imgAttribs = $instance->getImageAttributes()}
{$areaId = 'card'}

{if $isPreview && empty($imgAttribs.src)}
    <div class="opc-Card-preview" style="{$instance->getStyleString()}">
        <div class="themy card py-3 px-3" style="background-image: url('{$portlet->getBaseUrl()|cat:'preview.png'}');">
            <div class="empty">
                {file_get_contents($portlet->getBasePath()|cat:'icon.svg')}
                <span>{__('Kachel')}</span>
            </div>
        </div>
    </div>
{elseif !empty($imgAttribs.src)}
    {if $isPreview}<div class="opc-Image-with-image">{/if}
    <div class="themy card {$instance->getStyleClasses()} {$instance->getAnimationClass()} {$instance->getAnimationDataAttributeString()}" style="{$instance->getStyleString()}">
        {if $isPreview}
            <div class="preview"></div>
        {/if}
        {if !$isPreview && !empty($instance->getProperty('link'))}<a {if $instance->getProperty('link')|substr:0:4 == 'http'} target="_blank"{/if} href="{$instance->getProperty('link')}">{/if}
            <div class="productbox-image square square-image">
                <div class="inner">
            {image fluid=true webp=true lazy=true
                src=$imgAttribs.src
                srcset=$imgAttribs.srcset
                sizes=$imgAttribs.srcsizes
                width="150"
                height="150"
                alt=$imgAttribs.alt|escape:'html'
                title=$imgAttribs.title
                class="card-img-top"}
                </div>
            </div>
        {if !$isPreview && !empty($instance->getProperty('link'))}</a>{/if}

        <div {if $isPreview}data-area-id="{$areaId}"{/if} class="opc-area">
            {if $isPreview}
                {$instance->getSubareaPreviewHtml($areaId)}
            {else}
                {$instance->getSubareaFinalHtml($areaId)}
            {/if}
        </div>
    </div>
{/if}