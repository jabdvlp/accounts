<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Concept;
use Orchid\Screen\Actions\Link;


class ConceptListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'concepts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('description', 'Descripción')
                ->render(function(Concept $concept){
                    return Link::make($concept->description)
                        ->route('platform.concept.edit',$concept);
                }),

            TD::make('created_at', 'Creado'),

        ];
    }
}
