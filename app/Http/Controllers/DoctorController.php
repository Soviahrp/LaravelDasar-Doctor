<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Services\DoctorService;


class DoctorController extends Controller
{

    public function __construct(private DoctorService $doctorService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $data = $this->doctorService->getWithPaginate(5, $search);

        return view('doctor.index', [
            'doctors' => $data
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'gender']);

        try {
            $this->doctorService->create($data);

            return redirect('/doctor')->with('success', 'Data berhasil ditambah');
        } catch (\Exception $error) {
            return redirect('/doctor/create')->with('error', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->doctorService->getById($id);
        return view('doctor.show', [
            'doctor' => $data
        ]);
    }

    // ini untuk menampilkan eror selain menggunakan firstOrfail() bisa menggunakan
    // if (!$data){
    //     abort(404);
    // }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('doctor.edit', [
            'doctor' => $this->doctorService->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dataByForm = $request->only(['name', 'email', 'phone', 'gender']);
            $this->doctorService->update($dataByForm, $id);

            return redirect('/doctor')->with('success', 'Data berhasil diubah');
        } catch (\Exception $error) {
            return redirect('/doctor/' . $id . '/edit')->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->doctorService->delete($id);
            return redirect('/doctor')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $error) {
            return redirect('/doctor/')->with('error', $error->getMessage());
        }
    }
}
