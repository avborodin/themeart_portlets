{if $isPreview}
	{$slides = $instance->getProperty('slides')}
	{if $slides|count > 0}
		{$imgAttribs = $instance->getImageAttributes($slides[0].url, '', '')}
	{/if}
	<div class="text-center opc-ImageSlider {if $slides|count > 0}opc-ImageSlider-with-image{/if}"
         style="{if $slides|count > 0}background-image: url('{$imgAttribs.src}');{/if} {$instance->getStyleString()}">
        <div>
            {file_get_contents($portlet->getBasePath()|cat:'icon.svg')}
            <span>{__('taEasySlider')}</span>
        </div>
    </div>
{else}
	{$uid = $instance->getUid()}
	{if $inContainer === false}
		<div class="container-fluid">
	{/if}

	<div class="slider-wrapper">
		{if $instance->getProperty('slides')|count > 0}
			<div class="easy-slider">
			{foreach $instance->getProperty('slides') as $i => $slide}

				{if empty($slide.title)}
					{$slideTitle = ''}
				{/if}
				
				{if !empty($slide.url)}
					{$imgAttribs = $instance->getImageAttributes($slide.url, '', '')}
					
					{if !empty($slide.link)}
						<a href="{$slide.link}"
						{if !empty($slide.title)}title="{$slide.title|escape:'html'}"{/if}
							class="slide">
					{else}
						<div class="slide">
					{/if}
                           
					{image
						srcset=$imgAttribs.srcset
						sizes=$imgAttribs.srcsizes
						src=$imgAttribs.src
						alt=$imgAttribs.alt|escape:'html'
						title=$slideTitle|escape:'html'
						class="img-fluid mx-auto d-block"
						data=['desc' => $slide.desc|escape:'html']}

					{if !empty($slide.title) || !empty($slide.desc)}
						<div class="nivo-caption2">
							{if !empty($slide.title)}
								<strong class="title">{$slide.title|escape:'html'}</strong>
                            {/if}
							<p class="desc">{$slide.desc|escape:'html'}</p>
							{if $slide.alt}<a class="btn btn-primary btn-lg d-none d-inline-md" href="">{$slide.alt|escape:'html'}</a>{/if}
                        </div>
                	{/if}

					{if empty($slide.link)}
						</div>
					{else}
						</a>
					{/if}

				{/if}
			{/foreach}
			</div>
		{/if}

		{if $instance->getProperty('slider-controls') == 'true'}
			<div class="nivo-directionNav" id="custom-control">
				<a class="nivo-prevNav"></a>
				<a class="nivo-nextNav"></a>
			</div>
		{/if}
	</div>

	{if $inContainer === false}
		</div>
	{/if}

	{inline_script}<script type='text/javascript'>
	var mode = '{$instance->getProperty('slider-mode')}';
	var items = {$instance->getProperty('slider-items')};
	var gutter = {$instance->getProperty('slider-gutter')};
	var edgePadding = {$instance->getProperty('slider-edgePadding')};
	var fixedWidth = '{$instance->getProperty('slider-fixedWidth')}';
	var autoWidth = {$instance->getProperty('slider-autoWidth')};
	var viewportMax = '{$instance->getProperty('slider-autoWidth')}';
	var slideBy = {$instance->getProperty('slider-slideBy')};
	var center = {$instance->getProperty('slider-center')};
	var controls = {$instance->getProperty('slider-controls')};
	var controlsPosition = '{$instance->getProperty('slider-controlsPosition')}';
	var nav = {$instance->getProperty('slider-nav')};
	var navPosition = '{$instance->getProperty('slider-navPosition')}';
	var navAsThumbnails = {$instance->getProperty('slider-navAsThumbnails')};
	var arrowKeys = {$instance->getProperty('slider-arrowKeys')};
	var speed = {$instance->getProperty('slider-speed')};
	var autoplay = {$instance->getProperty('slider-autoplay')};
	var autoplayPosition = '{$instance->getProperty('slider-autoplayPosition')}';
	var autoplayTimeout = {$instance->getProperty('slider-autoplayTimeout')};
	var autoplayDirection = '{$instance->getProperty('slider-autoplayDirection')}';
	var autoplayHoverPause = {$instance->getProperty('slider-autoplayHoverPause')};
	var autoplayButtonOutput = {$instance->getProperty('slider-autoplayButtonOutput')};
	var autoplayResetOnVisibility = {$instance->getProperty('slider-autoplayResetOnVisibility')};
	var animateIn = '{$instance->getProperty('slider-animateIn')}';	
	var animateOut = '{$instance->getProperty('slider-animateOut')}';
	var animateNormal = '{$instance->getProperty('slider-animateNormal')}';
	var animateDelay = '{$instance->getProperty('slider-animateDelay')}';
	var loop = {$instance->getProperty('slider-loop')};
	var rewind = {$instance->getProperty('slider-rewind')};
	var autoHeight = {$instance->getProperty('slider-autoHeight')};
	var touch = {$instance->getProperty('slider-touch')};
	var mouseDrag = {$instance->getProperty('slider-mouseDrag')};
	var swipeAngle = {$instance->getProperty('slider-swipeAngle')};
	var preventActionWhenRunning = {$instance->getProperty('slider-preventActionWhenRunning')};
	var preventScrollOnTouch = {$instance->getProperty('slider-preventScrollOnTouch')};
	var nested = {$instance->getProperty('slider-nested')};
	var freezable = {$instance->getProperty('slider-freezable')};
	var disable = {$instance->getProperty('slider-disable')};
	var startIndex = {$instance->getProperty('slider-startIndex')};
	var useLocalStorage = {$instance->getProperty('slider-useLocalStorage')};

	//console.log(items);
	var slider = tns({
		"container": '.easy-slider',
		"mode": mode?mode:'carousel',
		"items": items?items:'1',
		"gutter": gutter>0?gutter:0,
		"edgePadding": edgePadding>0?edgePadding:0,
		"fixedWidth": fixedWidth>0?fixedWidth:false,
		"autoWidth": autoWidth,
		"viewportMax": viewportMax>0?viewportMax:false,
		"slideBy": slideBy>0?slideBy:1,
		"center": center,
		"controls": controls,
		{if $instance->getProperty('slider-controls') == 'true'}
			"controlsContainer": "#custom-control",
		{/if}
		"controlsPosition": controlsPosition?controlsPosition:'buttom',
		"nav": nav,
		"navPosition": navPosition?navPosition:'buttom',
		"navAsThumbnails": navAsThumbnails,
		"arrowKeys": arrowKeys, 
		"speed": speed>0?speed:300,
		"autoplay": autoplay,
		"autoplayPosition": autoplayPosition?autoplayPosition:'top',
		"autoplayTimeout": autoplayTimeout>0?autoplayTimeout:5000,
		"autoplayDirection": autoplayDirection,
		"autoplayHoverPause": autoplayHoverPause,
		"autoplayButtonOutput": autoplayButtonOutput,
		"autoplayResetOnVisibility": autoplayResetOnVisibility,
		"animateIn": animateIn,
		"animateOut": animateOut,
		"animateNormal": animateNormal,
		"animateDelay": animateDelay>0?animateDelay:false,
		"loop": loop,
		"rewind": rewind,
		"autoHeight":autoHeight,
		"touch":touch,
		"mouseDrag": mouseDrag,
		"swipeAngle": swipeAngle > 0?swipeAngle:false,
		"preventActionWhenRunning": preventActionWhenRunning,
		"preventScrollOnTouch": preventScrollOnTouch,
		"nested": nested,
		"freezable": freezable,
		"disable": disable,
		"startIndex": startIndex,
		"useLocalStorage": useLocalStorage,
	});
	</script>{/inline_script}
{/if}