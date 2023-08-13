<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <div class="container text-center">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('status'))
    <div class="alert alert-{{ session('status') }}">
        {{ session('message') }}
    </div>
@endif
        <form action="{{ route('register.store') }}" method="post">
            @csrf
        <div class="row" style="background-color: aquamarine;padding: 10px;">
            <div class="col-md-3">Event</div>
            <div class="col-md-3">Amount(INR)</div>
            <div class="col-md-3">Selected &#8377; <span style="color: red" id="total_selected_item_span">0</span></div>
            <div class="col-md-3">Total Amount &#8377; <span style="color: red" id="total_amount_span">0</span></div>
            <input type="hidden" name="total_selected_item_input" id="total_selected_item_input">
            <input type="hidden" name="total_amount_input" id="total_amount_input">
        </div>
        <div class="row mt-2 repeater_div">
            <div class="col-md-3">
                <label for="event" class="form-label event_label">Half Marathon</label>
                <input type="hidden" name="event[]" class="form-control event" value="Half Marathon">
            </div>
            <div class="col-md-3">
                <label for="event" class="form-label amount_label">250</label>
                <input type="hidden" name="amount[]" class="form-control amount" value="250">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger substract">-</button>
            </div>
            <div class="col-md-1">
                <input type="number" name="selected[]" class="form-control selected_item" readonly pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="0">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-success add">+</button>
            </div>
            <div class="col-md-3">
                <label for="event" class="form-label">&#8377; <span style="color: red" class="event_amount_span">0</span></label>
                <input type="hidden" name="event_amount[]" class="form-control event_amount_input" value="0">
            </div>
        </div>
        <div class="row mt-2 repeater_div">
            <div class="col-md-3">
                <label for="event" class="form-label event_label">10K Run</label>
                <input type="hidden" name="event[]" class="form-control event" value="10K Run">
            </div>
            <div class="col-md-3">
                <label for="event" class="form-label amount_label">200</label>
                <input type="hidden" name="amount[]" class="form-control amount" value="200">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger substract">-</button>
            </div>
            <div class="col-md-1">
                <input type="number" name="selected[]" class="form-control selected_item" readonly pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="0">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-success add">+</button>
            </div>
            <div class="col-md-3">
                <label for="event" class="form-label">&#8377; <span style="color: red" class="event_amount_span">0</span></label>
                <input type="hidden" name="event_amount[]" class="form-control event_amount_input" value="0">
            </div>
        </div>
        <div class="row mt-2 repeater_div">
            <div class="col-md-3">
                <label for="event" class="form-label event_label">5K Run</label>
                <input type="hidden" name="event[]" class="form-control event" value="5K Run">
            </div>
            <div class="col-md-3">
                <label for="event" class="form-label amount_label">150</label>
                <input type="hidden" name="amount[]" class="form-control amount" value="150">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger substract">-</button>
            </div>
            <div class="col-md-1">
                <input type="number" name="selected[]" class="form-control selected_item" readonly pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="0">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-success add">+</button>
            </div>
            <div class="col-md-3">
                <label for="event" class="form-label">&#8377; <span style="color: red" class="event_amount_span">0</span></label>
                <input type="hidden" name="event_amount[]" class="form-control event_amount_input" value="0">
            </div>
        </div>
        <button type="submit"  class="btn btn-success mt-5">Register</button>
    </form>
    </div>
<script>
$(document).ready(function() {
$(document).on('click','.add',function(){
    var my_row = $(this).parents('.repeater_div');
        var seleccted_item = my_row.find('.selected_item').val( function(i, oldval) {
        return ++oldval;
    });
var unit = my_row.find('.selected_item').val();
var amount = my_row.find('.amount').val();
var row_amount = unit*amount;
my_row.find('.event_amount_input').val(row_amount);
my_row.find('.event_amount_span').html(row_amount);
var total_item=0;
var total_amount=0;
$('.selected_item').each(function(){
    total_item += parseFloat(this.value);
});
$('.event_amount_input').each(function(){
    total_amount += parseFloat(this.value);
});

calculation(total_item,total_amount)
});

$(document).on('click','.substract',function(){
    var my_row = $(this).parents('.repeater_div');
        var seleccted_item = my_row.find('.selected_item').val( function(i, oldval) {
        return --oldval;
    });
var unit = my_row.find('.selected_item').val();
if(unit <0){
    my_row.find('.selected_item').val(0);
    return;
}
var amount = my_row.find('.amount').val();
var row_amount = unit*amount;
my_row.find('.event_amount_input').val(row_amount);
my_row.find('.event_amount_span').html(row_amount);
var total_item=0;
var total_amount=0;
$('.selected_item').each(function(){
    total_item += parseFloat(this.value);
});
$('.event_amount_input').each(function(){
    total_amount += parseFloat(this.value);
});

calculation(total_item,total_amount)
});
});
function calculation(selected_item_input,total_amount_input){
    $('#total_selected_item_span').text(selected_item_input);
    $('#total_amount_span').text(total_amount_input);
    $('#total_selected_item_input').val(selected_item_input);
    $('#total_amount_input').val(total_amount_input);
}
</script>
</body>
</html>