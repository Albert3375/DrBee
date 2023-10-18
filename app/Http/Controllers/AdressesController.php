<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Adress;
use Illuminate\Support\Facades\Auth;

class AdressesController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $adresses = Adress::where('users_id', $id)->get();
        $method = 'CREATE';

        return view('admin.adresses.index', compact('adresses', 'method'));
    }

    public function create()
    {
        $method = 'CREATE';
        return view('admin.adresses.create', compact('method'));
    }

    public function store(Request $request)
    {
        //Para verificar que el usuario solamente está cambiando su dirección de envio y "proteger" los otros datos.
        if ( !empty($request->address_id) ) {
            $msj = 'Los datos se actualizaron correctamente';
            $address = Adress::find( $request->address_id );
        } else {
            $msj = 'Los datos se guardaron correctamente';
            $address = new Adress();
        }

        /* El usuario esta logeado */
        $address->title = $request->title;
        $address->street = $request->street;
        $address->numberExt = $request->numberExt;
        $address->numInt = $request->numInt;
        $address->col = $request->col;
        $address->municipality = $request->municipality;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->postalCode = $request->postalCode;
        $address->users_id = Auth::user()->id;

        if ( $address->save() ) {
            return response()->json(['ok' => true, 'message' => $msj, 'address_id' => $address->id ]);
        } else {
            return response()->json(['ok' => false, 'message' => $msj ]);
        }

    }

    public function edit($id)
    {
        $method = 'EDIT';
        $adress = Adress::find($id);

        return view('admin.adresses.edit', compact('method', 'adress'));
    }

    public function update(Request $request, $id)
    {
        $adress = Adress::find($id);

        $adress->title = $request->title;
        $adress->street = $request->street;
        $adress->numberExt = $request->numberExt;
        $adress->numInt = $request->numInt;
        $adress->col = $request->col;
        $adress->municipality = $request->municipality;
        $adress->state = $request->state;
        $adress->country = $request->country;
        $adress->postalCode = $request->postalCode;

        $adress->save();

        flash(__('Dirección actualizada correctamente.'))->success()->important();
        return redirect()->route('admin.adresses.edit', $id);
    }

    public function destroy($id)
    {
        Adress::destroy($id);
        flash('La dirección fue eliminada correctamente.')->success()->important();

        $adresses = Adress::where('users_id', $id)->get();
        return view('admin.adresses.index', compact('adresses'));
    }
}
