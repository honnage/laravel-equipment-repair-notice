{{-- {{Auth::user()->firstname }} {{Auth::user()->lastname }} --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            สวัสดีคุณ, {{Auth::user()->firstname }} {{Auth::user()->lastname }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus officiis quos incidunt nam eum obcaecati sapiente, a accusamus esse neque, ullam impedit explicabo possimus inventore harum quasi suscipit aliquid quis?
                
            </div>
        </div>
    </div>
</x-app-layout>
