{extends file="layout.tpl"}


{block name=body}

Result:
<!--{$isbn}
{$title}-->

{foreach $result as $key => $value}
    {$value}
{/foreach}



{/block}
