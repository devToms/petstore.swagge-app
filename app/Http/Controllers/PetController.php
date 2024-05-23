<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\PetService;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index(Request $request)
    {
        try {
            $status = $request->query('status', 'available');
            $pets = $this->petService->findByStatus($status);

            return view('pets.index', compact('pets'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required|string|in:available,pending,sold',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            $this->petService->createPet($request->all());
            return redirect()->route('pets.index')->with('success', 'Pet created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pet = $this->petService->getPetById($id);

            return view('pets.edit', compact('pet'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required|string|in:available,pending,sold',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            $data = $request->only(['name', 'status']);
            $data = array_merge(['id' => $id], $data);

            $this->petService->updatePet($data);

            return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->petService->deletePet($id);
            return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
