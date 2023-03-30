{if $Artikel->cLagerBeachten == 'Y'}
<div class="delivery-status stock-progress-bar">
	<div class="text-center mb-2">{$noticeStock}</div>
	{math equation='a/b*c' a=$Artikel->fLagerbestand b=$conf['global']['artikel_lagerampel_gruen'] c=100 assign='percent'}
	<div class="progress ta-stock">
	  	<div class="progress-bar status-{$Artikel->Lageranzeige->nStatus}" role="progressbar" style="width: {$percent}%;" aria-valuenow="{$percent}" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
</div>
{/if}