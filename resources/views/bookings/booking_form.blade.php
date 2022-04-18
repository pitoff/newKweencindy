@csrf
<div class="col-sm-8">
    <div class="form-group">
        <select name="category" id="" class="form-control">
            <option value="0"> --Choose category-- </option>
            @foreach ($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->category}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-sm-8">
    <div class="form-group">
        <select name="location" id="" class="form-control">
            <option value="0"> --Make up Location-- </option>
            
        </select>
    </div>
</div>
<div class="col-sm-8">
    <div class="form-group">
        <input type="text" class="form-control" name="state" value="" placeholder="State *">
    </div>
</div>
<div class="col-sm-8">
    <div class="form-group">
        <input type="text" class="form-control" name="town" value="" placeholder="Town *">
    </div>
</div>
<div class="col-sm-8">
    <div class="form-group">
        <input type="text" class="form-control" name="address" value="" placeholder="Address *">
    </div>
</div>

<div class="col-sm-8">
    <div class="form-group">
        <button class="btn fl-btn" type="submit">Save</button>
    </div>
</div>