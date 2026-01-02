<!-- Global Ads Container -->
@if(isset($settings['ad_top']))
    <x-ad-banner :content="$settings['ad_top']" position="top" />
@endif

@if(isset($settings['ad_center']))
    <x-ad-banner :content="$settings['ad_center']" position="center" />
@endif

@if(isset($settings['ad_footer']))
    <x-ad-banner :content="$settings['ad_footer']" position="bottom" />
@endif
