<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $status,$brand_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable'
        ];
    }

    public function resetInput(){
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }
    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'status' => Str::slug($this->status),
            'slug' => $this->status==true?'1':'0',
        ]);
        session()->flash('message','Brand added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findorFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findorFail($this->brand_id)->update([
            'name' => $this->name,
            'status' => Str::slug($this->status),
            'slug' => $this->status==true?'1':'0',
        ]);
        session()->flash('message','Brand updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id; 
    }

    public function destroyBrand()
    {
        Brand::findorFail($this->brand_id)->delete();
        session()->flash('message','Brand deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function render()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.brand.index',['brands'=>$brands])->extends('layouts.admin')->section('content');
    }
}
