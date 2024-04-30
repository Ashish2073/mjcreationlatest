<div class="modal fade" id="{{ $showModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form inside the modal -->
                <form wire:submit.prevent="addOption">
                    <div class="mb-3">
                        <label for="optionName" class="form-label">Option Name</label>
                        <input type="text" class="form-control" id="optionName" wire:model.defer="optionName">
                        @error('optionName')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fileInput" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="fileInput" wire:model.defer="image">
                        @error('image')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <button wire:click.prevent="addOption" class="btn btn-primary">Add</button> --}}
                    <button wire:click.prevent="addOption" type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
