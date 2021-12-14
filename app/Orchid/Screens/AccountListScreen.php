<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\AccountListLayout;
use App\Models\Account;
use Orchid\Screen\Actions\Link;

class AccountListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Cuentas';
    public $description = 'Todas las Cuentas';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'accounts' => Account::paginate()
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
            Link::make('Crear nueva Cuenta')
                ->icon('pencil')
                ->route('platform.account.edit')
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
            AccountListLayout::class
        ];
    }
}
