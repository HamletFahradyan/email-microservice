<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmails()
    {
        \Illuminate\Log\log('3333');
        $users = User::all(); // Or a query to fetch the list of a million users

        foreach ($users as $user) {
            $data = ['name' => $user->name, 'message' => 'Hello!']; // Customize your data
            SendEmailJob::dispatch($user->email, $data)->onQueue('emails');
        }

        return response()->json(['status' => 'Emails are being sent!']);
    }
}
