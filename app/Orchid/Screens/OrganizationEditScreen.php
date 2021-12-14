<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Orchid\Screen\Screen;
use App\Models\Organization;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use App\Orchid\Layouts\OrganizationListLayout;


class OrganizationEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Añadir una Organización';
    public $description = 'Organización';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Organization $organization): array
    {
        $this->exists = $organization->exists;

        if($this->exists){
            $this->name = 'Editar Organización';
        }


        return [
            'organization' => $organization
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
            Button::make('Añadir Organización')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Actualizar Datos')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Eliminar Organización')
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
                Input::make('organization.name')
                    ->title('Nombre')
                    ->placeholder('Ingrese el nombre de la Organización')
                    ->help('Especifique un nombre de organización'),
                
/*                 Input::make('organization.organization_id')
                    ->title('ID'),
 */            ])
        ];
    }

    public function createOrUpdate(Organization $organization, Request $request){


        $organization->fill($request->get('organization'))->save();

        Alert::info('La organización se ha creado satisfactoriamente.');

        return redirect()->route('platform.organization.list');
        
    }

    public function remove(Organization $organization){
        
        $organization->delete();

        Alert::info('La organización se ha eliminado correctamente.');

        return redirect()->route('platform.organization.list');

    }
}
