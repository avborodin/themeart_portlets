{if isset($reviews)}
{strip}
    <div class="ta-reviews">
    {foreach $reviews as $review}
        <div class="card-body text-center- mb-4">
            <div class="card-title">{$review->cTitel}</div>
            {include file='productdetails/rating.tpl' stars=$review->nSterne link=$review->cURLFull}
            <div class="card-text text-muted">{$review->cText|strip_tags|truncate:90}</div>
            <div class="blockquote-footer">{$review->cName}</div>
        </div>
    {/foreach}
    </div>
{/strip}
{/if}