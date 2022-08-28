@extends('layouts.home')
@section('content')
<!-- News With Sidebar Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Tag: {{ $tag->name }}</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                        </div>
                    </div>
                    <x-pages.data-article :items="$dataArticles" id="{{ $dataCategories->id }}" name="{{ $dataCategories->name }}"/>
                </div>
            </div>
            
            <div class="col-lg-4">
                
                <x-pages.tag-slider/>

                <x-pages.news-slider/>

                @include('pages.social-media')

            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
@endsection