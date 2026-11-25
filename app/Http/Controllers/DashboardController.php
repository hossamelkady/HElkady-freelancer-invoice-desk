<?php
namespace App\Http\Controllers;
use App\Models\Invoice; use App\Models\Client; use Illuminate\View\View;
class DashboardController extends Controller {public function index(\Illuminate\Http\Request $r):View{$u=$r->user();return view('dashboard',['clientCount'=>$u->clients()->count(),'outstanding'=>$u->invoices()->whereIn('status',['sent','overdue'])->sum('amount'),'paidCount'=>$u->invoices()->where('status','paid')->count(),'recent'=>$u->invoices()->with('client')->latest()->take(6)->get()]);}}
