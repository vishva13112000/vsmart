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
                                Edit Product Type
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="kt-portlet__head-actions">
                                    <a href="{{route('admin.producttype.index')}}"
                                    class="btn btn-success">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="producttypeFrm">
                        @method('POST')
                        <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <label>Product Type Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$producttype->name}}">
                                        <input type="hidden" class="form-control" id="id" name="id" value="{{$producttype->id}}">

                                    </div>


                                    <div class="col-6 form-group">
                                        <label>Product Type Value</label>
                                        <input type="text" class="form-control" id="value" name="value" value="{{$producttype->value}}">


                                    </div>


                                </div>
                                <div class="row">
                                    <table class="col-8 table table-border">
                                        <thead>
                                            <tr>
                                                <th>Value</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($producttypevalues))
                                            @foreach($producttypevalues as $producttypevalue)
                                            <tr class="tr">
                                                <td> <input type="text" class="form-control" id="value" name="values[{{$producttypevalue->id}}]" value="{{$producttypevalue->value}}"></td>
                                                <td><button type="button" class="btn btn-danger delete" data-id="{{$producttypevalue->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            <tr class="tr 0 ">
                                                <td> <input type="text" class="form-control" id="value" name="value[]"></td>
                                                <td><button type="button" class="btn btn-primary add_more"><i class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>

                                    </table>
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
       var i = 1;
       $(document).on('click', '.add_more', function () {
        i++;
        var addcollumn = "<tr class='ptr" + i + "'>"
        addcollumn += "<td><input type='text' name='value[]'    class='form-control' /></td>"
        addcollumn += "<td><button type='button' name='remove' id='" + i + "'  onclick='removeRow(this);' class='btn btn-danger btn_remove'>X</button></td>";
        addcollumn += "</tr>";
        $('table tbody').append(addcollumn); 
    });
       $(document).on('click', '.btn_remove', function () {

        var button_id = $(this).attr("id");

        $('.ptr' + button_id + '').remove();
        $('.btn_remove').closest('.product_row').find('.element').not(':first').last().remove();

    });

       $(".producttypeFrm").validate({
        rules:
        {
            name:
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
                if ($(".producttypeFrm").valid()) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.producttype.update')}}",
                        data: new FormData($('.producttypeFrm')[0]),
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Product Type Updated Successfully",
                                    type: "success"
                                }, function () {
                                    window.location = "{{route('admin.producttype.index')}}"
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


       $(document).on('click','.delete',function(){
            $.ajax({
                        type: "POST",
                        url: "{{route('admin.producttype.delete')}}",
                        data: {
                            'id':$(this).data('id'),
                             "_token": $('#token').val()
                        },
                        processData: false,
                        contentType: false,
                        cache: false,

                        success: function (data) {
                            if (data.status === 'success') {
                                swal({
                                    title: "Success",
                                    text: "Product Type Delete Successfully",
                                    type: "success"
                                }, function () {
                                 location.reload()
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
       })

   });
</script>
@stop

