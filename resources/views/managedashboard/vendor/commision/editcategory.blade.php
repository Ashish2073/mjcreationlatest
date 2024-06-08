<div class="form-group">

    <label for="status-select">Vendor's Product Category</label>
    <select class="form-control" id="vendorcategorycommisionedit" name="vendorproductcategory">
        <option></option>

        @foreach ($vendorCategory as $data)
            <option value="{{ $data->category_id }}">{{ $data->categoryname }}</option>
        @endforeach

    </select>
</div>
