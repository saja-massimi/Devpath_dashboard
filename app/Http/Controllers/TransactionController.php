<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Courses;
use Illuminate\Support\Facades\DB;
use Laracsv\Export;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $transactions = DB::table('transactions')
            ->join('courses', 'transactions.course_id', '=', 'courses.course_id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.*', 'courses.course_title as course_name', 'users.name as user_name')
            ->whereNull('transactions.deleted_at')
            ->get();

        return view('dashboard.transactions', ['transactions' => $transactions]);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $courses = Courses::all();

        return view('dashboard/createTransaction', compact('users', 'courses'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'user_id' => 'required|numeric|exists:users,id',  // Ensure user exists
            'course_id' => 'required|numeric|exists:courses,course_id',  // Ensure course exists
            'type' => 'required|string|max:50',
            'amount' => 'required|numeric|min:0',
            'payment_status' => 'required|string|max:50',
        ]);

        // Create the transaction manually
        $transaction = new Transaction();
        $transaction->user_id = $request->user_id;
        $transaction->course_id = $request->course_id;
        $transaction->type = $request->type;
        $transaction->amount = $request->amount;
        $transaction->balance = 0;
        $transaction->payment_status = $request->payment_status;

        // Save the transaction to the database
        $transaction->save();

        // Redirect with success message
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        $validated = $request->validate([
            'user_name' => 'string|max:255',
            'course_title' => 'string|max:255',
            'type' => 'string|max:50',
            'amount' => 'numeric|min:0',
            'status' => 'string|max:50',
            'date' => 'date',
        ]);

        $transaction->update($validated);

        return response()->json(['success' => true, 'message' => 'Transaction updated successfully.']);
    }


    public function destroy($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->delete();

        return response()->json(['success' => true, 'message' => 'Transaction deleted successfully.']);
    }
}
