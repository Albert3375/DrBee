<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\FileControl\FileControl;
use App\Models\Conciliation;
use Illuminate\Support\Facades\DB;

class ConciliationsController extends Controller
{
    public function index()
    {
        return view('admin.conciliations.index');
    }

    public function create()
    {
        $method = 'CREATE';
        return view('admin.conciliations.create', compact('method'));
    }

    public function store(Request $request)
    {
        $conciliation = new Conciliation();

        $fileName = FileControl::storeSingleFile($request->payment_evidence, 'paymentEvidences');
        $request->payment_evidence = "{$fileName}";

        $conciliation->order_id = $request->order_id;
        $conciliation->client = $request->client;
        $conciliation->total = $request->total;
        $conciliation->payment_evidence = $request->payment_evidence;
        $conciliation->status = $request->status;
        $conciliation->save();

        flash('Conciliación guardada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function download($id)
    {
        $conciliation = Conciliation::findOrFail($id);
        return Storage::disk('paymentEvidences')->download($conciliation->payment_evidence);
    }

    public function edit($id)
    {
        $method = 'EDIT';
        $conciliation = Conciliation::find($id);

        return view('admin.conciliations.edit', compact('method', 'conciliation'));
    }

    public function update(Request $request, $id)
    {
        $conciliation = Conciliation::findOrFail($id);

        if ($request->hasFile('payment_evidence')) {
            $fileName = FileControl::storeSingleFile($request->payment_evidence, 'paymentEvidences');
            $conciliation->payment_evidence = "{$fileName}";
        }

        $conciliation->order_id = $request->order_id;
        $conciliation->total = $request->total;
        $conciliation->save();

        flash('Conciliación editada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Conciliation::destroy($id);
        flash('La conciliación fue eliminada correctamente.')->success()->important();

        $conciliations = DB::table('conciliations')->get();
        return view('admin.conciliations.index', compact('conciliations'));
    }

    public function json(Request $request)
    {
        $query = Conciliation::query();

        $query->when(
            $request->has('search') && !empty($request->search['value']),
            function ($query) use ($request) {
                $query->whereRaw(
                    "
                    conciliaciones.cliente LIKE '%" . $request->search['value'] . "%'

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
