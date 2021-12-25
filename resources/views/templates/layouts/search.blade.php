@if(isset($settings_data['search_template']) && !empty($settings_data['search_template']))
    @include("templates.search.{$settings_data['search_template']}", $data)
    @else
    @include('templates.search.default', $data)
@endif
