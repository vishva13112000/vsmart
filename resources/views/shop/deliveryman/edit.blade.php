@extends('shop.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <br>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Edit DeliveryMan
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <a href="{{route('shop.deliveryman.index',$deliveryman->shopid)}}"
                                           class="btn btn-success">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="deliverymanFrm">
                            @method('POST')
                            @csrf
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">

                                        <div class="form-group col-4">
                                            <label>Shop Name</label>
                                            <input readonly type="text" class="form-control" id="shop_name"
                                                   value="{{$deliveryman->shop->name}}">
                                            <input type="hidden" class="form-control" id="shop_id" name="shopid"
                                                   value="{{$deliveryman->shopid}}">

                                            <input type="hidden" class="form-control" id="id" name="id"
                                                   value="{{$deliveryman->id}}">

                                        </div>
                                        <div class="form-group col-4">
                                            <label>DeliveryMan Name</label>
                                            <input type="text" class="form-control" id="name"   value="{{$deliveryman->name}}"
                                                   placeholder="Enter DeliveryMan Name" name="name">

                                        </div>
                                        <div class="form-group col-4">
                                            <label>Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email"
                                                   id="email" name="email"   value="{{$deliveryman->email}}">

                                        </div>
                                        <div class="form-group col-4">
                                            <label>Address</label>
                                            <textarea class="form-control" placeholder="Enter Address"
                                                      id="address" name="address">
                                                {{$deliveryman->address}}
                                            </textarea>
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Contact No</label>
                                            <input type="text" class="form-control numbersOnly" id="contactno"
                                                   name="contactno" placeholder="Enter Contact no"
                                                   maxlength="10"   value="{{$deliveryman->contactno}}"
                                                   onkeypress="return isNumber(event)"/>
                                            @foreach($errors->get('contactno') as $eroor)
                                                <span class="help-block">{{ $error}}</span>
                                            @endforeach
                                            <div class="fv-plugins-message-container invalid-feedback"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  text-center form-group">
                                        <button type="submit" class="btn btn-primary submit">Edit</button>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>

        $(document).ready(function () {
            $(".deliverymanFrm").validate({
                rules:
                    {
                        name:
                            {
                                required: true
                            },

                        email:
                            {
                                required: true
                            },
                        address:
                            {
                                required: true
                            },
                        contactno:
                            {
                                required: true
                            },

                    },
                messages:
                    {
                        name:
                            {
                                required: "Name is required"
                            },
                        email:
                            {
                                required: 'Email is required'
                            },
                        address:
                            {
                                required: 'Address is required'
                            },
                        contactno:
                            {
                                required: 'ContactNo is required'
                            },

                    },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                    $('.help-block').css('color', 'red');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $(".submit").click(function (event) {
                // alert('he');
                event.preventDefault();
                if ($(".deliverymanFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('shop.deliveryman.update')}}",
                        data: new FormData($('.deliverymanFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "DeliveryMan Updated Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('shop.deliveryman.index',$deliveryman->shopid)}}"
                                });

                            } else if (data.status === 'error') {
                                swal({
                                    title: "Error",
                                    text: "Opps..! Something Went to Wrong.",
                                    type: "error"
                                });

                            }


                        }
                    });
                } else {
                    event.preventDefault();
                }
            });

        });
    </script>
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@stop

