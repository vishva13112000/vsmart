@extends('admin.main')
@section('content')
<style>
    .delete:hover{
        color: white !important;
    }
</style>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <br>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Add Inventory
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <a href="{{route('admin.products.index')}}"
                                           class="btn btn-success">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                              @if(count($inventories) == 0)
                            <form class="inventoryFrm">
                                @method('POST')
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="row">
                                        <table class="table" style="border: 1px; solid-color: #0a001f">
                                            <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Stock</th>
                                                <th>Qty</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="cl">
                                                <td><input type="text" class="form-control" name="size[]"></td>
                                                <td><select class="form-control is_stock" name="is_stock[]">
                                                        <option value="0">Limitless Stock</option>
                                                        <option value="1">Out Of Stock</option>
                                                        <option value="2">In Stocks</option>
                                                    </select></td>
                                                <td class="qty1"><input type="number" class="form-control qty" name="qty[]"></td>

                                                <td>
                                                    <button type="button" class="btn btn-primary addmore">Add</button>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                        <div class="form-group col-10">
                                            <button type="submit" class="btn btn-primary submit">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        @else
                            <form class="inventoryeditFrm">

                                @method('POST')
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="row">
                                        <table class="table" style="border: 1px; solid-color: #0a001f">
                                            <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Qty</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="tb">
                                            @foreach($inventories as $inventory)
                                                <tr class="cl">
                                                    <td><input type="text" class="form-control"
                                                               name="size[{{$inventory->id}}]"
                                                               value="{{$inventory->size}}"></td>
                                                    <td>
                                                        <select class="form-control is_stock" name="is_stock[{{$inventory->id}}]">
                                                            <option value="0" @if($inventory->is_stock == 0) selected @endif>Limitless Stock</option>
                                                            <option value="1" @if($inventory->is_stock == 1) selected @endif>Out Of Stock</option>
                                                            <option value="2" @if($inventory->is_stock == 2) selected @endif>In Stocks</option>
                                                        </select>
                                                    </td>
                                                    <td class="qty1"><input type="number" class="form-control qty"
                                                               name="qty[{{$inventory->id}}]"
                                                               value="{{$inventory->qty}}"></td>

                                                    <td><input type="hidden" class="form-control" name="inventory_id[]"
                                                               value="{{$inventory->id}}">
                                                        <button type="button" data-id="{{ $inventory->id }}"
                                                                data-token="{{ csrf_token() }}" class="btn btn-sm badge-danger delete" style="background-color: red;"> <i class="fa fa-trash"></i>
                                                        </button></td>
                                                </tr>
                                            @endforeach
                                            <tr class="cl">
                                                <td><input type="text" class="form-control" name="size1[]"></td>
                                                <td><select class="form-control is_stock" name="is_stock1[]">
                                                        <option value="0">Limitless Stock</option>
                                                        <option value="1">Out Of Stock</option>
                                                        <option value="2">In Stocks</option>
                                                    </select></td>
                                                <td class="qty1"><input type="number" class="form-control qty" id="qty" name="qty1[]" value="0" readonly></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary addmore1">Add</button>
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>

                                        <div class="form-group col-10">
                                            <button type="submit" class="btn btn-primary update">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        @endif
                    
                        <!-- <foorm> -->
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>

        $(document).ready(function () {

                $(document).on('change', '.is_stock', function () {
                if($(this).val() == 2){
                 $(this).closest('td').next('td').find('.qty').val('1')
                 $(this).closest('td').next('td').find('.qty').attr('readonly',false)
                }else{
                $(this).closest('td').next('td').find('.qty').val(0)
                $(this).closest('td').next('td').find('.qty').attr('readonly','readonly')
                }
            })

          var i = 1;
            $(".addmore").click(function () {
                var ap = '<tr id="row'+i+'">';
                ap += "<td><input type=text class=form-control name=size[]></td>";
                ap += "<td><select class='form-control is_stock' name=is_stock[] data-id=" + i + "><option value=0>Limitless Stock</option><option value=1>Out Of Stock</option><option value=2>In Stocks</option></select></td>";
                ap += "<td class='qty1'><input type=number class='form-control qty' name=qty[]></td>";
                ap += "<td><button type='button' class='btn btn-primary remove' id="+i+">delete</button></td></tr>";
                $("tbody").append(ap);
                i++;
            });
            $(document).on('click', '.remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });


              var j = 1;
            $(".addmore1").click(function () {
                var ap1 = '<tr id="row'+j+'">';
                ap1 += "<td><input type=text class=form-control name=size1[]></td>";
                ap1 += "<td><select class='form-control is_stock' name=is_stock1[] data-id=" + i + "><option value=0>Limitless Stock</option><option value=1>Out Of Stock</option><option value=2>In Stocks</option></select></td>";
                ap1 += "<td class=qty1><input type=number class='form-control qty' name=qty1[]></td>";
                ap1 += "<td><button type=button class='btn btn-primary btnremove' id="+j+">delete</button></td></tr>";
                $(".tb").append(ap1);
                i++;
            });
            $(document).on('click', '.btnremove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });





            $(".categoryFrm").validate({
                rules:
                    {
                        title:
                            {
                                required: true
                            },
                        image:
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
                        image:
                            {
                                required: "Imageis required"
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
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.inventory.store')}}",
                    data: new FormData($('.inventoryFrm')[0]),
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.status === 'success') {
                            swal({
                                title: "Success",
                                text: "Products Stock Added Successfully",
                                type: "success"
                            }, function () {
                                // Toast.fire({
                                //     icon: 'success',
                                //     title: 'Product Created Successfully.'
                                // })
                                window.location = "{{route('admin.products.index')}}"
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
            });

                $(".update").click(function (event) {
                event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{route('admin.inventory.update')}}",
                    data: new FormData($('.inventoryeditFrm')[0]),
                    processData: false,
                    contentType: false,

                    success: function (data) {
                        if (data.status === 'success') {
                            swal({
                                title: "Success",
                                text: "Products Stock Added Successfully",
                                type: "success"
                            }, function () {
                                // Toast.fire({
                                //     icon: 'success',
                                //     title: 'Product Created Successfully.'
                                // })
                                window.location = "{{route('admin.products.index')}}"
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

            });

             $(".delete").click(function (event) {
                var id = $(this).data("id");
                event.preventDefault();
                swal({
                        title: "Are you sure!",
                        type: "error",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes!",
                        showCancelButton: true,
                    },
                    function() {
                        $.ajax({
                            url: "{{route('admin.inventory.delete')}}",
                            type: "delete",
                            data: {id: id,_token: '{{ csrf_token() }}'},
                            cache: false,
                            dataType: 'json',

                            success: function (data) {
                                if (data.status === 'success') {
                                    swal({
                                        title: "Success",
                                        text: "Stock successfully deleted",
                                        type: "success"
                                    }, function () {
                                        location.reload(true);
                                    });

                                } else if (data.status === 'error') {
                                    swal({
                                        title: "Error",
                                        text: "Opps..! Something Went to Wrong.",
                                        type: "error"
                                    });

                                }

                            },

                        });

                    });



            });

        });
    </script>

@stop

