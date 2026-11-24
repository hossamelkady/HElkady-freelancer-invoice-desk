<?php
namespace App\Http\Controllers;
use App\Models\Invoice; use App\Models\Client; use Illuminate\View\View;
class DashboardController extends Controller {public function index():View{return view('dashboard',['clientCount'=>Client::count(),'outstanding'=>Invoice::whereIn('status',['sent','overdue'])->sum('amount'),'paidCount'=>Invoice::where('status','paid')->count(),'recent'=>Invoice::with('client')->latest()->take(6)->get()]);}}
