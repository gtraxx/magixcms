{extends file="layout.tpl"}
{block name='body:id'}install-config{/block}
{block name="main:content"}
{block name="main:breadcrumb"}
    {$breadcrumb = ['index.php' => $smarty.config.start,'analysis.php' => $smarty.config.analysis,
    'config.php' => $smarty.config.configuration,'database.php' => $smarty.config.database,
    'user.php' => $smarty.config.administrator]}
    {call name=breadcrumb data=$breadcrumb active=$smarty.config.finish}
{/block}
    <div class="mc-message clearfix"></div>
    <div class="mc-info clearfix">
        <div class="col-sm-6 alert alert-info">
            <span class="icon-info-sign"></span> {#info_finish#}
        </div>
    </div>
    <a href="#" class="btn btn-lg btn-block btn-primary" id="process_cache">
        <span class="icon-cog"></span> {#btn_finish#}
    </a>
    {block name="main:pager"}
        <ul class="pager">
            <li class="previous">
                <a href="/install/user.php">&larr; {#previous#}</a>
            </li>
        </ul>
    {/block}
{/block}
{block name="javascript"}
    {include file="clear/section/js.tpl"}
{/block}