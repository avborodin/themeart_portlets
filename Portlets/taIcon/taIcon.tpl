{$href = ''}
{if $isPreview === false}
    {$href = $instance->getProperty('url')}
    {if !empty($href)}
        {$href = $href|escape:'html'}
    {/if}
{/if}

{$size = ''}
{if !empty($instance->getProperty('size'))}
    {$size = 'font-size:'|cat:$instance->getProperty('size')|cat:';'}
{/if}

{$target = '_self'}
{if $instance->getProperty('new-tab') === true}
    {$target = '_blank'}
{/if}

{$title = ''}
{if !empty($instance->getProperty('label'))}
    {$title = 'title="'|cat:$instance->getProperty('label')|cat:'"'}
{/if}

<div class="opc-Icon d-inline{if $isPreview} p-3{/if} {$instance->getAnimationClass()|cat:' '|cat:$instance->getStyleClasses()}" style="{$size}{$instance->getStyleString()}">
    {if strlen($href) > 0}
        <a {$title} href="{$href}" target="{$target|default:null}">
            {$portlet->getFontAwesomeIcon($instance->getProperty('icon'))}
        </a>
    {else}
        {$portlet->getFontAwesomeIcon($instance->getProperty('icon'))}
    {/if}
</div>