<?php

namespace App\Orchid\Screens;

use App\Models\Outcome;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use App\Orchid\Layouts\OutcomeListLayout;

class OutcomeEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Agregar Egresos';
    public $description = 'Ingreso';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Outcome $outcome): array
    {
        $this->exists = $outcome->exists;

        if($this->exists){
            $this->name = 'Editar Egreso'; 
        }

        return [
            'outcome' => $outcome
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
            Button::make('Crear Egreso')
            ->icon('pencil')
            ->method('createOrUpdate')
            ->canSee(!$this->exists),
        
        Button::make('Editar Egreso')
            ->icon('note')
            ->method('createOrUpdate')
            ->canSee($this->exists),
        
        Button::make('Eliminar Egreso')
            ->icon('trash')
            ->method('remove')
            ->canSee($this->exists),
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
                Input::make('outcome.amount')
                    ->title('Egreso'),
            ])
        ];
    }

    public function createOrUpdate(Outcome $outcome, Request $request){

        $outcome->fill($request->get('outcome'))->save();

        Alert::info('El egreso se ha creado de forma exitosa');

        return redirect()->route('platform.outcome.list');
    }
    
    public function remove(Income $outcome){
        $outcome->delete();

        Alert::info('El egreso ha sido eliminado');

        return redirect()->route('platform.outcome.list');
    }    
}
