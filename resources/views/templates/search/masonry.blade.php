@extends('templates.layouts.index')

<?php $seo_page_title = ($settings_data['tag_page_title']) ? $settings_data['tag_page_title'] : $page_title; ?>
<?php $seo_meta_title = ($settings_data['tag_meta_title']) ? $settings_data['tag_meta_title'] : $page_title; ?>

@isset($seo_page_title)
  @section('title-tag'){!! $seo_page_title !!}@endsection
@endisset

@isset($seo_meta_title)
  @section('meta-title-tag'){!! $seo_meta_title !!}@endsection
@endisset

@section('content')
    <section class="margin-top-md">
        <div class="container max-width-adaptive-lg">
            <p class="text-xl margin-bottom-md">{{ $page_title }}</p>
        </div>
    </section>

@include('components.posts.lists.masonry-v3')

@endsection
