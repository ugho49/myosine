@extends('layouts.private')

@section('content')
    <p class="text-center">
        <a href="{{ URL::route('admin_video.create') }}" class="btn btn-success btn-raised" role="button">Ajouter une nouvelle video</a>
    </p>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr class="text-center">
                        <th>Titre</th>
                        <th>Url</th>
                        <th>Visible</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $video)
                        <tr data-id="{{ $video->id }}" @if(!$video->enabled) class="danger" @endif>
                            <td><p>{{ $video->title }}</p></td>
                            <td><a style="margin: 0px;" href="{{ $video->url }}" target="_blank" class="btn">voir la video</a></td>
                            <td>
                                @if($video->enabled)
                                    <span class="status">Visible</span>
                                @else
                                    <span class="status">Non Visible</span>
                                @endif
                            </td>
                            <td>
                                <a style="margin: 0px;" data-id="{{ $video->id }}" class="btn btn-info edit_video" href="{{ URL::route('admin_video.edit', $video->id) }}">
                                    Modifier &nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a style="margin: 0px;" data-id="{{ $video->id }}" class="btn btn-danger remove_video" href="{{ URL::route('admin_video.remove', $video->id) }}">
                                    Supprimer &nbsp;<i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('.remove_video:not("disabled")').click(function(e) {

                e.preventDefault();

                var buttonDelete = $(this);
                var id = buttonDelete.data('id');
                var buttonEdit = $('a.edit_video[data-id="'+ id +'"]');

                if (buttonDelete.attr('disabled')) {
                    return;
                }

                buttonDelete.attr('disabled','disabled');
                buttonEdit.attr('disabled','disabled');

                var url = buttonDelete.attr('href');

                bootbox.setLocale('fr');

                bootbox.confirm("Etes vous sur ?", function(result) {
                    if (result) {
                        $.get( url , function( data ) {
                            if (data) {
                                remove_video(id);
                            } else {
                                alert('erreur interne intervenue lors de la suppression');
                                buttonDelete.removeAttr('disabled');
                                buttonEdit.removeAttr('disabled');
                            }
                        });
                    }
                    buttonDelete.removeAttr('disabled');
                    buttonEdit.removeAttr('disabled');
                });

            });

            function remove_video (id) {
                var tr = $('tr[data-id="'+ id +'"]');
                tr.fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    </script>
@endsection