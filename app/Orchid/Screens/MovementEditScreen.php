<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Movement;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use App\Orchid\Layouts\MovementListLayout;

class MovementEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Realizar Movimiento';
    public $description = 'Movimientos Realizados';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Movement $movement): array
    {
        $this->exists = $movement->exists;

        if($this->exists){
            $this->name = 'Editar Movimiento';
        }
        return [
            'movement' => $movement
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
            Button::make('Realizar Movimiento')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
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
            Layout::rows([
                Input::make('movement.amount')
                    ->title('Monto')
                    ->placeholder('Ingrese un monto')
                    ->help('Especifique el monto a transferir'),

                Input::make('movement.status')
                    ->title('Estado')
                    ->placeholder('')
                    ->help(''),
                

            ])
        ];
    }

    public function createOrUpdate(Movement $movement, Request $request)
    {
        $movement->fill($request->get('movement'))->save();

        Alert::info('El movimiento se ha realizado satisfactoriamente');

        return redirect()->route('platform.movement.list');
    }

    public function remove(Movement $movement)
    {
        $movement->delete();

        Alert::info('El movimiento se ha eliminado satisfactoriamente');

        return redirect()->route('platform.movement.list');
    }
}
