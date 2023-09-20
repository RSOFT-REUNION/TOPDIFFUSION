@if ($message = Session::get('success'))
    <div class="alert" id="alert">
        <div class="alert-success inline-flex items-center">
            <p><i class="fa-solid fa-thumbs-up mr-3"></i>{{ $message }}</p>
            <button type="button" class="bg-opacity-50 bg-white px-3 py-1 rounded-full ml-10 block"
                data-dismiss="alert"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
@endif
