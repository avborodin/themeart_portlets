{if isset($paymentIcons)}
<div class="basket-payment-icons d-flex justify-content-start">
	{foreach $paymentIcons as $paymentIcon}
	    {image src="{$paymentIcon->cBild}" class='p-1' square=true lazy=true webP=true height=50 width=auto alt="{$paymentIcon->cName}"}
	{/foreach}            
</div
{/if}