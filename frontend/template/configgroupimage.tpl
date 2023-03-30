{col cols=12 lg=3 offset-lg="{$configDescription}" order=0 order-lg=1}
    {if $type==="config"}
        {include file='configimage.tpl' item=$config square=false}
    {/if}
    {if $type==="article"}
        {include file='configimage.tpl' item=$article square=false}
    {/if}
{/col}