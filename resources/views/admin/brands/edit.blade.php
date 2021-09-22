@extends('admin.main')
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
                                    Edit Brand
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <a href="{{route('admin.brands.index')}}"
                                           class="btn btn-success">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="brandFrm">
                            @method('POST')
                            @csrf
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row"> 
                                        <div class="col-12">
                                           <img src="{{url($brands->image)}}" height="100px" width="100px"> 
                                        </div>

                                    </div>
                                    <br>
                                </br>
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <label>Brand Name</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{$brands->title}}">
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{$brands->id}}">

                                        </div>
                                        <div class="col-6 form-group">
                                            <label>Brand Image </label>
                                            <input type="file" class="form-control" id="image" name="image"
                                                   accept="image/*">
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
            $(".brandFrm").validate({
                rules:
                    {
                        title:
                            {
                                required: true
                            },


                    },
                messages:
                    {
                        title:
                            {
                                required: "Title is required"
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
                if ($(".brandFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.brands.update')}}",
                        data: new FormData($('.brandFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Brand Updated Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.brands.index')}}"
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

