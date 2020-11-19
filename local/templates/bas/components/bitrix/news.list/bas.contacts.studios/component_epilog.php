<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
$(function () {
    var res;
    if(res = location.hash.match(/^#tab-studio-gallery-(\d+)$/))
    {
        $('a[href="#tab-studio-'+res[1]+'"]').click();
    }
})
</script>
