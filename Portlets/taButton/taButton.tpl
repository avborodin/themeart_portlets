{if $isPreview === false}
    {$href = $instance->getProperty('url')}
    {if !empty($href)}
        {$href = $href|escape:'html'}
    {/if}
{/if}

{if $instance->getProperty('size') !== 'md'}
    {$size = $instance->getProperty('size')}
{/if}

{if $instance->getProperty('align') === 'block'}
    {$block = true}
{/if}

{if $instance->getProperty('new-tab') === true}
    {$target = '_blank'}
{/if}

{$outline = null}
{if $instance->getProperty('btn-outline') === true}
    {$outline = 'outline-'}
{/if}

{$inline = false}
{if $instance->getProperty('inline') === true}
    {$inline = true}
{/if}

{if !empty($title)}
    {$title = $title|escape:'html'}
{/if}

<div class="opc-Button{if $inline} d-inline-block{/if} {$instance->getAnimationClass()|cat:' '|cat:$instance->getStyleClasses()}"{if $instance->getProperty('align') !== 'block'} style="text-align:{$instance->getProperty('align')}"{/if}>
    {if $isPreview}
        <div class="preview"></div>
    {/if}
    {button href=$href|default:null
            target=$target|default:null
            size=$size|default:null
            block=$block|default:false
            variant=$outline|cat:$instance->getProperty('style')
            title=$title|default:null 
            data=$instance->getAnimationData()
            style=$instance->getStyleString() 
    }
        {if $instance->getProperty('use-icon') === true && $instance->getProperty('icon-align') === 'left'}
            {$portlet->getFontAwesomeIcon($instance->getProperty('icon'))}
        {/if}
        {$instance->getProperty('label')}
        {if $instance->getProperty('use-icon') === true && $instance->getProperty('icon-align') === 'right'}
            {$portlet->getFontAwesomeIcon($instance->getProperty('icon'))}
        {/if}
    {/button}
</div>
