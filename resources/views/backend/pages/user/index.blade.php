@extends('backend.layout.master')

@push('backendCss')
    {{--    <meta name="csrf_token" content="{{ csrf_token() }}" />--}}

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Users</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    {{-- Table Starts--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Users List</h4>
                        {{--                       @can('Create Admin')--}}
{{--                        @if(Auth::guard('admin')->user()->can('Create Admin'))--}}
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                                Create User
                            </button>
                            {{--                        @endcan--}}
{{--                        @endif--}}
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0  nowrap w-100 dataTable no-footer dtr-inline" id="userTable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody id="tsdad">
      
                            
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{--    Table Ends--}}

    {{--    Create Categories Modal--}}
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="createAdmin">
                        @csrf

                        <div class="mb-3">
                            <label for="Name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="Name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    Edit Categories Modal--}}
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form2" id="editUser">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="eName" class="col-form-label">Name</label>
                            <input type="text" id="eName" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="eEmail" class="col-form-label">Email</label>
                            <input type="text" id="eEmail" class="form-control" name="email">
                        </div>
                    
                        <input id="id" type="number" hidden="">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
{{--    <h2 id="header">THIS IS AJAX CLASS</h2>--}}
{{--    <input id="input" type="number" class="form-control" value="123456789"/>--}}
{{--    --}}
{{--    <button id="btnAjax" class="btn btn-primary" onclick="inputManipulation()">Click Me</button>--}}
@endsection

@push('backendJs')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

     <script>
         
         
         

         $(document).ready(function () {
             //Datatable
        let userTable=   $('#userTable').DataTable({
               
                 processing: true,
                 serverSide: true,
                
                 ajax: "{{route('user.getdata')}}",
                 columns: [
                     {
                         data: 'id',
                        

                     },
                     {
                         data: 'name',

                     },
                     {
                         data: 'email',

                     },
                  

                     {
                         data: 'action',
                         // optional
                         name: 'Actions',
                         orderable: false,
                         searchable: false
                     },

                 ]
             });
           
             //Add User
             $('#createAdmin').submit(function (e)
             {
                 e.preventDefault();
                 let data= new FormData(this);
                 
                 $.ajax({
                     
                     url: "{{route('user.store')}}",
                     type:"POST",
                     data: data,
                     processData: false,
                     contentType:false,
                     // headers: {
                     //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     // },

                     success:function(res)
                     {
                         $('#createAdminModal').modal('hide');
                         
                         Swal.fire({
                             title: "Success!",
                             text: res.message,
                             icon: "success"
                         });

                         userTable.ajax.reload();
                         
                     },
                     
                     error:function(err)
                     {
                         Swal.fire({
                             title: "Error!",
                             text: err.message,
                             icon: "error"
                         });
                     }

                     }
   
                 )
             })
             
             //Edit User
             $(document).on('click', '.editButton', function () {

                 let id= $(this).data('id'); 
                 
                 $.ajax(
                     {
                         url: "{{url('users')}}/" +id +'/edit',
                         type:"GET",
                         success:function(response)
                         {
                            
                              $('#eName').val(response.user.name)
                              $('#eEmail').val(response.user.email)
                              $('#id').val(response.user.id)
                         },
                         error:function(err)
                         {
                             console.log(err);
                         }
                     }
                 )
             })
           
             //Update User
             $('#editUser').submit(function (e)
             {
                 e.preventDefault();
                let id= $('#id').val();
                 $.ajax({

                     url: "{{url('users')}}/"+id,
                     type:"POST",
                     data: new FormData(this),
                     processData: false,
                     contentType:false,
                     // headers: {
                     //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     // },

                     success:function(res)
                     {

                         Swal.fire({
                             title: "success!",
                             text: 'User Updated Successfully',
                             icon: "success"
                         });

                         userTable.ajax.reload();
                     },

                     error:function(err)
                     {
                         Swal.fire({
                             title: "Error!",
                             text: err.message,
                             icon: "error"
                         });
                     }

                 })
                 
             });
             
             //Delete User
             $(document).on('click', '.deleteButton', function () {
                 
                 let id= $(this).data('id');
                 Swal.fire({
                     title: "Are you sure?",
                     text: "You won't be able to revert this!",
                     icon: "warning",
                     showCancelButton: true,
                     confirmButtonColor: "#3085d6",
                     cancelButtonColor: "#d33",
                     confirmButtonText: "Yes, delete it!"
                 }).then((result) => {
  
                     if (result.isConfirmed) {

                         $.ajax({
                             url: "{{url('users')}}/"+id,
                             type:"DELETE",
                             success:function(res)
                             {
                                  
                                 
                                 Swal.fire({
                                     title: "Deleted!",
                                     text: "Your file has been deleted.",
                                     icon: "success"
                                 });

                                 userTable.ajax.reload();
                             },
                             error:function(err)
                             {
                                 console.log(err);
                             }
                         })
                         
                       
                     }
                 });
             }) 
             
             
          
             

         });
     
        </script>


    
  

@endpush