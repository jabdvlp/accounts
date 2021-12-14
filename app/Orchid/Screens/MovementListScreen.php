<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\MovementListLayout;
use App\Models\Movement;
use Orchid\Screen\Actions\Link;

class MovementListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Movimientos';
    public $description = 'Todos los Movimientos';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'movements' => Movement::paginate()
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
            Link::make('Realizar Movimiento')
                ->icon('pencil')
                ->route('platform.movement.edit')

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
            MovementListLayout::class
        ];
    }
}
