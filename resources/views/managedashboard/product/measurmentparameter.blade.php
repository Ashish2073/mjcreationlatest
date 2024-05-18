<style>
    .select2-container--default .select2-selection--single {
        height: 40px !important;
    }
</style>


<div class="col-md-6">
    <label for="" class="form-label">{{ $select_label ?? 'Product Measurment Parameter' }} </label>
    <div class="input-group">
        <div class="d-flex">
            <select name="{{ $select_name ?? 'product_measurment_parameter' }}"
                id="{{ $select_id ?? 'product_measurment_parameter_main_id' }}"
                class="form-select {{ $selectindexchange ?? 'selectspecficationindexchange' }}"
                aria-label="Default select example">
                <option selected disabled>Open this select menu</option>
                @foreach ($selectdata as $data)
                    <option @if (isset($selectedid)) @if ($selectedid == $data->id) selected @endif
                        @endif value="{{ $data->id }}">
                        {{ ucwords($data->name) }}</option>
                @endforeach
            </select>

            <button type="button" id="{{ $openModalButton ?? 'openMeasurmentModalButton' }}"
                class="btn btn-primary ml-2">Add
                option</button>
        </div>

        <span id="{{ $seletspanerror ?? 'product_measurment_parameter' }}" style="color: red;"></span>

        <div class="modal fade" id="{{ $modal_id ?? 'myModal' }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ $modal_label ?? 'exampleModalLabel' }}"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal content goes here -->


                        <div class="form-group">
                            <label
                                for="{{ $inputlabelfor ?? 'product_measurment_name_id' }}">{{ $input_label ?? 'Measurment Parameter Name' }}</label>
                            <input type="{{ $type ?? 'text' }}" class="form-control"
                                id="{{ $input__id ?? 'product_measurment_name_id' }}"
                                name="{{ $input_name ?? 'measurment_parameter_name' }}">
                            <span id="{{ $span_error_id ?? 'mesaurement_parameter_error_id' }}"
                                class="text-danger"></span>
                        </div>

                        <button type="button" class="btn btn-primary"
                            id="{{ $submitbtnid ?? 'submitMeasurementParameterForm' }}">Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
