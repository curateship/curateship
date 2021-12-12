@if((isset($settings_data['post_template']) && !empty($settings_data['post_template'])))
    @include("templates.post.{$settings_data['post_template']}")
@else
    @include('templates.post.default')
@endif
