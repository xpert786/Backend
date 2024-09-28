<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareDocument;
use App\Models\Document;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Notification;
use App\Notifications\ShareDocumentNotification;

class ShareDocumentController extends Controller
{
    public function shareDocuments(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        /*  $request->validate([
            'shared_from' => 'required|integer', // Assuming shared_from is the user ID
            'shared_to' => 'required|array', // Assuming shared_to is an array of user IDs
            'document_id' => 'required|array', // Assuming document_id is an array of document IDs
        ]); */

        // Get the shared_from user ID from the request
        $sharedFrom = $request->input('shared_from');

        // Get the shared_to user IDs from the request
        $sharedTo = $request->input('shared_to');

        // Get the document IDs from the request
        $documentIds = $request->input('document_id');

        // Loop through each document ID
        foreach ($documentIds as $documentId) {
            // Loop through each shared_to user ID
            foreach ($sharedTo as $sharedUserId) {
                // Save the shared document in the database
                ShareDocument::create([
                    'shared_from' => $sharedFrom,
                    'shared_to' => $sharedUserId,
                    'document_id' => $documentId,
                ]);

                // Retrieve the shared user's name
                $sharedUser = User::find($sharedUserId);
                $sharedUserName = $sharedUser->name;

                // Compose the notification data
                $documentData = [
                    'name' => $sharedUserName,
                    'body' => "Dear $sharedUserName, you have received shared documents.",
                    'thanks' => 'Thank you for your cooperation!',
                    'offer_id' => $documentId // Use document ID as offer ID or adjust as needed
                ];

                // Send the notification to the shared user
                $notification = new ShareDocumentNotification($documentData);
                $sharedUser->notify($notification);
            }
        }
        // Redirect back with success message
        return redirect()->back()->with('success', 'Documents shared successfully.');
    }

    public function mydocument()
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
        return view('my-document', ['documents' => $documents, 'folder' => $folder, 'sharedocument' => $sharedocument]);
    }

    public function shared(Request $request)
    {
        $user = Auth::user();
        if ($user->role == "customer") {
            $folder = ShareDocument::with('document')->where('shared_to', $user->id)->orderBy('created_at', 'desc')
                ->get();
        } else {
            $query = DB::table('share_documents')
                ->join('documents', 'share_documents.document_id', '=', 'documents.id')
                ->join('users', 'share_documents.shared_to', '=', 'users.id');
                
            if ($request->has('search')) {
                if(!empty($request->input('search'))){
                    $folder =   $query->where('users.name', 'like', '%' . $request->input('search') . '%')->get()->groupBy('name');
                }else{
                    $folder = $query->get()->groupBy('name');
                }    
                return response()->json(['folder' => $folder]);

            }
            $folder = DB::table('share_documents')
                ->join('documents', 'share_documents.document_id', '=', 'documents.id')
                ->join('users', 'share_documents.shared_to', '=', 'users.id')
                ->get()
                ->groupBy('name');
            // dd($folder);
        }

        return view('shared', ['folder' => $folder]);
    }

    

    public function sharedToAdmin(Request $request)
    {
        $data['user'] = User::where('role', 'customer')->orderBy('created_at', 'desc')->get();
        $user = Auth::user()->id;
        /* $documents = Document::where('customerId', $user)
            ->orderBy('created_at', 'desc')
            ->get(); */
        $documents = Document::where('customerId', $user)
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($documents);
        $folder = Folder::where('customerId', $user)->orderBy('created_at', 'desc')
            ->get();
        $folders = DB::table('documents')
            ->join('users', 'documents.customerId', '=', 'users.id')
            ->get()
            ->groupBy('name');
        $query = DB::table('documents')
            ->join('users', 'documents.customerId', '=', 'users.id');
            if ($request->has('search')) {
                if(!empty($request->input('search'))){
                    $folder =   $query->where('users.name', 'like', '%' . $request->input('search') . '%')->get()->groupBy('name');
                }else{
                    $folder = $query->get()->groupBy('name');
                }    
                return response()->json(['folder' => $folder]);
            }
        // dd($folders);
        return view('sharedToAdmin', compact('data', 'documents', 'folder', 'folders', 'user'));
    }
}
