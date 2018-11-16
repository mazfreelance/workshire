@extends('layouts.master_admin')

@section('title', 'Setting | Web')

@section('content') 
<div class="content-wrapper">
        <!-- Container-fluid starts -->
       <div class="container-fluid">
        <!-- Row Starts -->
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting | Web</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="icofont icofont-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">User Setting</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.web')}}">Web</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Row end -->
        <!-- Row content -->
        <div class="row">
            <div class="col-md-12">  
        		<!-- Col content-2 --> 
				<div class="card">
                    <div class="card-header">
                    	Setting for web use.
                    </div>  
                    <div class="card-block">  
                        <form>
                            <legend class="bg-info">General</legend>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-xs-2 col-form-label form-control-label">Timezone</label>
                                <div class="col-sm-10"> 
                                    <select class="form-control" id="locality-dropdown"></select> 
                                </div>
                            </div> 
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-30">Save</button> 

                        </form>
                    </div>
                </div> 
    			<!-- Col content-2 end-->
            </div>
        </div>
        <!-- Row content end -->
    </div>
    <!-- Container-fluid ends -->
</div>
    @section('css') 
    <style>

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />  
    @endsection

    @section('js') 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>  
    <script>   
    $( document ).ready(function() {  
             
        let dropdown = $('#locality-dropdown');

        dropdown.empty();

        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
        dropdown.prop('selectedIndex', 0);

        const url = "<?php echo url('/json/timezone.json') ?>";
        $.getJSON( url, function( data ) {
            //Assign the json to your JSON variable   
            /*
            $.each(data, function (key, entry) {    
                for (var i = entry['zones'].length - 1; i >= 0; i--) {
                    //console.log(entry.zones[i].name);
                    dropdown.append($('<option></option>').attr('value', entry.zones[i].value).text(entry.zones[i].value)); 
                } 
            })
            */
            $.each(data, function (i, val) {
                var group = { // here's a group object:
                    group: true, 
                    zones: [] // individual options within the group
                };

                dropdown.append($('<optgroup>').attr('label', val.group));

                $.each(val.zones, function (i1, val1) {
                    //group.items.push({value: val1.value, text: val1.text});
                    dropdown.append($('<option></option>').attr('value', val1.value).text(val1.value));
                    //console.log(val.group+' '+val1.value);
                });

                //results.push(group);
            });
        });

         //$('#locality-dropdown').chosen();


        $(document).on('change', '#locality-dropdown', function(){
            var value = $(this).val();
            alert(value);

            return false;
        });
    });
    </script>
    @endsection

@endsection 