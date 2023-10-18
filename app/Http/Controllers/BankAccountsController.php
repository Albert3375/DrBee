<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\BankAccount;
use Illuminate\Support\Facades\DB;

class BankAccountsController extends Controller
{
    public function index()
    {
        $bank_accounts = BankAccount::latest()->get();

        return view('admin.bank_accounts.index', compact('bank_accounts'));
    }

    public function create()
    {
        $method = 'CREATE';
        return view('admin.bank_accounts.create', compact('method'));
    }

    public function store(Request $request)
    {
        $bank_account = new BankAccount();
        $bank_account->name = $request->name;
        $bank_account->save();

        flash('Banco guardado correctamente.')->success()->important();

        return redirect()->back();
    }

    public function edit($id)
    {
        $bank_account = BankAccount::find($id);
        $method = 'EDIT';

        return view('admin.bank_accounts.edit', compact('method', 'bank_account'));
    }

    public function update(Request $request, $id)
    {
        $bank_account = BankAccount::find($id);

        $bank_account->name = $request->name;
        $bank_account->save();

        flash('Cuenta editada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function destroy($id)
    {
        BankAccount::destroy($id);

        DB::table('bank_references')->where('bank_id', $id)->delete();

        flash('Cuenta eliminada correctamente.')->success()->important();

        $bank_accounts = BankAccount::latest()->get();

        return view('admin.bank_accounts.index', compact('bank_accounts'));
    }
}
