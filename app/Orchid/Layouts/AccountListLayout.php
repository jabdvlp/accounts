<?php

namespace App\Orchid\Layouts;

use App\Models\Account;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class AccountListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'accounts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Nombre de Cuenta')
                ->render(function (Account $account){
                    return Link::make($account->name)
                        ->route('platform.account.edit', $account);
                }),

            TD::make('created_at', 'Creado'),
            TD::make('updated_at', 'Actualizado'),
        ];
    }
}
