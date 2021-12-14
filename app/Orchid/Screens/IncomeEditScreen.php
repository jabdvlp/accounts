<?php

namespace App\Orchid\Screens;

use App\Models\Income;
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
use App\Orchid\Layouts\IncomeListLayout;

class IncomeEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Agregar Ingresos';
    public $description = 'Ingreso';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Income $income): array
    {
        $this->exists = $income->exists;

        if($this->exists){
            $this->name = 'Editar Ingreso'; 
        }
        return [
            'income' => $income
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
            Button::make('Crear Ingreso')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            
            Button::make('Editar Ingreso')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),
            
            Button::make('Eliminar Ingreso')
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
                Input::make('income.amount')
                    ->title('Ingreso'),
            ])
        ];
    }

    public function createOrUpdate(Income $income, Request $request){

        $income->fill($request->get('income'))->save();

        Alert::info('El ingreso se ha creado de forma exitosa');

        return redirect()->route('platform.income.list');
    }
    
    public function remove(Income $income){
        $income->delete();

        Alert::info('El ingreso ha sido eliminado');

        return redirect()->route('platform.income.list');
    }    
}
