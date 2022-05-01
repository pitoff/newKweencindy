<?php
    Use Illuminate\Support\Carbon;
?>
@csrf
<div class="col-sm-8">
    <div class="form-group">
        <select name="category" id="category" class="form-control">
            <option value=""> --Choose category-- </option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @isset($book)
                    {{$cat->id == $book->category->id ? 'selected' : ''}}
                @endisset> {{ $cat->category}}</option>
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
            <option value="">@isset($book)
                {{$book->location}}
                @else
                --Make up Location--
            @endisset </option>
            <option value="office location">Office location</option>
            <option value="personal location">Personal location</option>
        </select>
    </div>
</div>

<div id="locationInfo">
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" class="form-control" name="state" value="@isset($book)
                {{$book->state}}
            @endisset" placeholder="State *">
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" class="form-control" name="town" value="@isset($book)
                {{$book->town}}
            @endisset" placeholder="Town *">
        </div>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" class="form-control" name="address" value="@isset($book)
                {{$book->address}}
            @endisset" placeholder="Address *">
        </div>
    </div>
</div>

<div class="col-sm-8">
    <div class="form-group">
        <input type="date" class="form-control" name="book_date" value="@isset($book)
            {{ $book->book_date }}
        @endisset" placeholder="Booking date *">
    </div>
</div>

<div class="col-sm-8">
    <div class="form-group">
        <button class="btn fl-btn" type="submit">Save</button>
    </div>
</div>
