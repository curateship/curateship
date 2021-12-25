@if((isset($settings_data['profile_template']) && !empty($settings_data['profile_template'])))
    @include("templates.profile.{$settings_data['profile_template']}")
@else
    @include('templates.profile.default')
@endif

