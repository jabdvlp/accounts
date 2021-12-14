<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\ConceptListLayout;
use App\Models\Concept;
use Orchid\Screen\Actions\Link;


class ConceptListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Conceptos';
    public $description = 'Conceptos';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'concepts' => Concept::paginate() 
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
            Link::make('Añadir Concepto')
                ->icon('pencil')
                ->route('platform.concept.edit')
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
            ConceptListLayout::class
        ];
    }
}
