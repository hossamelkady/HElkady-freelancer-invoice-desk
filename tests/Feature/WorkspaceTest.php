<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;use Tests\TestCase;
class WorkspaceTest extends TestCase {use RefreshDatabase;public function test_guest_is_sent_to_sign_in():void{$this->get('/dashboard')->assertRedirect('/login');}public function test_registration_creates_user_and_signs_in():void{$this->post('/register',['name'=>'Demo User','email'=>'demo@example.test','password'=>'StrongPassword123','password_confirmation'=>'StrongPassword123'])->assertRedirect('/dashboard');$this->assertAuthenticated();}public function test_authenticated_user_can_open_dashboard():void{$user=\App\Models\User::create(['name'=>'Demo','email'=>'demo2@example.test','password'=>\Illuminate\Support\Facades\Hash::make('SecretPassword123')]);$this->actingAs($user)->get('/dashboard')->assertOk();}
public function test_user_cannot_see_or_change_another_users_data():void{
$a=\App\Models\User::create(['name'=>'A','email'=>'a@example.test','password'=>'SecretPassword123']);
$b=\App\Models\User::create(['name'=>'B','email'=>'b@example.test','password'=>'SecretPassword123']);
$client=$a->clients()->create(['name'=>'Client A','email'=>'c@example.test']);
$invoice=$a->invoices()->create(['number'=>'INV-1','client_id'=>$client->id,'issue_date'=>'2026-12-01','amount'=>10,'currency'=>'USD','status'=>'draft']);
$this->actingAs($b)->get(route('invoices.show',$invoice))->assertNotFound();
$this->actingAs($b)->put(route('clients.update',$client),['name'=>'Hacked','email'=>'x@example.test'])->assertNotFound();
$this->actingAs($b)->delete(route('invoices.destroy',$invoice))->assertNotFound();
$this->actingAs($b)->post(route('invoices.store'),['number'=>'INV-2','client_id'=>$client->id,'issue_date'=>'2026-12-01','amount'=>5,'currency'=>'USD','status'=>'draft'])->assertSessionHasErrors('client_id');
$this->actingAs($b)->get(route('clients.index'))->assertDontSee('Client A');
}}
