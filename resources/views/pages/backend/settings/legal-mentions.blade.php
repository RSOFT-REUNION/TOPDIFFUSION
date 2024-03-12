@extends('layouts.backend')

@section('content-template')
    <div id="back_page_content">
        <form method="POST">
            @csrf
            <div id="entry-header" class="flex items-center mb-10">
                <div class="flex-1">
                    <h1>MENTIONS-LEGALES</h1>
                </div>
                <div class="flex-none inline-flex items-center">
                        <button type="submit" class="btn-secondary cursor-pointer"><i
                            class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                </div>
            </div>
            <div class="entry-content">
                <textarea name="page_content" class="tiny">@if($pageContent) {{  $pageContent->content  }} @endif</textarea>
            </div>
        </form>
    </div>
@endsection
