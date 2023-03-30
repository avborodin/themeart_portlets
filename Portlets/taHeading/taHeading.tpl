{$previewCss = 'p-1 pl-3 pr-3 '}
{if $isPreview === false}
    {$href = $instance->getProperty('url')}
    {if !empty($href)}
        {$href = $href|escape:'html'}
    {/if}
    {$target = '_blank'}
    {if $href|substr:0:4 !== 'http'}
        {$target = '_self'}
    {/if}
    {$previewCss = ''}
{/if}

{$anker = ''}
{if !empty($instance->getProperty('anker'))} 
    {$anker = 'id="'|cat:$instance->getProperty('anker')|cat:'"'}
{/if}

{$align = 'text-align:'|cat:$instance->getProperty('align')|cat:';'}
{if $instance->getProperty('align') !== 'inherit'} 
    {$previewCss = $previewCss|cat:'d-block-'}
{/if}

{$tag       = $instance->getProperty('leveltag')}
{$level     = $instance->getProperty('level')}

{$tagOpen   = $tag|cat:$instance->getProperty('level')|cat:' class="'|cat:{$previewCss}|cat:{$instance->getAnimationClass()}|cat:{$instance->getStyleClasses()}|cat:'"'}
{$tagClose  = $tag|cat:$instance->getProperty('level')}

{if $tag != 'h'}
    {$tagOpen   = $tag|cat:' class="h'|cat:$level|cat:' '|cat:{$previewCss}|cat:{$instance->getAnimationClass()}|cat:' '|cat:{$instance->getStyleClasses()}|cat:'"'}
    {$tagClose  = $tag}
{/if}

{strip}
{if $isPreview}
    <div class="preview p-2">{$instance->getProperty('text')|escape:'html'} <span class="badge badge-info">{$tag}</span> <span class="badge badge-info">{$level}</span></div>
{else}
    <{$tagOpen} {$anker} style="text-align:{$instance->getProperty('align')};{$instance->getStyleString()}" {$instance->getAnimationDataAttributeString()}>
    {if !empty($href)}
        {link href=$href target=$target}
            {$instance->getProperty('text')|escape:'html'}
        {/link}
    {else}
        {$instance->getProperty('text')|escape:'html'}
    {/if}
</{$tagClose}>
{/if}
{/strip}