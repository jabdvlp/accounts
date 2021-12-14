<?php

namespace App\Orchid\Screens;

use App\Models\Concept;
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
use App\Orchid\Layouts\ConceptListLayout;

class ConceptEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Agregar Concepto';
    public $description = 'Concepto';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Concept $concept): array
    {
        $this->exists = $concept->exists;

        if($this->exists){
            $this->name = 'Editar Concepto';
        }
        return [
            'comcept' => $concept
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
            Button::make('Crear Concepto')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            
            Button::make('Editar Concepto')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
            
            Button::make('Eliminar Concepto')
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
                Input::make('concept.description')
                    ->title('Concepto')
                    ->placeholder('Agregue un concepto')
                    ->help('Especifique un concepto para la operación'),
            ])
        ];
    }

    public function createOrUpdate(Concept $concept, Request $request){

        $concept->fill($request->get('concept'))->save();

        Alert::info('El concepto se ha creado de forma exitosa');

        return redirect()->route('platform.concept.list');

    }
    
    public function remove(Concept $concept){

        $concept->delete();

        Alert::info('El concepto ha sido eliminado');

        return redirect()->route('platform.concept.list');
    }    
}