<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use App\Models\Movement;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class MovementListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'movements';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('amount', 'Monto')
                ->render(function(Movement $movement){
                    return Link::make($movement->amount)
                        ->route('platform.movement.edit', $movement);

                }),
            
            TD::make('created_at', 'Creado'),
            // TD::make('updated_at', ''),
        ];
    }
}
