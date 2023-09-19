@extends('layouts.backend')

@section('content-template')
<div id="back_page_content">
    <div id="entry-header" class="border-b border-gray-100">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Equipes</h1>
            </div>
            <div class="flex-none">

            </div>
        </div>
    </div>
    <div class="w-1/2 flex flex-col gap-5 mt-12">
        <div class="p-4 rounded-xl shadow-lg ring-black/5 border-solid border border-gray-950 bg-white hover:bg-slate-100 active:bg-slate-200">
            <div class="text-sm leading-6 text-slate-900 dark:text-white font-semibold select-none list-none">
                <div class="flex items-center gap-x-6">
                    <svg class="svg-inline--fa fa-circle-user h-16 w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM512 256c0 141.4-114.6 256-256 256S0 397.4 0 256S114.6 0 256 0S512 114.6 512 256zM256 272c39.8 0 72-32.2 72-72s-32.2-72-72-72s-72 32.2-72 72s32.2 72 72 72z"></path></svg>
                    <div>
                        <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-900">Topdiffusion</h3>
                        <p class="text-sm font-semibold leading-6 text-indigo-600">Administrateur</p>
                    </div>
                    <div class="ml-auto">
                        <a class="px-2 text-lg hover:bg-gray-300 rounded-md"  onclick=""><i class="fa-solid fa-pen"></i></a>
                        <a class="px-2 text-lg hover:bg-gray-300 rounded-md"  onclick=""><i class="fa-solid fa-comment"></i></a>
                        <a class="px-2 text-lg hover:bg-gray-300 rounded-md"  onclick=""><i class="fa-solid fa-receipt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
