{$style = "{$instance->getStyleString()};{if $instance->getProperty('min-height')}min-height:{$instance->getProperty('min-height')}px;{/if} position:relative;"}
{$class = 'opc-Container '|cat:$instance->getAnimationClass()|cat:' '|cat:$instance->getStyleClasses()|cat:' '|cat:$instance->getProperty('cssclass')}
{$data  = $instance->getAnimationData()}
{$fluid = $instance->getProperty('boxed') === false}

{if $instance->getProperty('background-flag') === 'still' && !empty($instance->getProperty('still-src'))}
    {$name = basename($instance->getProperty('still-src'))}
    {$imgAttribs = $instance->getImageAttributes($instance->getProperty('still-src'))}
    {$style = "{$style} background-image:url('{$imgAttribs.src}');"}
{elseif $instance->getProperty('background-flag') === 'image' && !empty($instance->getProperty('src'))}
    {$name = basename($instance->getProperty('src'))}
    {$class = "{$class} parallax-window"}
    {$imgAttribs = $instance->getImageAttributes()}
    {if $isPreview}
        {$style = "{$style} background-image:url('{$imgAttribs.src}');"}
        {$style = "{$style} background-size:cover;"}
    {else}
        {$data = $data|array_merge:[
            'parallax'  => 'scroll',
            'z-index'   => '1',
            'image-src' => $imgAttribs.src
        ]}
    {/if}
{elseif $instance->getProperty('background-flag') === 'video'}
    {$style          = "{$style} overflow:hidden;"}
    {$imgAttribs     = $instance->getImageAttributes($instance->getProperty('video-poster'))}
    {$videoPosterUrl = $imgAttribs.src}
    {$name           = basename($instance->getProperty('video-src'))}
    {$videoSrcUrl    = "{Shop::getURL()}/{$smarty.const.PFAD_MEDIA_VIDEO}{$name}"}
{/if}

{if $instance->getProperty('boxed') === 'plain'}
    <div class="container-plain {$class}"{if $style} style="{$style}"{/if}>
        {if $isPreview}
            <div class='opc-area' data-area-id='flexContainer'>
                {$instance->getSubareaPreviewHtml('flexContainer')}
            {else}
                {$instance->getSubareaFinalHtml('flexContainer')}
            {/if}
        {if $isPreview}</div>{/if}
    </div>
{else}

{container style=$style class=$class data=$data fluid=$fluid}
    <div class="container-inner">
    {if $instance->getProperty('background-flag') === 'video' && !empty($instance->getProperty('video-src'))}
        <video autoplay loop muted poster="{$videoPosterUrl}"
               style="display: inherit; width: 100%; position: absolute; left: 0; top: 0; opacity: 0.7;">
            {if !$isPreview}
                <source src="{$videoSrcUrl}" type="video/mp4">
            {/if}
        </video>
    {/if}
    {if $isPreview}<div class='opc-area' data-area-id='flexContainer'>{/if}
        {if $isPreview}
            {$instance->getSubareaPreviewHtml('flexContainer')}
        {else}
            {$instance->getSubareaFinalHtml('flexContainer')}
        {/if}
    {if $isPreview}</div>{/if}
    </div>
{/container}

{/if}