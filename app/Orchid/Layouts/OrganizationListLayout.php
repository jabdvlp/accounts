<?php

namespace App\Orchid\Layouts;

use App\Models\Organization;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;



class OrganizationListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'organizations';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('name', 'Nombre')
                ->render(function (Organization $organization){
                    return Link::make($organization->name)
                        ->route('platform.organization.edit', $organization);

                }),
                
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last Edit'),

        ];
    }
}
