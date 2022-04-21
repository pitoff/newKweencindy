@csrf
<div class="col-sm-8">
    <div class="form-group">
        <select name="category" id="category" class="form-control">
            <option value=""> --Choose category-- </option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->category }}</option>
            @endforeach
        </select>
    </div>
</div>

<div id="categoryInfo">
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" class="form-control" value="" id="description">
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" class="form-control" value="" id="price">
        </div>
    </div>
</div>

<div class="col-sm-8">
    <div class="form-group">
        <select name="location" id="location" class="form-control">
            <option value=""> --Make up Location-- </option>
            <option value="office">Office location</option>
            <option value="personal">Personal location</option>
        </select>
    </div>
</div>

<div id="locationInfo">
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
</div>

<div class="col-sm-8">
    <div class="form-group">
        <input type="date" class="form-control" name="book_date" value="" placeholder="Booking date *">
    </div>
</div>

<div class="col-sm-8">
    <div class="form-group">
        <button class="btn fl-btn" type="submit">Save</button>
    </div>
</div>
