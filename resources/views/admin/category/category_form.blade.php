@csrf
<div class="col-sm-8">
    <div class="form-group">
        <input type="text" class="form-control" name="category"
            value="@isset($category) {{ $category->category }} @endisset"
            placeholder="Category name *">
        @error('category')
            <em class="text-danger">{{ $message }}</em>
        @enderror
    </div>
</div>
<div class="col-sm-8">
    <div class="form-group">
        <input type="text" class="form-control" name="description"
            value="@isset($category) {{ $category->description }} @endisset"
            placeholder="Description *">
        @error('description')
            <em class="text-danger">{{ $message }}</em>
        @enderror
    </div>
</div>

<div class="col-sm-8">
    <div class="form-group">
        <input type="text" class="form-control" name="price"
            value="@isset($category) {{ $category->price }} @endisset" placeholder="Price tag *">
        @error('price')
            <em class="text-danger">{{ $message }}</em>
        @enderror
    </div>
</div>

<div class="col-sm-8">
    <div class="form-group">
        <button class="btn fl-btn" type="submit">Save</button>
    </div>
</div>
