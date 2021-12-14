<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\IncomeListLayout;
use App\Models\Income;
use Orchid\Screen\Actions\Link;


class IncomeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Ingresos';
    public $description = 'Ingresos';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'incomes' => Income::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Añadir Ingreso')
                ->icon('pencil')
                ->route('platform.income.edit')

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            IncomeListLayout::class
        ];
    }
}
