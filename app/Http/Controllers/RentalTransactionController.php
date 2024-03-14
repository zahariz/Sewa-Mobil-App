<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalTransactionCreateRequest;
use App\Models\Car;
use App\Models\RentalTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RentalTransactionController extends Controller
{
    public function index(): View
    {
        $data = RentalTransaction::with(['user', 'mobil'])->get();
        return view("rental.index", [
            "rental" => $data
        ]);
    }

    public function create(): View
    {
        return view("rental.create");
    }

    public function store(RentalTransactionCreateRequest $request)
    {
        $data = $request->validated();

        $cars = Car::where('id', $data['mobil_id'])->first();

        $rental = new RentalTransaction($data);
        $rental->mobil_id = $data['mobil_id'];
        $rental->status = 'BORROWED';
        $rental->save();

        $cars->stock--;
        $cars->save();

        return Redirect::route('rental.cars.index')->with('status', 'Car berhasil disewa!');
    }
}
