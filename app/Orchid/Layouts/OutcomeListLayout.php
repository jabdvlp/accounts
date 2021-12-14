<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Outcome;
use Orchid\Screen\Actions\Link;

class OutcomeListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'outcomes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('amount', 'Monto')
            ->render(function(Outcome $outcome){
                return Link::make($outcome->amount)
                    ->route('platform.outcome.edit',$outcome);
            }),

            TD::make('created_at', 'Creado'),

        ];
    }
}
