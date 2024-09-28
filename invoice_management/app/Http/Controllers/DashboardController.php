<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $invoice['Paid'] = Invoice::where('customerId', $user)->where('status', 'Paid')->count();
        $invoice['Unpaid'] = Invoice::where('customerId', $user)->where('status', 'Unpaid')->count();
        $invoice['Sent'] = Invoice::where('customerId', $user)->where('status', 'Sent')->count();
        $invoice['Cancel'] = Invoice::where('customerId', $user)->where('status', 'Cancel')->count();
        $invoice['Recurring'] = Invoice::where('customerId', $user)->whereNotNull('recurring_invoice')->count();
        $invoice['users'] = User::where('role', 'customer')->count();
        $invoice['total_invoice'] = Invoice::count();
        return view('dashboard', compact('invoice'));
    }

    public function invoice_paid()
    {
        $user = Auth::user()->id;
        // $perPage = 10;
        $data['invoice'] = Invoice::where('customerId', $user)->where('status', 'Paid')->get();
        return view('invoice', compact('data'));
    }

    public function invoice_unpaid()
    {
        $user = Auth::user()->id;
        // $perPage = 10;
        $data['invoice'] = Invoice::where('customerId', $user)->where('status', 'Unpaid')->get();
        return view('invoice', compact('data'));
    }

    public function invoice_sent()
    {
        $user = Auth::user()->id;
        // $perPage = 10;
        $data['invoice'] = Invoice::where('customerId', $user)->where('status', 'Sent')->get();
        return view('invoice', compact('data'));
    }

    public function invoice_cancel()
    {
        $user = Auth::user()->id;
        // $perPage = 10;
        $data['invoice'] = Invoice::where('customerId', $user)->where('status', 'Cancel')->get();
        return view('invoice', compact('data'));
    }

    public function invoice_recurring()
    {
        $user = Auth::user()->id;
        // $perPage = 10;
        $data['invoice'] = Invoice::where('customerId', $user)->whereNotNull('recurring_invoice')->get();
        return view('invoice', compact('data'));
    }
}
