<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\BankReference;
use Illuminate\Http\Request;


class BankReferenceController extends Controller
{
    public function index()
    {
        $references = BankReference::latest()->get();
        return view('admin.bank_references.index', compact('references'));
    }

    public function create()
    {
        $method = 'CREATE';
        $banks = BankAccount::all()->pluck('name', 'id')->toArray();

        return view('admin.bank_references.create', compact('method', 'banks'));
    }

    public function store(Request $request)
    {
        $reference = new BankReference();
        $reference->bank_id = $request->bank_id;
        $reference->holder = $request->holder;
        $reference->type = $request->type;
        $reference->references = $request->references;
        $reference->save();

        flash('Referencia guardada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function edit($id)
    {
        $reference = BankReference::where('id', $id)->get()->first();
        $banks = BankAccount::all()->pluck('name', 'id')->toArray();
        $method = 'EDIT';

        return view('admin.bank_references.edit', compact('method', 'reference', 'banks'));
    }

    public function update(Request $request, $id)
    {
        $reference = BankReference::where('id', $id)->get()->first();

        $reference->bank_id = $request->bank_id;
        $reference->holder = $request->holder;
        $reference->type = $request->type;
        $reference->references = $request->references;
        $reference->save();

        flash('Referencia editada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function destroy($id)
    {
        BankReference::destroy($id);

        flash('Referencia eliminada correctamente.')->success()->important();

        $references = BankReference::latest()->get();

        return view('admin.bank_references.index', compact('references'));
    }
}
