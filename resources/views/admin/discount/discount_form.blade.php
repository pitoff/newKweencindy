@csrf
<div class="">
    <div class="form-group">
        <label for="">Category</label>
        <input type="text" class="form-control" name="category"
            value="{{ $bookingToDiscount->category->category }}"
            readonly
        >
    </div>
</div>
<div class="">
    <div class="form-group">
        <label for="">Amount</label>
        <input type="text" class="form-control" name="price" id="amount"
            value="{{$bookingToDiscount->category->price}}"
            readonly
        >
    </div>
</div>
<div class="">
    <div class="form-group">
        <label for="">Discount Percentage</label>
        <input type="number" min="1" class="form-control" id="percentage" name="discount_percentage"
            value=""
            
        >
    </div>
</div>
<div class="">
    <div class="form-group">
        <label for="">Discounted Price</label>
        <input type="text" class="form-control" name="discounted_price" id="discountedPrice"
            value=""
        >
    </div>
</div>

<input type="hidden" name="booking_id" value="{{$bookingToDiscount->id}}">
<input type="hidden" name="category_id" value="{{$bookingToDiscount->category->id}}">

<div class="">
    <div class="form-group">
        <button class="btn fl-btn" type="submit">Save</button>
    </div>
</div>

<div class="text-right pt-4">
    <a href="{{ route('users') }}" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
        <strong><em>Users</em></strong> </a>
    </div>
