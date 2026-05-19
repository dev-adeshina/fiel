<x-filament-panels::page>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @foreach ($this->getOrders() as $order)

            <div class="rounded-2xl border bg-white dark:bg-gray-900 p-6 shadow">

                <div class="flex items-center justify-between">

                    <h2 class="text-xl font-bold">
                        #{{ $order->id }}
                    </h2>

                    <span class="text-sm font-medium">
                        {{ $order->status->value }}
                    </span>
                </div>

                <div class="mt-4 space-y-2">

                    @foreach ($order->items as $item)

                        <div class="flex justify-between">

                            <span>
                                {{ $item->quantity }}x
                                {{ $item->menuItem->name }}
                            </span>

                            <span>
                                ₦{{ number_format($item->total, 2) }}
                            </span>
                        </div>

                    @endforeach

                </div>

                <div class="mt-6 flex gap-2">

                    @if ($order->status->value === 'confirmed')

                        <x-filament::button
                            color="warning"
                            wire:click="startPreparing({{ $order->id }})"
                        >
                            Start Preparing
                        </x-filament::button>

                    @endif

                    @if ($order->status->value === 'preparing')

                        <x-filament::button
                            color="success"
                            wire:click="markReady({{ $order->id }})"
                        >
                            Mark Ready
                        </x-filament::button>

                    @endif

                </div>

            </div>

        @endforeach

    </div>

</x-filament-panels::page>