<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class LiveEmail extends Component
{
    public $name,$email,$Gband,$idpro;
    public function render()
    {

        $userid = Auth::user()->id;
        $users=User::select('*')
        ->where('id',$userid)
        ->get();
      
        return view('livewire.live-email',compact('users'));
    }
    public function edit($id){

        $this->Gband=1;
        $this->idpro=$id;


        $proyect = User::select('*')
        ->where('id',$id)
        ->get();
        
        $this->name=$proyect[0]->name;
        $this->email=$proyect[0]->email;
        
    }
    public function saveEdit(){
       //$this->validate();
       $frm_name =$this->name;
       $frm_descri =$this->email;       
  
        try{

        $data = array(
            "name"=>$frm_name,
            "email"=>$frm_descri,
      
        );
         
        $UPro = DB::table("users")->where("id" ,$this->idpro)->update($data);
        
        DB::commit();
        $this->message="Project Successfully Updated";
        $this->correct($this->message);
        $this->cleanfields();
        

         }catch(Exception $e){
             DB::rollBack();
             
             $this->message =$e->getMessage();
             $this->incorect($this->message);
        }
    }

    public function openmodal(){
        $this->cleanfields();
    }
    public function cleanfields(){
       
        $this->name='';
        $this->email='';
        $this->Gband='';
        $this->idpro='';
      
    }
    public function correct($mensaje){
        $this->dispatch('swal', [
            'title'=>$mensaje,
            'text' =>"",
            'icon' =>"success",
            'timer'=>1700,
        ]);
    }
    public function incorect(){
        $this->dispatch('swal', [
        'title' => $this->message,
        'text' => "",
        'icon' => "error",
        ]);
    }
}
