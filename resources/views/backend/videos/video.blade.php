@extends('layouts.private')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="@if($action == 'edit') {{ URL::route('admin_video.update', $video->id) }} @elseif($action == 'create') {{ URL::route('admin_video.store') }} @endif">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="video_title" class="control-label">Titre :</label>
                    <input type="text" class="form-control input-md" id="video_title" placeholder="Titre de la video" name="title" value="@if( old('title') ){{ old('title') }}@elseif( $video->title ){{ $video->title }}@endif" required="required">
                </div>

                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url" class="control-label">Lien de la video :</label>
                    <input type="text" class="form-control input-md" id="url" placeholder="Lien de la video" name="url" value="@if( old('url') ){{ old('url') }}@elseif( $video->url ){{ $video->url }}@endif" required="required">
                </div>

                <div class="form-group{{ $errors->has('enabled') ? ' has-error' : '' }}">
                    <label class="control-label">Visible</label>

                    <div class="radio radio-primary">
                        <label>
                            <input type="radio" name="enabled" required="required" id="optionActivate" value="1" @if( (old('enabled') && old('enabled') == 1) or $video->enabled )checked="checked" @endif>
                            Video visible
                        </label>
                    </div>
                    <div class="radio radio-primary">
                        <label>
                            <input type="radio" name="enabled" required="required" id="optionDesactivate" value="0" @if( (old('enabled') && old('enabled') == 0) or !$video->enabled )checked="checked" @endif>
                            Video non affichée
                        </label>
                    </div>
                </div>

                <div class="text-center">
                    <a class="btn btn-lg btn-raised" href="{{ URL::route('admin_video') }}">Retour</a>

                    @if($action == 'edit')
                        <button class="btn btn-raised btn-info btn-lg" type="submit">Modifier</button>
                    @elseif($action == 'create')
                        <button class="btn btn-raised btn-success btn-lg button-create" type="submit">Créer</button>
                    @endif
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('form').submit(function(){
                $('button.button-create').attr('disabled','disabled');
            });
        });
    </script>
@endsection
