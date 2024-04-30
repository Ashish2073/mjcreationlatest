<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Productbrandscreate extends Component
{
    use WithFileUploads;
    #[Validate('required|min:3|max:1024')]
    public $optionName;
    protected $listeners=['openModal'];

    public $showModal=false;

    #[Validate('required')]
    public $image;
    public function render()
    {
        return view('livewire.productbrandscreate');
    }

    public function addOption()
    {
        $this->validate();
        // Save the option to the database 
        
        
        // $originName=$request->file('upload')->getClientOriginalName();
        //     $fileName=pathinfo($originName,PATHINFO_FILENAME);
        //     $extension=$request->file('upload')->getClientOriginalExtension();
        //     $fileName=$fileName.'__'.time().'.'.$extension;
        //     $request->file('upload')->move(public_path('textarea'),$fileName);


        // Productbrand::create([
        //     'name' => $this->optionName,
        //     'file' => $this->file->store('files', 'public'), // Store uploaded file
        // ]);

        // Clear input fields after submission
        // $this->reset(['optionName', 'image']);
        $this->dispatch('closeModal');


        // Close the modal after adding the option
        // $this->dispatchBrowserEvent('closeModal');
    }

    public function closeModal(){
        $this->showModal=false;
    }

    public function openModal(){
        $this->showModal="exampleModal";
    }
}
