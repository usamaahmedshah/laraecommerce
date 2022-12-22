<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addBrandModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add Brands</h5>
          <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form wire:submit.prevent="storeBrand">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label>Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label>Status</label><br/>
                    <input type="checkbox" wire:model.defer="status" style="width:70px;height:70px;" />Checked=Hidden,Un-checked=Visible
                    @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Brand Update Modal -->
<div wire:ignore.self class="modal fade" id="updateBrandModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Brands</h5>
        <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div wire:loading>
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading....</span>
        </div>
      </div>
      <div wire:loading.remove>
      <form wire:submit.prevent="updateBrand">
          <div class="modal-body">
              <div class="mb-3">
                  <label>Brand Name</label>
                  <input type="text" wire:model.defer="name" class="form-control">
                  @error('name')<small class="text-danger">{{ $message }}</small>@enderror
              </div>
              <div class="mb-3">
                  <label>Brand Slug</label>
                  <input type="text" wire:model.defer="slug" class="form-control">
                  @error('slug')<small class="text-danger">{{ $message }}</small>@enderror
              </div>
              <div class="mb-3">
                  <label>Status</label><br/>
                  <input type="checkbox" wire:model.defer="status" style="width:70px;height:70px;" />Checked=Hidden,Un-checked=Visible
                  @error('status')<small class="text-danger">{{ $message }}</small>@enderror
              </div> 
          </div>
          <div class="modal-footer">
              <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>

 <!-- Delete Update Modal -->
 <div wire:ignore.self class="modal fade" id="deleteBrandModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete Brand</h5>
        <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div wire:loading>
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading....</span>
        </div>
      </div>
      <div wire:loading.remove>
      <form wire:submit.prevent="destroyBrand">
          <div class="modal-body">
              <h4>Are you sure you want to delete this data ?</h4>
          </div>
          <div class="modal-footer">
              <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Yes. Delete</button>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>