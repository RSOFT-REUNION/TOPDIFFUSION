@extends('layouts.backend')

@section('content-template')
    <main role="main" id="back_page_content">
        <form method="POST">
            @csrf
            <div class="entry-header flex items-center">
                <div class="flex-1">
                    <h1>Page "POLITIQUE DE CONFIDENTIALITE"</h1>
                </div>
                <div class="flex-none inline-flex items-center">
                    <button type="submit" class="btn-filled_secondary"><i
                            class="fa-solid fa-floppy-disk mr-3"></i>Sauvegarder</button>
                </div>
            </div>
            <div class="entry-content">
                <textarea name="page_content" class="tiny">@if($pageContent) {{  $pageContent->content  }} @endif</textarea>
            </div>
        </form>
    </main>
@endsection
