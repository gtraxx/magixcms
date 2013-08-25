{extends file="layout.tpl"}
{block name='body:id'}module-catalog{/block}
{block name="article:content"}
{include file="catalog/section/nav.tpl"}
<h1>{#editing_the_product#|ucfirst} : {$titlecatalog}</h1>
<ul class="nav nav-tabs clearfix">
    <li{if !$smarty.get.tab && !$smarty.get.plugin} class="active"{/if}>
        <a href="/admin/catalog.php?section={$smarty.get.section}&amp;getlang={$smarty.get.getlang}&amp;action=edit&amp;edit={$smarty.get.edit}">{#text#|ucfirst}</a>
    </li>
    <li{if $smarty.get.tab eq "image"} class="active"{/if}>
        <a href="/admin/catalog.php?section={$smarty.get.section}&amp;getlang={$smarty.get.getlang}&amp;action=edit&amp;edit={$smarty.get.edit}&amp;tab=image">Image</a>
    </li>
    <li{if $smarty.get.tab eq "category"} class="active"{/if}>
        <a href="/admin/catalog.php?section={$smarty.get.section}&amp;getlang={$smarty.get.getlang}&amp;action=edit&amp;edit={$smarty.get.edit}&amp;tab=category">{#categories#|ucfirst}</a>
    </li>
    <li{if $smarty.get.tab eq "product"} class="active"{/if}>
        <a href="/admin/catalog.php?section={$smarty.get.section}&amp;getlang={$smarty.get.getlang}&amp;action=edit&amp;edit={$smarty.get.edit}&amp;tab=product">{#products#|ucfirst}</a>
    </li>
    <li{if $smarty.get.tab eq "galery"} class="active"{/if}>
        <a href="/admin/catalog.php?section={$smarty.get.section}&amp;getlang={$smarty.get.getlang}&amp;action=edit&amp;edit={$smarty.get.edit}&amp;tab=galery">{#galery#|ucfirst}</a>
    </li>
    {if $plugin != null}
    {foreach $plugin as $key => $value}
        <li{if $smarty.get.plugin eq $key} class="active"{/if}>
            <a href="/admin/catalog.php?section={$smarty.get.section}&amp;getlang={$smarty.get.getlang}&amp;action=edit&amp;edit={$smarty.get.edit}&amp;plugin={$key}">{$key|ucfirst}</a>
        </li>
    {/foreach}
    {/if}
</ul>
<div class="mc-message clearfix"></div>
{include file="catalog/product/forms/edit.tpl"}
{/block}
{block name="modal"}
    <div id="window-dialog"></div>
    <div id="forms-add" class="hide-modal" title="{#add_a_product#|ucfirst}">
        {include file="catalog/product/forms/add.tpl"}
    </div>
{/block}
{block name='javascript'}
    {include file="catalog/section/js.tpl"}
    {if $smarty.get.plugin}
        {$plugin_display.javascript}
    {/if}
{/block}