<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::all();
        return ContactResource::collection($contact);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactStoreRequest $request)
    {
        $contactModel = new Contact();

        try {
            $contactModel->fill($request->all())
                ->save();
        } catch (\Exception $exception) {
            return response()->json(
                'Ocorreu um erro ao salvar',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return new ContactResource($contactModel);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $contact = Contact::findOrFail($id);

        $contact->update($data);
        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();
        return response()->json(['Removido com sucesso'], Response::HTTP_NO_CONTENT);
    }
}
