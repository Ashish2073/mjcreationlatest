<div class="col-md-6">
    <label for="" class="form-label">Brand Name</label>
    <div class="input-group">
        <select name="product_brand_id" class="form-select" wire:model="brand.name" aria-label="Default select example">
            <option selected disabled>Open this select menu</option>
            @foreach ($product_brands as $data)
                <option wire:key="{{ $data->id }}" value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
            @endforeach
        </select>
        <!-- Button to trigger modal -->
        <button type="button" style="color:white" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal" wire:click="openModal()">
            Add New Brand Name
        </button>

        <!-- Modal -->
        <!-- Modal -->
        <livewire:Productbrandscreate>




    </div>
</div>
