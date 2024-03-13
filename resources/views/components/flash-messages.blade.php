@if (session()->has('success'))
    <div class="alert" id="successAlert" data-dismiss="alert">
        <div class="alert-success inline-flex items-center">
            <p><i class="fa-solid fa-thumbs-up mr-3"></i>{{ session('success') }}</p>
            <button type="button" class="bg-opacity-50 bg-white px-3 py-1 rounded-full ml-10 block"
                    data-dismiss="alert" wire:click="$set('showSuccessAlert', false)"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert" id="errorAlert">
        <div class="alert-error inline-flex items-center">
            <p><i class="fa-solid fa-thumbs-down mr-3"></i>{{ session('error') }}</p>
            <button type="button" class="bg-opacity-50 bg-white px-3 py-1 rounded-full ml-10 block"
                    data-dismiss="alert" wire:click="$set('showErrorAlert', false)"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
@endif

<script>
    function timeoutAlert(alertId) {
        document.getElementById(alertId).style.display = 'none';
    }

    @if (session()->has('success'))
    setTimeout(function () {
        timeoutAlert('successAlert');
    }, 2000);
    @endif

    @if (session()->has('error'))
    setTimeout(function () {
        timeoutAlert('errorAlert');
    }, 2000);
    @endif
</script>
