<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{
    public function index()
    {
        return view('admin.deliveries.index');
    }

    public function json(Request $request)
    {
        $query = Delivery::query();

        $query->when(
            $request->has('search') && !empty($request->search['value']),
            function ($query) use ($request) {
                $query->whereRaw(
                    "
                        pedidos.nombreContacto LIKE '%" . $request->search['value'] . "%'
                        OR pedidos.tipoPago LIKE '%" . $request->search['value'] . "%'
                    "
                );
            }
        );

        $query->when(
            $request->has('estatus') && !empty($request->estatus),
            function ($query) use ($request) {
                $query->where('estatus', $request->estatus);
            }
        );

        $count = $query->get()->count();

        $query->when(
            $request->has('order') && $request->has('columns'),
            function ($query) use ($request) {
                $columnName = $request->columns[$request->order[0]['column']]['name'];
                $columnDir = $request->order[0]['dir'];
                $query->orderBy($columnName, $columnDir);
            }
        );

        $query->when(
            $request->has('length') && $request->length != '-1',
            function ($query) use ($request) {
                $limit = $request->length;
                $offset = $request->start;

                $query->limit($limit)->offset($offset);
            }
        );

        return response()->json(
            [
                'draw' => $request->has('draw') ? $request->draw : 1,
                'recordsTotal' => $count,
                'recordsFiltered' => $count,
                'data' => $query->get()
            ]
        );
    }
}
