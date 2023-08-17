<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Receipt: ') . $receipt->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <h2 class="text-4xl my-2">{{ __('Ingredients:') }}</h2>
                        <ul class="list-disc">
                            @foreach($ingredients as $ingredient)
                                <li>{{ sprintf(__("%s (%s Units)"), $ingredient['name'], $ingredient['quantity']) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
