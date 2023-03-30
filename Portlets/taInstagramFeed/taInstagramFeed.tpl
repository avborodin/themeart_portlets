{$style = $instance->getProperty('listStyle')}
{$template = $instance->getProperty('template')}

{if $isPreview}
    <div class="opc-ProductStream" style="{$instance->getStyleString()}">
        <h3>InstagramFeed: {$template}</h3>
    </div>
{/if}