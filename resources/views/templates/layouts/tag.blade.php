@if(isset($settings_data['tag_template']) && !empty($settings_data['tag_template']))
    @include("templates.tag.{$settings_data['tag_template']}", $data)
    @else
    @include('templates.tag.default', $data)
@endif
