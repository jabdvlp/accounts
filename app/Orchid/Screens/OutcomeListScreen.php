<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\OutcomeListLayout;
use App\Models\Outcome;
use Orchid\Screen\Actions\Link;


class OutcomeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Egresos';
    public $description = 'Egresos';


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'outcomes' => Outcome::paginate()

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
            Link::make('Añadir Egreso')
                ->icon('pencil')
                ->route('platform.outcome.edit')
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
            OutcomeListLayout::class
        ];
    }
}
