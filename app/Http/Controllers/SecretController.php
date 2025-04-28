<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSecretRequest;
use App\Http\Requests\UpdateSecretRequest;
use App\Models\Secret;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class SecretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Secrets/Index', [
            'secrets' => Secret::orderBy('updated_at', 'desc')->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Secrets/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSecretRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $secret = Secret::create($data);

        return redirect()->route('secrets.show', $secret->id)->banner('Secret "' . $secret->title . '" created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Secret $secret)
    {
        return Inertia::render('Secrets/Show', [
            'secret' => $secret,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Secret $secret)
    {
        return Inertia::render('Secrets/Edit', [
            'secret' => $secret,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSecretRequest $request, Secret $secret)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($secret->update($data)) {
            return redirect()->route('secrets.show', $secret->id)->banner('Secret "' . $secret->title . '" updated successfully.');
        }
        return redirect()->route('secrets.show', $secret->id)->dangerBanner('Failed to update secret. Please try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secret $secret): Response|RedirectResponse
    {
        $msg = 'Secret "' . $secret->title . '" deleted successfully.';
        if ($secret->delete()) {
            return redirect()->route('secrets.index')->banner($msg);
        }
        return redirect()->route('secrets.index')->dangerBanner('Failed to delete secret. Please try again.');
    }
}
