<?php

namespace App\Http\Controllers;
/**
 * @SWG\Get(
 *   path="/sample",
 *   summary="Sample",
 *   @SWG\Response(response=200, description="successful operation")
 * )
 *
 * Display a listing of the resource.
 *
 * @return Response
 */
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContactsController extends Controller
{
    /**
     * @OA\Get(
     *    path = "/api/contacts",
     *    tags={"Contacts"},
     *    description="Get all contacts",
     *    @OA\Parameter(
     *       name="page",
     *       in="query",
     *       description="Page number",
     *       @OA\Schema(type="string")
     *    ),
     *    @OA\Response(
     *       response = 200,
     *       description = "Success",
     *       @OA\JsonContent(ref="#/components/schemas/Contacts")
     *    ),
     * ),
     *
     * @OA\Schema(
     *    schema="Contacts",
     *    type="object",
     *    @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ContactsResponse")),
     *    @OA\Property(property="pagination", type="object", ref="#/components/schemas/PaginationResponse"),
     * ),
     *
     * @OA\Schema(
     *    schema="ContactsResponse",
     *    type="object",
     *     allOf={
     *       @OA\Schema(type="object", ref="#/components/schemas/Contact"),
     *    },
     * ),
     *
     * @OA\Schema(
     *    schema="Contact",
     *    @OA\Property(property="id", type="integer"),
     *    @OA\Property(property="full_name", type="string"),
     *    @OA\Property(property="email", type="string"),
     *    @OA\Property(property="date_of_birth", type="string"),
     *    @OA\Property(property="company", type="string"),
     *    @OA\Property(property="phone", type="number"),
     *    @OA\Property(property="picture", type="string"),
     *    @OA\Property(property="created_at", type="string"),
     *    @OA\Property(property="updated_at", type="string"),
     * ),
     *
     * @OA\Schema(
     *    schema="ContactResponse",
     *    type="object",
     *     allOf={
     *       @OA\Schema(type="object", ref="#/components/schemas/Contact"),
     *    },
     * ),
     *
     * @return JsonResponse
     */
    public function index()
    {
        $contacts = Contact::paginate(10);

        return response()->json([
            'contacts' => $contacts,
        ]);
    }

    /**
     * * @OA\Post(
     *    path = "/api/contacts",
     *    tags={"Contacts"},
     *    description="Store contact",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Contact params",
     *         @OA\JsonContent(ref="#/components/schemas/CreateContactRequest")
     *     ),
     *    @OA\Response(
     *       response = 200,
     *       description = "Success",
     *       @OA\JsonContent(ref="#/components/schemas/ContactResponse")
     *    ),
     *    @OA\Response(
     *       response = 404,
     *       description = "Not found",
     *       @OA\JsonContent(ref="#/components/schemas/Error")
     *    ),
     * ),
     *
     * @OA\Schema(
     *    schema="CreateContactRequest",
     *    type="object",
     *    @OA\Property(property="full_name", type="string"),
     *    @OA\Property(property="email", type="string"),
     *    @OA\Property(property="date_of_birth", type="string"),
     *    @OA\Property(property="company", type="string"),
     *    @OA\Property(property="phone", type="number"),
     *    @OA\Property(property="picture", type="string"),
     * ),
     *
     * @param CreateContactRequest $request
     * @return JsonResponse
     */
    public function store(CreateContactRequest $request)
    {
        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $picturePath = $request->picture->storeAs('pictures', $imageName);
        }

        $contacts = Contact::create(array_merge($request->only([
            'full_name',
            'company',
            'phone',
            'email',
            'date_of_birth',
        ]), [
            'picture' => $picturePath ?? null,
        ]));

        return response()->json([
            'contacts' => $contacts,
        ]);
    }

    /**
     *@OA\Get(
     *    path = "/api/contacts/{id}",
     *    tags={"Contacts"},
     *    description="Show one contact",
     *       @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="Contact ID",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response = 200,
     *       description = "Success",
     *       @OA\JsonContent(ref="#/components/schemas/Contact")
     *    ),
     * ),
     *
     * @param Contact $contact
     * @return JsonResponse
     */
    public function show(Contact $contact)
    {
        return response()->json([
            'contact' => $contact,
        ]);
    }

    /**
     * @OA\Put (
     *    path = "/api/contacts/{id}",
     *    tags={"Contacts"},
     *    description="Update contact",
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="Contact ID",
     *       @OA\Schema(type="integer")
     *    ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Contact params",
     *         @OA\JsonContent(ref="#/components/schemas/UpdateContactRequest")
     *     ),
     *    @OA\Response(
     *       response = 200,
     *       description = "Success",
     *       @OA\JsonContent(ref="#/components/schemas/ContactResponse")
     *    ),
     *    @OA\Response(
     *       response = 404,
     *       description = "Not found",
     *       @OA\JsonContent(ref="#/components/schemas/Error")
     *    ),
     * ),
     *
     * @OA\Schema(
     *    schema="UpdateContactRequest",
     *    type="object",
     *    @OA\Property(property="full_name", type="string"),
     *    @OA\Property(property="email", type="string"),
     *    @OA\Property(property="date_of_birth", type="string"),
     *    @OA\Property(property="company", type="string"),
     *    @OA\Property(property="phone", type="number"),
     *    @OA\Property(property="picture", type="string"),
     * ),
     *
     * @param UpdateContactRequest $request
     * @param Contact $contact
     * @return JsonResponse
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $picturePath = $request->picture->storeAs('pictures', $imageName);
        }

        $contact->update(array_merge($request->only([
            'full_name',
            'company',
            'phone',
            'email',
            'date_of_birth',
        ]), [
            'picture' => $picturePath ?? null
        ]));

        return response()->json([
            'contact' => $contact,
        ]);
    }

    /**
     * @OA\Delete (
     *    path = "/api/contacts/{id}",
     *    tags={"Contacts"},
     *    description="Delete contact",
     *       @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="Contact ID",
     *       @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *       response = 200,
     *       description = "Success",
     *       @OA\JsonContent(ref="#/components/schemas/Contact")
     *    ),
     * ),
     *
     * @param Contact $contact
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->noContent();
    }
}
