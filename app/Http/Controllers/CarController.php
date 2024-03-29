<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarCreateRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(Request $request): View
    {
        // Ambil semua data mobil
    $query = Car::query();

    // Cek apakah ada parameter pencarian yang diteruskan melalui URL
    if ($request->has('search')) {
        // Dapatkan nilai pencarian dari parameter 'search'
        $searchTerm = $request->input('search');

        // Filter mobil berdasarkan kriteria pencarian
        $query->where('merek', 'like', '%' . $searchTerm . '%')
              ->orWhere('model', 'like', '%' . $searchTerm . '%')
              ->orWhere('nomor_plat', 'like', '%' . $searchTerm . '%');
    }

    // Ambil data mobil setelah diterapkan pencarian (jika ada)
    $cars = $query->get();

    // Kirim data mobil ke tampilan Blade
    return view('cars.index', compact('cars'));
    }

    public function create(): View
    {
        return view('cars.create');
    }

    public function store(CarCreateRequest $request)
    {
        $data = $request->validated();

        $cars = new Car($data);
        $cars->save();

        return Redirect::route('cars.index')->with('status', 'Cars succesfully created!');
    }

    public function getCar(int $idCar): Car | RedirectResponse
    {
        $data = Car::where('id', $idCar)->first();

        if(!$data)
        {
            return Redirect::route('cars.index')->with('status', 'Cars Not Found');
        }

        return $data;
    }

    public function edit(int $idCar): View | RedirectResponse
    {
        $data = $this->getCar($idCar);

        return view("cars.edit", [
            'cars' => $data
        ]);
    }

    public function update(int $idCar, CarUpdateRequest $request): RedirectResponse
    {
        $cars = $this->getCar($idCar);

        $data = $request->validated();

        $cars->fill($data);
        $cars->save();

        return Redirect::route('cars.index')->with('status', 'Cars succesfully updated!');

    }

    public function destroy(int $idCar): RedirectResponse
    {
        $cars = $this->getCar($idCar);

        $cars->delete();

        return Redirect::route('cars.index')->with('status', 'Cars succesfully deleted!');
    }
}
