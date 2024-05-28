<div>
    <div class="inline-flex items-center w-full">
        <h1 class="font-title font-bold text-xl">Stocks</h1>
    </div>
    <div class="mt-5 grid grid-cols-3 gap-5">
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $stock_available->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. produit en stock</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $stock_low->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. produit avec un stock faible</p>
            </div>
        </div>
        <div class="border rounded-xl hover:bg-slate-100 hover:scale-105 duration-300 group hover:drop-shadow-2xl cursor-pointer overflow-hidden">
            <div class="inline-flex items-center justify-center gap-5 w-full p-5 bg-white">
                <p class="text-xl font-title">{{ $stock_off->count() }}</p>
            </div>
            <div class="border-t bg-slate-100 p-3 text-center">
                <p class="text-slate-400 text-sm">Nb. produit avec un en rupture de stock</p>
            </div>
        </div>
    </div>
</div>
