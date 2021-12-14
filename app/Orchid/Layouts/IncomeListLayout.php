<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Income;
use Orchid\Screen\Actions\Link;


class IncomeListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'incomes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('amount', 'Monto')
            ->render(function(Income $income){
                return Link::make($income->amount)
                    ->route('platform.income.edit',$income);
            }),

            TD::make('created_at', 'Creado'),

        ];
    }
}
