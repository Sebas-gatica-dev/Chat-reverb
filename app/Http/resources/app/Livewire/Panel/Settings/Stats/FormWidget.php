<?php

namespace App\Livewire\Panel\Settings\Stats;

use App\Enums\WidgetDatesEnum;
use App\Enums\WidgetLogicEnum;
use App\Enums\WidgetSizesEnum;
use App\Enums\WidgetTypesEnum;
use App\Models\Template;
use App\Models\Widget;
use Livewire\Attributes\On;
use Livewire\Component;

class FormWidget extends Component
{

    public $templateId;
    public $typesWidget;
    public $selectedTypeWidget;
    public $widgetType;
    public $widgetLogic;
    public bool $editWidget = false;
    public $widget;
    public $widgetColor;
    public $sizesWidget;
    public $selectedSizeWidget;
    public $logicsWidget;
    public $selectedLogicWidget;
    public $datesWidget;
    public $selectedDateWidget;
    public $description;



    public function mount()
    {
        $this->typesWidget = collect(WidgetTypesEnum::cases())->map(function ($typeEnum) {
            return [
                'id' => $typeEnum->value,
                'name' => $typeEnum->getName(),
            ];
        })->toArray();

        $this->sizesWidget = collect(WidgetSizesEnum::cases())->map(function ($sizeEnum) {
            return [
                'id' => $sizeEnum->value,
                'name' => $sizeEnum->getName(),
            ];
        })->toArray();

        $this->logicsWidget = collect(WidgetLogicEnum::cases())->map(function ($logicEnum) {
            return [
                'id' => $logicEnum->value,
                'name' => $logicEnum->getName(),
            ];
        })->toArray();

        $this->datesWidget = collect(WidgetDatesEnum::cases())->map(function ($dateEnum) {
            return [
                'id' => $dateEnum->value,
                'name' => $dateEnum->getName(),
            ];
        })->toArray();
    }


    #[On('update-selected-value-typesWidget')]
    public function updateSelectedTypeWidget($value)
    {
        $this->selectedTypeWidget = $value;
    }

    #[On('update-selected-value-sizesWidget')]

    public function updateSelectedSizeWidget($value)
    {
        $this->selectedSizeWidget = $value;
    }

    #[On('update-selected-value-logicsWidget')]
    public function updateSelectedLogicWidget($value)
    {
        $this->selectedLogicWidget = $value;
    }

    #[On('update-selected-value-datesWidget')]
    public function updateSelectedDateWidget($value)
    {
        $this->selectedDateWidget = $value;
    }


    #[On('fill-form-widget')]
    public function fillFormWidget($data)
    {


        $this->editWidget = true;
        $this->widget = $data['id'];
        $this->widgetColor = $data['color'];
        $this->description = $data['description'];
        $this->templateId = $data['template_id'];

        $this->dispatch('change-selected-value-typesWidget', $data['type']);
        $this->dispatch('change-selected-value-sizesWidget', $data['size']);
        $this->dispatch('change-selected-value-logicsWidget', $data['logic']);
        $this->dispatch('change-selected-value-datesWidget', $data['date']);
    }

    #[On('form-widget-closed')]
    public function close()
    {


        $this->widget = null;
        $this->editWidget = false;
        $this->widgetColor = null;
        $this->description = null;

        $this->dispatch('change-selected-value-typesWidget', null);
        $this->dispatch('change-selected-value-sizesWidget', null);
        $this->dispatch('change-selected-value-logicsWidget', null);
        $this->dispatch('change-selected-value-datesWidget', null);
    }


    public function save()
    {

        $this->validate([
            'selectedTypeWidget' => 'required',
            'selectedLogicWidget' => 'required',
            'selectedDateWidget' => 'required',
            'selectedSizeWidget' => 'required',
            'description' => 'required',
            'widgetColor' => 'required',
        ]);

        $templateCount = Widget::where('template_id', $this->templateId)->count();

        $widget = Widget::create([
            'template_id' => $this->templateId,
            'title' => WidgetLogicEnum::from($this->selectedLogicWidget)->getName(),
            'type' => $this->selectedTypeWidget,
            'logic' => $this->selectedLogicWidget,
            'date' => $this->selectedDateWidget,
            'color' => $this->widgetColor,
            'size' => $this->selectedSizeWidget,
            'date' => $this->selectedDateWidget,
            'description' => $this->description,
            'order' => $templateCount + 1,
        ]);

        $this->dispatch('refresh');


        $this->dispatch('form-widget');
        $this->dispatch('refresh-widgets');
        $this->dispatch('mount')->to(StatsEdit::class);
    }


    public function update()
    {


        $this->validate([
            'selectedTypeWidget' => 'required',
            'selectedLogicWidget' => 'required',
            'selectedDateWidget' => 'required',
            'selectedSizeWidget' => 'required',
            'description' => 'required',
            'widgetColor' => 'required',
        ]);

        $widget = Widget::where('id', $this->widget)->firstOrFail();


        $widget->update([
            'title' => WidgetLogicEnum::from($this->selectedLogicWidget)->getName(),
            'type' => $this->selectedTypeWidget,
            'logic' => $this->selectedLogicWidget,
            'date' => $this->selectedDateWidget,
            'color' => $this->widgetColor,
            'size' => $this->selectedSizeWidget,
            'date' => $this->selectedDateWidget,
            'description' => $this->description,
        ]);
        

        $this->dispatch('refresh');

        $this->dispatch('form-widget');
        $this->close();
    }




    public function render()
    {
        return view('livewire.panel.settings.stats.form-widget');
    }
}
