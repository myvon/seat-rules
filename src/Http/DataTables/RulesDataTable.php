<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015 to 2020 Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Lvlo\Rules\Http\DataTables;

use Lvlo\Rules\Models\Rules;
use Seat\Eveapi\Models\Character\CharacterInfo;
use Yajra\DataTables\DataTables;

/**
 * Class CharacterDataTable.
 *
 * @package Seat\Web\Http\DataTables\Character
 */
class RulesDataTable extends DataTables
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function ajax()
    {
        return datatables()
            ->eloquent($this->applyScopes($this->query()))
            ->editColumn('object_id', function ($row) {
                if($row->object_type === "alliance") {
                    return view('web::partials.alliance', ['alliance' => $row->getObject()])->render();
                } else {
                    return view('web::partials.corporation', ['corporation' => $row->getObject()])->render();
                }
            })
            ->editColumn('language', function ($row) {

                $languages = config('web.locale.languages');

                foreach($languages as $language) {
                    if($language['short'] === $row->language) {
                        return $language['full'];
                    }
                }
            })
            ->editColumn('action', function ($row) {
                return view('rules::partials.action', ['rule' => $row])->render();
            })
            ->rawColumns([
                'object_id', 'language', 'action',
            ])
            ->make(true);
    }

    /**
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->postAjax()
            ->columns($this->getColumns())
            ->orderBy(0, 'asc')
            ->parameters([
                'drawCallback' => 'function() { }',
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query($builder)
    {
        return Rules::with([] )->select('*');
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return [
            ['data' => 'object_id', 'title' => trans('rules::seat.corp_or_alli')],
            ['data' => 'language', 'title' => trans('rules::seat.language')],
            ['data' => 'action', 'title' => trans('web::seat.action')],
        ];
    }
}
