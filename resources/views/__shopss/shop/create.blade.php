@extends('shopss.main')
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
                                    Add Shop 
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <a href="{{route('shopss.shop.index')}}"
                                           class="btn btn-success">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="shopFrm">
                            @method('POST')
                            @csrf
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <label>Shop Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Shop Name">

                                        </div>
                                        <div class="col-6 form-group">
                                            <label>OwnerName </label>
                                            <input type="text" class="form-control" id="ownername" name="ownername" placeholder="Enter OwnerName of Shop">
                                        </div>

                                         <div class="col-6 form-group">
                                            <label>Email </label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email ">
                                        </div>

                                          <div class="col-6 form-group">
                                            <label>Contact </label>
                                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter Contact No">
                                        </div>

                                          <div class="col-6 form-group">
                                            <label>Address </label>
                                            <textarea type="text" class="form-control" id="address" name="address" placeholder="Enter Address "></textarea>
                                        </div>



                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12  text-center form-group">
                                        <button type="submit" class="btn btn-primary submit">Save</button>

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
            $(".shopFrm").validate({
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
                            ownername:
                            {
                                required:true
                            },
                            contact:
                            {
                                required:true
                            },
                            address:
                            {
                                required:true
                            },

                    },
                messages:
                    {
                        name:
                            {
                                required: "Nmae is required"
                            },
                        email:
                            {
                                required: "Email is required"
                            },
                        ownername:
                            {
                                required: "OwnerName is required"
                            },

                          contact:
                            {
                                required: "contact is required"
                            },
                            address:
                            {
                                required: "address is required"
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
                if ($(".shopFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('shopss.shop.store')}}",
                        data: new FormData($('.shopFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Shop Created Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('shopss.shop.index')}}"
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
@stop

