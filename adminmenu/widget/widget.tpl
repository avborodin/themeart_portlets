<script type="text/javascript">
    $(document).ready(function () {
        ioCall(
            'getRemoteData',
            ['https://www.themeart.de/rss.xml',
                'oNews_arr',
                'widgets/news_data.tpl',
                'news_themeart_wrapper'],
            undefined,
            undefined,
            undefined,
            true
        );
    });
</script>
<div class="widget-custom-data">
    <div id="news_themeart_wrapper">
        <p class="ajax_preloader"><i class="fa fas fa-spinner fa-spin"></i> {__('loading')}</p>
    </div>
</div>