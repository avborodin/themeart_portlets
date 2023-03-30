{if $isPreview}
    {$slides = $instance->getProperty('slides')}
    {if $slides|count > 0}
        {$imgAttribs = $instance->getImageAttributes($slides[0].url, '', '')}
    {/if}
    <div class="text-center opc-ImageSlider opc-ImageSlider-with-image" style="background-image: url('{$portlet->getBaseUrl()|cat:'preview.png'}'); {$instance->getStyleString()}">
        <div>
            {file_get_contents($portlet->getBasePath()|cat:'icon.svg')}
            <span>{__('Bilder-Slider')}</span>
        </div>
    </div>
{else}
    {$uid = $instance->getUid()}
    {if $instance->getProperty('slides')|count > 0}
        <div class="ta-slider-wrapper {$instance->getStyleClasses()}" style="display-:none;{$instance->getStyleString()}">
            <div class="slick-slider-other">
                {row id="{$uid}" class="slick-smooth-loading carousel carousel-arrows-inside slick-lazy-brand slick-type-brand" data=["slick-type"=>"brand-slider"]}
                    {foreach $instance->getProperty('slides') as $i => $slide}
                        {if !empty($slide.title)}
                            {$slideTitle = $slide.title}
                        {else}
                            {$slideTitle = ''}
                        {/if}

                        {if !empty($slide.desc)}
                            {$slideDesc = $slide.desc}
                        {else}
                            {$slideDesc = ''}
                        {/if}

                        {if !empty($slide.url)}
                            {$imgAttribs = $instance->getImageAttributes($slide.url, '', '')}

                            {if !empty($slide.link)}
                                <a href="{$slide.link}"
                                   {if !empty($slide.title)}title="{$slide.title|escape:'html'}"{/if}
                                   class="brand-wrapper text-center">
                            {else}
                                <div class="brand-wrapper text-center">
                            {/if}
                            <div class="productbox-image square square-image">
                                <div class="inner">
                                    {image fluid=true lazy=true webp=true
                                        srcset=$imgAttribs.srcset
                                        sizes=$imgAttribs.srcsizes
                                        width=120
                                        height=120 
                                        src=$imgAttribs.src
                                        alt=$imgAttribs.alt|escape:'html'
                                        title=$slideTitle|escape:'html'}
                                </div>
                            </div>
                                {if !empty($slideDesc)}
                                    <span class="item-slider-desc d-inline-block mt-2">{$slideDesc}</span>
                                {/if}
                            {if !empty($slide.link)}
                                </a>
                            {else}
                                </div>
                            {/if}
                        {/if}
                    {/foreach}
                {/row}
                </div>
            </div>
            {inline_script}<script>
                var initBrandSlider = function () {
                    var taSlider = $('#{$uid}.slick-type-brand');
                    $('a.brand-wrapper').click(function () {
                        if (!this.href.match(new RegExp('^' + location.protocol + '\\/\\/' + location.host))) {
                            this.target = '_blank';
                        }
                    });
                    taSlider.slick({
                        dots: {$instance->getProperty('slider-navigation')},
                        arrows: {$instance->getProperty('slider-direction-navigation')},
                        lazyLoad: 'ondemand',
                        autoplay: {$instance->getProperty('slider-start')},
                        autoplaySpeed: 2000,
                        speed: 
                            {if !empty($instance->getProperty('slider-animation-speed'))}
                                {$instance->getProperty('slider-animation-speed')},
                            {else}
                                300,
                            {/if}
                        slidesToShow: {$instance->getProperty('slider-to-show-sm')},
                        slidesToScroll: 1,
                        mobileFirst: true,
                        pauseOnHover: {$instance->getProperty('slider-pause')},
                        centerMode: {$instance->getProperty('slider-centermode')},
                        variableWidth: false,
                        responsive: [
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: {$instance->getProperty('slider-to-show-sm')}
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: {$instance->getProperty('slider-to-show-md')}
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: {$instance->getProperty('slider-to-show-lg')} 
                                }
                            },
                            {
                                breakpoint: 1300,
                                settings: {
                                    slidesToShow: {$instance->getProperty('slider-to-show-xl')} 
                                }
                            }
                        ]
                    });
                };
                $('.slick-lazy-brand').on('mouseenter touchmove', function (e) {
                    let mainNode = $(this);
                    mainNode.removeClass('slick-lazy-brand');
                    if (!mainNode.hasClass('slick-initialized')) {
                        $(initBrandSlider);
                    }
                });
            </script>{/inline_script}
        {/if}
{/if}