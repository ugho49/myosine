@extends('layouts.public')

@section('title', 'Galerie photos de la salle myosine Angers')
@section('description', 'Galerie photos de la salle. Venez découvrir les lieux par vous même !!!!')

@section('section_title', 'Galerie photos')

@section('content')
    <style>
        div.fotorama * {
            box-sizing: initial !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
            <div class="fotorama" {!! $options !!}>

                @foreach ($videos as $video)
                    @if($video->enabled)
                        <a href="{{ $video->url }}"
                           data-video="true"
                           data-caption="{{ $video->title }}">{{ $video->title }}</a>
                    @endif
                @endforeach

                @foreach ($images_urls as $url)
                    <a href="{{ $url['url'] }}"></a>
                @endforeach

            </div>
        </div>
    </div>
@endsection

