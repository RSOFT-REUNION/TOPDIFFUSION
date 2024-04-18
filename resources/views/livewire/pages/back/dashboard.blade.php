<div>
    <div id="entry-header" class="border-b border-gray-100">
        <div class="flex items-center">
            <div class="flex-1">
                <h1>Tableau de bord</h1>
                {{-- <button wire:click="$emit('openModal', 'popups.relay-point')">Edit User</button> --}}
            </div>
            <div class="flex-none">

            </div>
        </div>
    </div>
    <div id="entry-content" class="mt-5">
        {{-- grids --}}
        <div class="grid grid-cols-4 grid-rows-auto gap-5 bg-gray-100 p-5 rounded-xl">
            <div class="bg-white p-5 flex flex-col justify-center gap-y-5 rounded-lg">
                <h2 class="text-gray-500">Nombre de vente</h2>
                <div class="flex flex-row items-end">
                    {{-- <h3 class="font-bold mr-2 text-2xl">{{ $sales['total_sales'] }}</h3> --}}
                    <span class="pb-0.5">Cette semaine</span>
                </div>
{{--                <div class="text-green-500">--}}
{{--                    <i class="fa-solid fa-arrow-trend-up"></i><span class="font-bold ml-2">+20 %</span>--}}
{{--                </div>--}}
            </div>
            <div class="bg-white p-5 flex flex-col justify-center gap-y-5 rounded-lg">
                <h2 class="text-gray-500">Nombre de produits créés</h2>
                <div class="flex flex-row items-end">
                    {{-- <h3 class="font-bold mr-2 text-2xl">{{ $productCreated['total_productCreated'] }}</h3> --}}
                    <span class="pb-0.5">Ce mois-ci</span>
                </div>
{{--                <div class="text-green-500">--}}
{{--                    <i class="fa-solid fa-arrow-trend-down"></i><span class="font-bold ml-2">+20</span>--}}
{{--                </div>--}}
            </div>
{{--            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 h-full row-span-2">--}}
{{--                <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 m-4 md:m-6 pb-3">--}}
{{--                <dl>--}}
{{--                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Chiffre des ventes réaliser</dt>--}}
{{--                    <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">{{ $totalSalesRevenue }} €</dd>--}}
{{--                </dl>--}}
{{--                <div--}}
{{--                    class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">--}}
{{--                    12%--}}
{{--                    <svg class="w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                --}}{{-- <div>--}}
{{--                    <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">--}}
{{--                    <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>--}}
{{--                    </svg>--}}
{{--                    Profit rate 23.5%--}}
{{--                    </span>--}}
{{--                </div> --}}
{{--                </div>--}}
{{--                <div id="area-chart"></div>--}}
{{--                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between m-4 md:m-6">--}}
{{--                        <div class="flex justify-between items-center pt-5">--}}
{{--                    <!-- Button -->--}}
{{--                    <button--}}
{{--                    id="dropdownDefaultButton"--}}
{{--                    data-dropdown-toggle="lastDaysdropdown"--}}
{{--                    data-dropdown-placement="bottom"--}}
{{--                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"--}}
{{--                    type="button">--}}
{{--                    7 derniers jours--}}
{{--                    <svg class="w-2.5 m-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>--}}
{{--                    </svg>--}}
{{--                    </button>--}}
{{--                    <!-- Dropdown menu -->--}}
{{--                    <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">--}}
{{--                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hier</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aujourd'hui</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">7 derniers jours</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">90 derniers jours</a>--}}
{{--                        </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    --}}{{-- <a--}}
{{--                    href="#"--}}
{{--                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-secondary hover:text-yellow-500 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">--}}
{{--                    Rapport des utilisateurs--}}
{{--                    <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>--}}
{{--                    </svg>--}}
{{--                    </a> --}}
{{--                </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <script>--}}
{{--                // ApexCharts options and config--}}
{{--                window.addEventListener("load", function() {--}}
{{--                let options = {--}}
{{--                    chart: {--}}
{{--                    height: "200",--}}
{{--                    maxWidth: "100%",--}}
{{--                    type: "area",--}}
{{--                    fontFamily: "Inter, sans-serif",--}}
{{--                    dropShadow: {--}}
{{--                        enabled: false,--}}
{{--                    },--}}
{{--                    toolbar: {--}}
{{--                        show: false,--}}
{{--                    },--}}
{{--                    },--}}
{{--                    tooltip: {--}}
{{--                    enabled: true,--}}
{{--                    x: {--}}
{{--                        show: false,--}}
{{--                    },--}}
{{--                    },--}}
{{--                    fill: {--}}
{{--                    type: "gradient",--}}
{{--                    gradient: {--}}
{{--                        opacityFrom: 0.55,--}}
{{--                        opacityTo: 0,--}}
{{--                        shade: "#FBBC34",--}}
{{--                        gradientToColors: ["#FBBC34"],--}}
{{--                    },--}}
{{--                    },--}}
{{--                    dataLabels: {--}}
{{--                    enabled: false,--}}
{{--                    },--}}
{{--                    stroke: {--}}
{{--                    width: 6,--}}
{{--                    },--}}
{{--                    grid: {--}}
{{--                    show: false,--}}
{{--                    strokeDashArray: 4,--}}
{{--                    padding: {--}}
{{--                        left: 2,--}}
{{--                        right: 2,--}}
{{--                        top: 0--}}
{{--                    },--}}
{{--                    },--}}
{{--                    series: [--}}
{{--                    {--}}
{{--                        name: "New users",--}}
{{--                        data: [6500, 6418, 6456, 6526, 6356, 6456],--}}
{{--                        color: "#FBBC34",--}}
{{--                    },--}}
{{--                    ],--}}
{{--                    xaxis: {--}}
{{--                        categories: [--}}
{{--                            '01 Janvier', '02 Février', '03 Mars', '04 Avril', '05 Mai', '06 Juin', '07 Juillet', '08 Août',--}}
{{--                            '09 Septembre', '10 Octobre', '11 Novembre', '12 Décembre'--}}
{{--                        ],--}}
{{--                        labels: {--}}
{{--                        show: false,--}}
{{--                    },--}}
{{--                    axisBorder: {--}}
{{--                        show: false,--}}
{{--                    },--}}
{{--                    axisTicks: {--}}
{{--                        show: false,--}}
{{--                    },--}}
{{--                    },--}}
{{--                    yaxis: {--}}
{{--                    show: false,--}}
{{--                    },--}}
{{--                }--}}

{{--                if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {--}}
{{--                    const chart = new ApexCharts(document.getElementById("area-chart"), options);--}}
{{--                    chart.render();--}}
{{--                }--}}
{{--                });--}}
{{--            </script>--}}

{{--            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 h-full p-4 md:p-6 row-span-2">--}}
{{--                <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">--}}
{{--                <dl>--}}
{{--                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Chiffre du panier moyen</dt>--}}
{{--                    <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">{{ $averagePurchase }} €</dd>--}}
{{--                </dl>--}}
{{--                <div--}}
{{--                    class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">--}}
{{--                    12%--}}
{{--                    <svg class="w-3 h-3 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">--}}
{{--                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                </div>--}}

{{--                <div id="bar-chart"></div>--}}
{{--                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">--}}
{{--                    <div class="flex justify-between items-center pt-5">--}}
{{--                    <!-- Button -->--}}
{{--                    <button--}}
{{--                        id="dropdownDefaultButton"--}}
{{--                        data-dropdown-toggle="lastDaysdropdown"--}}
{{--                        data-dropdown-placement="bottom"--}}
{{--                        class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"--}}
{{--                        type="button">--}}
{{--                        7 derniers jours--}}
{{--                        <svg class="w-2.5 m-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                    <!-- Dropdown menu -->--}}
{{--                    <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">--}}
{{--                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">--}}
{{--                            <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hier</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aujourd'hui</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Les 7 derniers jours</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">--}}
{{--                            Les 30 derniers jours</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">90 derniers jours</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">6 derniers mois</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">L'année dernière</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    --}}{{-- <a--}}
{{--                        href="#"--}}
{{--                        class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">--}}
{{--                        Rapport sur les revenus--}}
{{--                        <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>--}}
{{--                        </svg>--}}
{{--                    </a> --}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <script>--}}
{{--                // ApexCharts options and config--}}
{{--                window.addEventListener("load", function() {--}}
{{--                const options = {--}}
{{--                    series: [--}}
{{--                    {--}}
{{--                        name: "Income",--}}
{{--                        color: "#31C48D",--}}
{{--                        data: ["1420", "1620", "1820", "1420", "1650", "2120"],--}}
{{--                    },--}}
{{--                    {--}}
{{--                        name: "Expense",--}}
{{--                        data: ["788", "810", "866", "788", "1100", "1200"],--}}
{{--                        color: "#F05252",--}}
{{--                    }--}}
{{--                    ],--}}
{{--                    chart: {--}}
{{--                    sparkline: {--}}
{{--                        enabled: false,--}}
{{--                    },--}}
{{--                    type: "bar",--}}
{{--                    width: "100%",--}}
{{--                    height: 250,--}}
{{--                    toolbar: {--}}
{{--                        show: false,--}}
{{--                    }--}}
{{--                    },--}}
{{--                    plotOptions: {--}}
{{--                    bar: {--}}
{{--                        horizontal: true,--}}
{{--                        columnWidth: "100%",--}}
{{--                        borderRadiusApplication: "end",--}}
{{--                        borderRadius: 6,--}}
{{--                        dataLabels: {--}}
{{--                        position: "top",--}}
{{--                        },--}}
{{--                    },--}}
{{--                    },--}}
{{--                    legend: {--}}
{{--                    show: true,--}}
{{--                    position: "bottom",--}}
{{--                    },--}}
{{--                    dataLabels: {--}}
{{--                    enabled: false,--}}
{{--                    },--}}
{{--                    tooltip: {--}}
{{--                    shared: true,--}}
{{--                    intersect: false,--}}
{{--                    formatter: function (value) {--}}
{{--                        return "$" + value--}}
{{--                    }--}}
{{--                    },--}}
{{--                    xaxis: {--}}
{{--                    labels: {--}}
{{--                        show: true,--}}
{{--                        style: {--}}
{{--                        fontFamily: "Inter, sans-serif",--}}
{{--                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'--}}
{{--                        },--}}
{{--                        formatter: function(value) {--}}
{{--                        return "$" + value--}}
{{--                        }--}}
{{--                    },--}}
{{--                    categories: ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],--}}
{{--                    axisTicks: {--}}
{{--                        show: false,--}}
{{--                    },--}}
{{--                    axisBorder: {--}}
{{--                        show: false,--}}
{{--                    },--}}
{{--                    },--}}
{{--                    yaxis: {--}}
{{--                    labels: {--}}
{{--                        show: true,--}}
{{--                        style: {--}}
{{--                        fontFamily: "Inter, sans-serif",--}}
{{--                        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'--}}
{{--                        }--}}
{{--                    }--}}
{{--                    },--}}
{{--                    grid: {--}}
{{--                    show: true,--}}
{{--                    strokeDashArray: 4,--}}
{{--                    padding: {--}}
{{--                        left: 2,--}}
{{--                        right: 2,--}}
{{--                        top: -20--}}
{{--                    },--}}
{{--                    },--}}
{{--                    fill: {--}}
{{--                    opacity: 1,--}}
{{--                    }--}}
{{--                }--}}

{{--                if(document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {--}}
{{--                    const chart = new ApexCharts(document.getElementById("bar-chart"), options);--}}
{{--                    chart.render();--}}
{{--                }--}}
{{--                });--}}
{{--            </script>--}}

            <div class="bg-white p-5 flex flex-col justify-center gap-y-5 rounded-lg">
                <h2 class="text-gray-500">Nombre de nouveau compte</h2>
                <div class="flex flex-row items-end">
                    {{-- <h3 class="font-bold mr-2 text-2xl">{{ $newAccountCreated['total_new_account'] }}</h3> --}}
                    <span class="pb-0.5">Ce mois-ci</span>
                </div>
{{--                <div class="text-red-500">--}}
{{--                    <i class="fa-solid fa-arrow-trend-down"></i><span class="font-bold ml-2">+9</span>--}}
{{--                </div>--}}
            </div>
            <div class="bg-white p-5 flex flex-col justify-center gap-y-5 rounded-lg">
                <h2 class="text-gray-500">Meilleure vente</h2>
                <div class="flex flex-row items-end">
                    <h3 class="font-bold mr-2 text-2xl">
                        {{-- @if(isset($productMoreSold['product_name']))
                            {{ strlen($productMoreSold['product_name']) > 7 ? substr($productMoreSold['product_name'], 0, 7) . '...' : $productMoreSold['product_name'] }}
                        @else
                            Pas de produit
                        @endif --}}
                    </h3>

                    <span class="pb-0.5">Ce mois-ci</span>
                </div>
{{--                <div class="text-green-500">--}}
{{--                    <i class="fa-solid fa-arrow-trend-down"></i><span class="font-bold ml-2">Produit</span>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="mt-7 flex flex-col gap-y-3">
            <div class="flex flex-row items-center justify-between mb-7">
                <div class="flex flex-row items-center ">
                    <h2 class="text-2xl font-bold">Historique d’activité du site</h2>
                </div>
                <div class="flex flex-row items-center gap-x-3 mr-2">
                    <div class="bg-green-400 h-4 w-4 rounded-full"></div>
                    <span>Commande Passée</span>
                    <div class="bg-blue-400 h-4 w-4 rounded-full"></div>
                    <span>Article ajouté au panier</span>
                    <div class="bg-red-500 h-4 w-4 rounded-full"></div>
                    <span>Article supprimé du panier</span>
                    <div class="bg-purple-400 h-4 w-4 rounded-full"></div>
                    <span>Inscription</span>
                    <div class="bg-gray-200 h-4 w-4 rounded-full"></div>
                    <span>Autre</span>
                </div>
            </div>
            @foreach($activityLog as $log)
                {{-- <div class="{{ $log->getActivityColor() }} flex flex-row justify-center items-center rounded-lg">
                    <h3 class="py-5">
                        @if ($log->user)
                            {{ $log->user->firstname }} {{ $log->user->lastname }}
                        @endif
                        <span class="font-bold">{{ $log->activity_description }}</span>
                        <span>{{ $log->created_at->diffForHumans() }}</span>
                    </h3>
                </div> --}}
            @endforeach
        </div>
    </div>
</div>
