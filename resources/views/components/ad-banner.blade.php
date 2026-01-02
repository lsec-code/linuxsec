@props(['content', 'position' => 'bottom'])

@if(!empty($content))
    @php
        $classes = 'fixed left-0 w-full z-[9999] flex justify-center pointer-events-none';
        
        switch ($position) {
            case 'top':
                $classes .= ' top-0 pt-0';
                break;
            case 'center':
                $classes = 'fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[9999] pointer-events-none';
                break;
            case 'bottom':
            default:
                $classes = 'w-full flex justify-center py-4 relative z-[9999]';
                break;
        }
    @endphp

    <div class="{{ $classes }}">
        <div class="pointer-events-auto relative">
            {!! $content !!}
        </div>
    </div>
@endif
