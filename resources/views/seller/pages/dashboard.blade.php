<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:gap-2">
        <x-filament-widgets::widgets
            :columns="$this->getColumns()"
            :data="
            [
                ...(property_exists($this, 'filters') ? ['filters' => $this->filters] : []),
                ...$this->getWidgetData(),
            ]
        "
            :widgets="$this->getVisibleWidgets()"
        />
    </div>
</x-filament-panels::page>
