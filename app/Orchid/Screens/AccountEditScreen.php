<?php

namespace App\Orchid\Screens;

use App\Models\Account;
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
use App\Orchid\Layouts\AccountListLayout;


class AccountEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creando una nueva cuenta';
    public $description = 'Cuentas';
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Account $account): array
    {
        $this->exists = $account->exists;

        if($this->exists){
            $this->name = 'Editar Cuenta';
        }

        return [
            'account' => $account
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
            Button::make('Crear Cuenta')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Editar Cuenta')
                ->icon('note')
                ->method('createOrUpadate')
                ->canSee($this->exists),

            Button::make('Eliminar Cuenta')
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
                Input::make('account.name')
                    ->title('Nombre de la Cuenta')
                    ->placeholder('Ingrese el nombre de la cuenta ')
                    ->help('Especifique un nombre para la cuenta'),

                Input::make('account.slug')
                    ->title('Slug')
                    ->placeholder('Ingrese el slug de la cuenta ')
                    ->help('Especifique un slug para la cuenta'),
                                
            ])
        ];
    }

    public function createOrUpdate(Account $account, Request $request){

        $account->fill($request->get('account'))->save();

        Alert::info('La cuenta se ha creado satisfactoriamente');

        return redirect()->route('platform.account.list');
    }

    public function remove(Account $account){

        $account->delete();

        Alert::info('La cuenta se ha eliminado satisfactoriamente');

        return redirect()->route('platform.account.list');
    }
}
