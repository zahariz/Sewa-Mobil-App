<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalTransactionCreateRequest;
use App\Models\Car;
use App\Models\RentalTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RentalTransactionController extends Controller
{
    public function index(): View
    {
        $data = RentalTransaction::with(['user', 'mobil'])->get();
        // dd($data);
        return view("rental.index", [
            "rental" => $data
        ]);
    }

    public function create(): View
    {
        $cars = Car::all();
        return view("rental.create", [
            "cars" => $cars
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $cars = Car::where('id', $request['mobil_id'])->first();

        $rental = new RentalTransaction();
        $rental->mobil_id = $request['mobil_id'];
        $rental->tanggal_mulai = $request['tanggal_mulai'];
        $rental->tanggal_selesai = $request['tanggal_selesai'];
        $rental->user_id = Auth::user()->id;
        $rental->status = 'BORROWED';
        $rental->save();

        $cars->stock--;
        $cars->save();

        return Redirect::route('rental.cars.index')->with('status', 'Car berhasil disewa!');
    }
}
