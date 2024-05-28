@if(\Illuminate\Support\Facades\Session::has('success'))
    <div x-data="{ isVisible: true }" x-show.transition.duration.1000ms="isVisible" x-init="setTimeout(() => { isVisible = false }, 10000)"
        class="fixed bottom-0 right-0 mb-10 mr-10 bg-green-100 border border-green-200 py-2 px-2 rounded-2xl max-w-[600px] z-50" role="alert">
        <span class="font-bold text-sm py-1 px-2 rounded-full bg-green-200 mr-2"><i class="fa-solid fa-thumbs-up mr-2"></i>Succès</span>{{ Session::get('success') }}
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has('error'))
    <div x-data="{ isVisible: true }" x-show.transition.duration.1000ms="isVisible" x-init="setTimeout(() => { isVisible = false }, 10000)"
        class="fixed bottom-0 right-0 mb-10 mr-10 bg-red-100 border border-red-200 py-2 px-2 rounded-2xl max-w-[600px] z-50" role="alert">
        <span class="font-bold text-sm py-1 px-2 rounded-full bg-red-200 mr-2"><i class="fa-solid fa-circle-exclamation mr-2"></i>Oups !</span>{{ Session::get('error') }}
    </div>
@endif

@if(\Illuminate\Support\Facades\Session::has('info'))
    <div x-data="{ isVisible: true }" x-show.transition.duration.1000ms="isVisible" x-init="setTimeout(() => { isVisible = false }, 10000)"
        class="fixed bottom-0 right-0 mb-10 mr-10 bg-slate-100 border border-slate-200 py-2 px-2 rounded-2xl max-w-[600px] z-50" role="alert">
        <span class="font-bold text-sm py-1 px-2 rounded-full bg-slate-200 mr-2"><i class="fa-solid fa-info mr-2"></i>Information</span>{{ Session::get('info') }}
    </div>
@endif
