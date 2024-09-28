<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\ShareDocument;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\DocumentNotification;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        // dd($user);
        $documents = Document::where('customerId', $user)
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($documents);
        $folder = Folder::where('customerId', $user)->orderBy('created_at', 'desc')
            ->get();
        $sharedocument = ShareDocument::where('shared_to', Auth::user()->id)->get();
        return view('document', ['documents' => $documents, 'folder' => $folder, 'sharedocument' => $sharedocument]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'documents.*' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx|max:2048',
            'folder_name' => 'required|string|max:255',
            'customerId' => 'required', // Add validation rules for customerId
        ]);

        $customerId = $request->input('customerId');
        $folderName = $request->input('folder_name');

        // Create or retrieve the folder record
        $folder = Folder::firstOrCreate(['folder_name' => $folderName, 'customerId' => $customerId,]);

        foreach ($request->file('documents') as $file) {
            if ($file->isValid()) {
                // Get the original file name
                $originalFileName = $file->getClientOriginalName();

                // Generate a unique file name
                $fileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Store the file in the public/documents folder
                $documentPath = $file->storeAs('public/documents', $fileName);

                // Create a new Document record
                Document::create([
                    'customerId' => $customerId,
                    'folder_id' => $folder->id,
                    'documents' => $fileName,
                ]);
                $user = User::where("role", "admin")->first();
                // $userId = $user->id;
                $customerName = Auth::user()->name;
                $documentData = [
                    'name' => "$customerName",
                    'body' => "Dear $customerName, has uploaded new documents.",
                    'thanks' => 'Thank you for your cooperation!',
                    'offer_id' => $customerId
                ];

                // Send the notification
                $notification = new DocumentNotification($documentData);
                $user->notify($notification);
            } else {
                // Handle the case when a file upload fails
                return redirect()->back()->withErrors(['documents' => 'Failed to upload one or more documents.']);
            }
        }

        return redirect()->route('my-document')->with('success', 'Documents added successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function create_folder(Request $request)
    {
        $customerId = $request->input('customerId');
        $folderName = $request->input('custom_folder_name');

        // Create or retrieve the folder record
        Folder::firstOrCreate(['folder_name' => $folderName, 'customerId' => $customerId,]);
        return redirect()->route('document')->with('success', 'Folder created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);
        $folder_id = $request->folder_id;
        // Find the folder by ID
        $folder = Folder::where('id', $folder_id)
            ->where('customerId', Auth::user()->id)
            ->firstOrFail();
        $folder->folder_name = $request->input('folder_name');
        $folder->save();

        // Return a response indicating success
        return response()->json(['message' => 'Folder name updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function viewdocument($id)
    {
        $user = $id;
        /* $documents = Document::where('customerId', $user)
            ->orderBy('created_at', 'desc')
            ->get(); */
            $documents = Document::where('customerId', $user)
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($documents);
        $folder = Folder::where('customerId', $user)->orderBy('created_at', 'desc')
            ->get();

        return view('viewdocuments', ['documents' => $documents, 'folder' => $folder, 'user' => $user]);
    }

    public function viewFolderDoc($user_id, $folder_id)
    {
        $user = Auth::user()->id;
        $documents = Document::where('customerId', $user_id)
            ->where('folder_id', $folder_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $folder_name = Folder::where('customerId', $user_id)
            ->where('id', $folder_id)
            ->pluck('folder_name')
            ->first();
        $users = User::where('role', 'customer')->get();
        return view('view-folder-documents', ['documents' => $documents, 'folder_name' => $folder_name, 'users' => $users]);
    }

    
    public function customerdocuments($user_id, $folder_id)
    {
        $user = Auth::user()->id;
        $documents = Document::where('customerId', $user_id)
            ->where('folder_id', $folder_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $folder_name = Folder::where('customerId', $user_id)
            ->where('id', $folder_id)
            ->pluck('folder_name')
            ->first();
        $users = User::where('role', 'customer')->get();
        return view('documentsInCustomer', ['documents' => $documents, 'folder_name' => $folder_name, 'users' => $users]);
    }
}
