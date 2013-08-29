<div id="header" class="row">
    <div id="header-navbar" class="navbar navbar-inverse span12">
        <div class="navbar-inner">
            <a id="logo" class="brand" href="/{getlang}/" title="{#logo_link_title#|firststring}">
                <img src="/skin/{template}/img/logo-magix_cms.png" alt="{#logo_img_alt#|firststring}" />
            </a>
            {include file="section/primary-nav.tpl"}
            <ul id="lang-box" class="nav pull-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="{#chooser_language#|firststring}">
                        <span class="icon-comment icon-white">&nbsp;</span>
                        <b class="caret"></b>
                    </a>
                    {widget_lang_display
                        htmlStructure=[
                            'container' => [
                                'before' => '<ul id="lang-nav" class="dropdown-menu">'
                            ]
                        ]
                    }
                </li>
            </ul>
        </div>
    </div>
    <div id="header-toolbar" class="span12">
        <ul id="share-box" class="nav">
            <li>
                <a href="#" class="dropdown-toggle btn" data-toggle="dropdown">
                    <span class="icon-share">&nbsp;</span>
                        {#share#|firststring}
                    <b class="caret"></b>
                </a>
                {widget_share_display
                    htmlStructure=[
                        'container' => [
                            'before' => '<ul id="share-nav" class="dropdown-menu">',
                            'after' => '</ul>'
                        ]
                    ]
                }
            </li>
        </ul>
        {include file="section/breadcrumb.tpl"}
    </div>
</div>