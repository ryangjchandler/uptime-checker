<x-filament::page>
    <x-tables::container>
        <div class="overflow-y-auto relative rounded-t-xl">
            <x-tables::table header="Results">
                <x-slot name="header">
                    <x-tables::header-cell
                        name="name"
                    >
                        Name
                    </x-tables::header-cell>
                    <x-tables::header-cell
                        name="result"
                    >
                        Result
                    </x-tables::header-cell>
                </x-slot>

                @foreach($record->result as $name => $result)
                    @php
                        $enum = \App\Enums\CheckResult::from($result);

                        $stateColor = match ($enum->color()) {
                            'danger' => 'text-danger-700 bg-danger-500/10',
                            'primary' => 'text-primary-700 bg-primary-500/10',
                            'success' => 'text-success-700 bg-success-500/10',
                            'warning' => 'text-warning-700 bg-warning-500/10',
                            default => 'text-gray-700 bg-gray-500/10',
                        };
                    @endphp

                    <x-tables::row wire:key="{{ $name }}_name">
                        <x-tables::cell
                            name="name"
                            :record="$record"
                            class="px-4 py-3"
                        >
                            {{ $name }}
                        </x-tables::cell>

                        <x-tables::cell
                            name="result"
                            :record="$record"
                            class="px-4 py-3"
                        >
                            <span @class([
                                'inline-flex items-center justify-center h-6 px-2 text-sm font-medium tracking-tight rounded-full',
                                $stateColor => $stateColor,
                            ])>
                                {{ $enum->name }}
                            </span>
                        </x-tables::cell>
                    </x-tables::row>
                @endforeach
            </x-tables::table>
        </div>
    </x-tables::container>
</x-filament::page>
