{strip}
    {if !isset($adjust)}
        {assign var="adjust" value="clip"}
    {/if}
    {* facebook, news, cms, contact, newsletter*}
    {if !isset($blocks)}
        {assign var="blocks" value=['news','contact']}
    {/if}
    {widget_share_data assign="shareData"}
{/strip}
<footer id="footer"{if $adjust == 'fluid'} class="section-block container-fluid"{/if}>
    {include file="section/footer/sharebar.tpl"}
    {if is_array($blocks) && !empty($blocks)}
        <section id="footer-blocks">
            {if $adjust == 'clip'}
            <div class="container">
                <div class="row">
                    {/if}
                    {foreach $blocks as $block}
                        {include file="section/footer/block/$block.tpl" classCol="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3"}
                    {/foreach}
                    {if $adjust == 'clip'}
                </div>
            </div>
            {/if}
        </section>
    {/if}
    <section id="colophon">
        {if $adjust == 'clip'}<div class="container">{/if}
            {include file="section/footer/about.tpl"}
        {if $adjust == 'clip'}</div>{/if}
    </section>
</footer>
{include file="section/footer/footbar.tpl"}