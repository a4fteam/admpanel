<!-- Yandex.Metrika informer -->
@if(isset($seo) && !empty(trim($seo['yandex_id'])))
<a href="https://metrika.yandex.ru/stat/?id={{$seo['yandex_id']}}&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/{{$seo['yandex_id']}}/3_0_CCE5FFFF_CCE5FFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="{{$seo['yandex_id']}}" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->
@endif