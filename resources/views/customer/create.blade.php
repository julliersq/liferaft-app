@extends('layout');

@section('title')
    Contact Information Form
@endsection

@section('page_heading')
    User Registration
@endsection

@section('content')
<form id="create-customer-form" class="well form-horizontal" method="POST">
    @csrf
    <fieldset>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="name-help" value="{{ old('name') }}">
            <div id="name-help" class="form-text">Please enter your full name.</div>
        </div>            
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" value="{{ old('email') }}">
            <div id="email-help" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="phone-help" value="{{ old('phone') }}">
            <div id="phone-help" class="form-text">Please enter your phone number including area code.</div>
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <select  name="country" id="country" class="form-select" aria-label="Country" aria-describedby="country-help">
                @if(count($countries) > 0)
                        <option value=""> -- </option>
                    @foreach($countries as $country)
                        @if(old('phone') == $country['id'])
                            <option value="{{ $country['id'] }}" selected>{{ $country['name'] }}</option>  
                        @else
                            <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                        @endif
                    @endforeach
                @else
                    <option value="">No countries found</option>
                @endif
            </select>                                        
            <div id="country-help" class="form-text">Please select your country.</div>
        </div>                
        <div class="mb-3">
            <label for="house-num" class="form-label">House Number</label>
            <input type="number" class="form-control" id="house-num" name="house-num" aria-describedby="house-num-help" value="{{ old('house-num') }}">
            <div id="house-num-help" class="form-text">Please enter your house number.</div>
        </div>
        <div class="mb-3">
            <label for="street" class="form-label">Street Name</label>
            <input type="text" class="form-control" id="street" name="street" aria-describedby="street-help" value="{{ old('street') }}">
            <div id="street-help" class="form-text">Please enter your street name.</div>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" aria-describedby="city-help" value="{{ old('city') }}">
            <div id="city-help" class="form-text">Please enter your city.</div>
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">State/Province</label>
            <input type="text" class="form-control" id="state" name="state" aria-describedby="state-help">              
            <div id="state-help" class="form-text">Please enter your state/province.</div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </fieldset>
</form>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#country').on('change', function(){
            var country_id = $(this).val();                
            if(country_id) {
                $.ajax({
                    url: '{{url("states")}}/'+country_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if( data.length > 0 ){
                            $('#state').remove();
                            $('#state-help').prepend('<select name="state" id="state" class="form-select" aria-label="State/Province" aria-describedby="state-help">');
                            $('#state').empty();
                            $('#state').append('<option value=""> -- </option>');
                            $.each(data, function(key, value){
                                $('#state').append('<option value="'+value.state_code+'">'+value.name+'</option>');
                            });
                        }
                        else{
                            $('#state').remove();
                            $('#state-help').prepend('<input type="text" class="form-control" id="state" name="state" aria-describedby="state-help">');                                
                        }
                    }
                });
            } else {
                $('#state').empty();
            }
        });
        $('#create-customer-form').on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize();
            $('#alert-message').remove();
            $.ajax({
                url: '{{url("customers/store")}}',
                type: "POST",
                data: formData,
                dataType: 'json',
                success: function(data, textStatus, xhr){
                    if(data.success){
                        var success_html = '<div class="alert alert-success" id="alert-message">You have successfully registered.</div>';
                        $('#create-customer-form fieldset').prepend(success_html);
                        $('#create-customer-form').trigger('reset');
                    }
                    else{
                        
                        if( $(data.errors).length > 0 ){
                            var errors_html = '<div class="alert alert-danger" id="alert-message">There are items that require your attention: <ul>';
                            $.each(data.errors, function(key, value){
                                errors_html += '<li>'+value+'</li>';                            
                            });
                            errors_html += '</ul></div>';

                            $('#create-customer-form fieldset').prepend(errors_html);
                        }
                    }
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                }
            });
        });    
    });    
</script>
@endsection
