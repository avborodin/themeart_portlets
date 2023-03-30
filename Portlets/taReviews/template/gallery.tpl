{if isset($reviews)}
{strip}
    {row class="ta-reviews"}
    {foreach $reviews as $review}
        {col cols=12 md=4 lg=3 xl=3}
            <div class="card-body text-center">
                <div class="card-title font-weight-bold">{$review->cTitel}</div>
                {include file='productdetails/rating.tpl' stars=$review->nSterne}
                <div class="card-text text-muted">{$review->cText|strip_tags|truncate:120}</div>
                <div class="blockquote-footer">{$review->cName}</div>
            </div>
      	{/col}
    {/foreach}
    {/row}
{/strip}
{/if}