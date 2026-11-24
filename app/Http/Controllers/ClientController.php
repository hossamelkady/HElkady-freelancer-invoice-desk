<?php
namespace App\Http\Controllers;
use App\Models\Client; use Illuminate\Http\Request; use Illuminate\Support\Facades\Hash; use Illuminate\View\View; use Illuminate\Http\RedirectResponse;
class ClientController extends Controller {
public function index():View{return view('clients.index',['clients'=>Client::latest()->paginate(12)]);} public function create():View{return view('clients.form');}
public function store(Request $r):RedirectResponse{$data=$r->validate(['name'=>'required|string|max:160','email'=>'required|email|max:255','company'=>'nullable|string|max:180','phone'=>'nullable|string|max:40','notes'=>'nullable|string|max:3000']);$client=Client::create($data);return redirect()->route('clients.index')->with('success','Client added.');}
public function edit(Client $client):View{return view('clients.form',compact('client'));} public function update(Request $r,Client $client):RedirectResponse{$client->update($r->validate(['name'=>'sometimes|required|string|max:160','email'=>'sometimes|required|email|max:255','company'=>'nullable|string|max:180','phone'=>'nullable|string|max:40','notes'=>'nullable|string|max:3000']));return redirect()->route('clients.index')->with('success','Client updated.');} public function destroy(Client $client):RedirectResponse{$client->delete();return redirect()->route('clients.index')->with('success','Client deleted.');}}
