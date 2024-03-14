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
    public function index(Request $request): View
    {
        $query = RentalTransaction::with(['user', 'mobil']);

        // Cek apakah ada parameter pencarian yang diteruskan melalui URL
        if ($request->has('search')) {
            // Dapatkan nilai pencarian dari parameter 'search'
            $searchTerm = $request->input('search');

            // Filter berdasarkan kriteria pencarian
            $query->whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })->orWhereHas('mobil', function ($query) use ($searchTerm) {
                $query->where('merek', 'like', '%' . $searchTerm . '%')
                    ->orWhere('model', 'like', '%' . $searchTerm . '%')
                    ->orWhere('nomor_plat', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil data rental transactions setelah diterapkan pencarian (jika ada)
        $rental = $query->get();

        // Kirim data rental transactions ke tampilan Blade
        return view('rental.index', compact('rental'));
    }

    public function create(): View
    {
        $cars = Car::where('stock', '>=', 1)->get();
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

    public function return()
    {
        $transaction = RentalTransaction::with(['mobil', 'user'])->where('status', 'BORROWED')->get();
        return view("rental.return", [
            "transaction" => $transaction
        ]);
    }

    public function returnCar(Request $request)
    {
        // Validasi input
        // dd($request->all());
        $request->validate([
            'nomor_plat' => 'required|string'
        ]);

        // Ambil data transaksi berdasarkan nomor plat mobil
        $transaction = RentalTransaction::where('id', $request->nomor_plat)->first();

        $transaction->update([
            'status' => 'RETURNED'
        ]);

        $transaction->mobil->increment('stock');


        return Redirect::route("rental.cars.index")->with('status', 'Mobil berhasil dikembalikan');
    }
}
