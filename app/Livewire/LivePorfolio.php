<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Color;
use App\Models\Proyects;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Jobs\TimerEmail;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class LivePorfolio extends Component
{
    public $name,$descri,$image,$imagext,$imageedt,$imagextedt,$status,$Gband,$idpro;
    use WithFileUploads;
    use WithPagination;
    protected $rules = [
        'name' => 'required',
        'descri' => 'required',
        'image' => 'required|image',
    ]; 

    protected $messages = [
        'name.required' => 'Please add a name',
        'descri.required' => 'Please add a description',
        'image.required' => 'Please add a image',
        'image.image' => 'Please add only image',
    ];

    public function render()
    {
        $proyec= Proyects::paginate(5);
        return view('livewire.live-porfolio',compact('proyec'));
    }

    public function openmodal(){
        $this->cleanfields();
    }
    public function cleanfields(){
       
        $this->name='';
        $this->descri='';
        $this->image='';
        $this->Gband='';
        $this->imagext='';
        $this->imagextedt='';
       $this->imageedt='';
        
    }


    public function savePro(){

        //$this->validate();
        $frm_name =$this->name;
        $frm_descri =$this->descri;
        $frm_image =$this->image;
       
       
        $imagenContenido = $frm_image->get(); 
        $imagenBase64 = base64_encode($imagenContenido);
        $this->imagext = $frm_image->getClientOriginalExtension();

        try{
            DB::beginTransaction();
            
        $Gpro = new Proyects();
        $Gpro->PRO_NAME =  $frm_name;
        $Gpro->PRO_DESC = $frm_descri;
        $Gpro->PRO_IMAGE=$imagenBase64;
        $Gpro->PRO_IMAGExt= $this->imagext;
        $Gpro->PRO_STATUS= 0;
        $Gpro->save();
        
        DB::commit();
        $this->message="Successful project";
        $this->correct($this->message);
        $this->cleanfields();

         }catch(Exception $e){
             DB::rollBack();
             
             $this->message =$e->getMessage();
             $this->incorect($this->message);
             }
    
    }

    public function edit($id){

        $this->Gband=1;
        $this->idpro=$id;


        $proyect = Proyects::select('*')
        ->where('id',$id)
        ->get();
        
        $this->name=$proyect[0]->PRO_NAME;
        $this->descri=$proyect[0]->PRO_DESC;
        
    }
    public function saveEdit(){
       //$this->validate();
       $frm_name =$this->name;
       $frm_descri =$this->descri;
       $frm_image =$this->imageedt;
       $id_pro=$this->idpro;
       
  
        try{

          
       if ($frm_image !== null && $frm_image !== '') {
        $imagenContenido = $frm_image->get(); 
        $imagenBase64 = base64_encode($imagenContenido); 
        $this->imagextedt = $frm_image->getClientOriginalExtension();

        $data = array(
            "PRO_NAME"=>$frm_name,
            "PRO_DESC"=>$frm_descri,
            "PRO_IMAGE"=> $imagenBase64,
            "PRO_IMAGExt"=>$this->imagextedt,
        );
        } else {
            $data = array(
                "PRO_NAME"=>$frm_name,
                "PRO_DESC"=>$frm_descri,
            );
        }

            
            
         
        $EPro = DB::table("proyects")->where("id" ,$id_pro)->update($data);
        
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
    public function delete($id){

        try{
            DB::beginTransaction();
    
            $col = Proyects::where('id',$id);
            $col->delete();   
            
            DB::commit();
            $this->message="Project Successfully Eliminated";
            $this->correct($this->message);
        }catch(Exception $e){
            DB::rollBack();
             $this->message =$e->getMessage();
             $this->incorect($this->message);
        }
       
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

    public function statuschange($id,$cla){
      
        try{
            DB::beginTransaction();
            
        $data = array(
            "PRO_STATUS"=>$cla,
        );
        $Estatus= DB::table("proyects")->where("id" ,$id)->update($data);
        
        DB::commit();
        $this->message="Status Updated";
        $userid = Auth::user()->id;
        $dataUser = DB::table("users")
        ->select('name', 'email') 
        ->where("id", $userid)
        ->first();
      
        TimerEmail::dispatch($dataUser)->delay(now()->addMinutes(10));
        //TimerEmail::dispatch($dataUser);

        $this->correct($this->message);

        $this->cleanfields();

         }catch(Exception $e){
             DB::rollBack();
             
             $this->message =$e->getMessage();
             $this->incorect($this->message);
             }
       
    
    }



}
