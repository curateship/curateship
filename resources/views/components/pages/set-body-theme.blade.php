@if(\Illuminate\Support\Facades\Auth::guest())
    @if(\Modules\Admin\Entities\Settings::where('key', 'theme')->first()->value == 'dark')
        data-theme="dark"
    @endif
@else
    @if(\Illuminate\Support\Facades\Auth::user()->getTheme() == 'dark')
        data-theme="dark"
    @endif
@endif
