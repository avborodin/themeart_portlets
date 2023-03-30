{if $isPreview === false}
    {$href = $instance->getProperty('url')}
    {if !empty($href)}
        {$href = $href|escape:'html'}
    {/if}
{/if}

{if $instance->getProperty('new-tab') === true}
    {$target = '_blank'}
{/if}

{if $href|default:null}
<a href="{$href}" target="{$target|default:null}">
{/if}
<div class="usp-area d-flex justify-content-center {$instance->getStyleClasses()} {$instance->getAnimationClass()}" style="{$instance->getStyleString()}{if $instance->getProperty('align') !== 'block'} text-align: {$instance->getProperty('align')};{/if}" {$instance->getAnimationDataAttributeString()}>
    {if $instance->getProperty('use-icon') === true && $instance->getProperty('icon-align') === 'left'}
        <div class="fa-2x mr-3">{$portlet->getIcon($instance->getProperty('icon'))}</div>
    {/if}
    <div>
        {if $instance->getProperty('use-icon') === true && $instance->getProperty('icon-align') === 'top'}
            <div class="fa-2x mb-1">{$portlet->getIcon($instance->getProperty('icon'))}</div>
        {/if}
        <div class="title h3 mb-0">{$instance->getProperty('label')}</div>
        <span class="subtitle text-muted">{$instance->getProperty('subtitle')}</span>
    </div>
        
    {if $instance->getProperty('use-icon') === true && $instance->getProperty('icon-align') === 'right'}
        <div class="fa-2x ml-3">{$portlet->getIcon($instance->getProperty('icon'))}</div>
    {/if}
</div>
{if $href|default:null}
</a>
{/if}