<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Organization;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\PostListLayout;
use App\Orchid\Layouts\OrganizationListLayout;


class OrganizationListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Organizaciones';
    public $description = 'Todas las Organizaciones';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'organizations' => Organization::paginate()
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
            Link::make('Crear Nueva')
                ->icon('pencil')
                ->route('platform.organization.edit')
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
            OrganizationListLayout::class
        ];
    }
}
