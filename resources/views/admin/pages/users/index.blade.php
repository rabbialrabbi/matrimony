@extends('admin.layouts.admin')
@section('title', 'Dashboard')
{{--@push('style')--}}

{{--@endpush--}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card vCard">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        @can('create-user')
                            <button type="button" class="btn btn-sm vBtn float-right" data-toggle="modal"
                                    data-target="#userCreateModal"><i class="fa fa-plus"></i>
                                Add New
                            </button>
                        @endcan
                    </div>


                    <div class="card-body">
                        <table id="userDataTable"
                               class="table table-bordered table-striped dataTable dtr-inline text-center">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{$loop->index+1}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           class="badge {{$user->status == 1 ? 'badge-success' : 'badge-danger'}}"
                                           id="user_status_{{$user->id}}"
                                        >
                                            @if($user->status==1)
                                                <i class="fa fa-check"></i>
                                            @else
                                                <i class="fa fa-power-off"></i>
                                            @endif
                                        </a>
                                    </td>
                                    <td>

                                        @can('show-user')
                                            <button onclick="getUserShowInfo({{$user->id}})"
                                                    class="btn btn-sm btn-info"
                                                    data-toggle="tooltip"
                                                    title="Show details"><i class="fa fa-search-plus"></i>
                                            </button>
                                        @endcan
                                        @can('update-user')

                                            <button onclick="getUserEditInfo({{$user->id}})"

                                                    class="btn btn-sm btn-secondary"
                                                    data-toggle="tooltip"
                                                    title="Edit user"><i class="fa fa-edit"></i>
                                            </button>
                                        @endcan

                                        @can('delete-user')
                                            <form action="{{route('users.destroy', $user->id)}}"
                                                  method="post" id="delete_user_{{$user->id}}" class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                            </form>
                                                <button onclick="deleteUser({{$user->id}}, event)"
                                                        class="btn btn-sm btn-danger"
                                                        data-toggle="tooltip"
                                                        title="Delete user"><i class="fa fa-trash"></i>
                                                </button>
                                        @endcan
                                        @can('update-role')
                                            <button onclick="assignRole({{$user->id}})"

                                                    class="btn btn-sm btn-info"
                                                    data-toggle="tooltip"
                                                    title="Assign Role"><i class="far fa-user-circle"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="assignRole">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header vMHeader">
                        <h4 class="modal-title text-white">Assign Role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form role="form" id="assignRoleForm" action="" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="first_name">Role</label>
                                            <select name="role_id" id="editRole"
                                                    class="form-control @error('role_id') is-invalid @enderror">
                                                <option value="">Choose Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id') <span
                                                class="text-danger float-right">{{$errors->first('role_id') }}</span> @enderror
                                            {{--                                            <input type="text"--}}
                                            {{--                                                   class="form-control @error('first_name') is-invalid @enderror"--}}
                                            {{--                                                   placeholder="Enter First Name"--}}
                                            {{--                                                   name="first_name" id="first_name" value="{{old('first_name')}}">--}}
                                            {{--                                            @error('first_name') <span--}}
                                            {{--                                                class="text-danger float-right">{{$errors->first('first_name') }}</span> @enderror--}}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default float-right"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit"
                                        class="btn btn-sm defaultBtn float-right">Assign
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @can('show-user')
            <div class="modal fade" id="userShowModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header vMHeader">
                            <h4 class="modal-title text-white">User Details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <table class="table table-hover">

                                <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td id="show_name"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td id="show_email"></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td class="vBadge" id="show_user_status"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer float-right w-100">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('create-user')
            <div class="modal fade" id="userCreateModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header vMHeader">
                            <h4 class="modal-title text-white">Create New User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- form start -->
                        <form role="form" id="userCreateForm" action="{{route('users.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Enter First Name"
                                                   name="name" id="name" value="{{old('name')}}">
                                            @error('name') <span
                                                class="text-danger float-right">{{$errors->first('name') }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter Email address"
                                                   name="email" id="email" value="{{old('email')}}">
                                            @error('email') <span
                                                class="text-danger float-right">{{$errors->first('email') }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="Enter Email address"
                                                   name="password" id="password" value="{{old('password')}}">
                                            @error('password') <span
                                                class="text-danger float-right">{{$errors->first('password') }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm password</label>
                                            <input type="password"
                                                   class="form-control @error('confirm_password') is-invalid @enderror"
                                                   placeholder="Enter Email address"
                                                   name="confirm_password" id="confirm_password"
                                                   value="{{old('confirm_password')}}">
                                            @error('confirm_password') <span
                                                class="text-danger float-right">{{$errors->first('confirm_password') }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="switch">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default float-right"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit"
                                        class="btn btn-sm defaultBtn float-right">Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('update-user')
            <div class="modal fade" id="userEditModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vMHeader">
                            <h4 class="modal-title text-white">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- form start -->
                        <form role="form" id="userEditForm" action="{{route('users.store')}}" method="post">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Enter First Name"
                                                   name="name" id="editName" value="{{old('name')}}">
                                            @error('name') <span
                                                class="text-danger float-right">{{$errors->first('name') }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter Email address"
                                                   name="email" id="editEmail" value="{{old('email')}}">
                                            @error('email') <span
                                                class="text-danger float-right">{{$errors->first('email') }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="switch">Status</label>
                                            <select name="status" id="editStatus" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-default float-right"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit"
                                        class="btn btn-sm defaultBtn float-right">Update
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        @endcan
    </section>

@endsection
@push('script')
    <script>
        let users = @json($users);
        $(document).ready(function () {
            $("#userDataTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [3, 4]}
                ],
            });
        })

        function assignRole(id) {
            let user = users.find(x => x.id === id);
            const appUrl = $('meta[name="app-url"]').attr('content');
            $('#assignRoleForm').attr('action', appUrl + 'assign-role/' + id)
           if(user.roles.length){
               $('#editRole option[value="' + user.roles[0].id + '"]').prop("selected", true)
           }

            $('#assignRole').modal('show')

        }

        function getUserShowInfo(id) {

            let user = users.find(x => x.id === id);
            $('#show_name').html(user.name)
            $('#show_email').html(user.email)
            $('#show_user_status').html("");
            if (user.status == 1) {
                $('#show_user_status').append("<span class='badge badge-success'>Active</span>");
            } else {
                $('#show_user_status').append("<span class='badge badge-danger'>Inactive</span>");
            }
            $('#userShowModal').modal('show')
        }

        function getUserEditInfo(id) {
            let user = users.find(x => x.id === id);

            const appUrl = $('meta[name="app-url"]').attr('content');

            $('#userEditForm').attr('action', appUrl + 'users/' + user.id)
            $('#editName').val(user.name)
            $('#editEmail').val(user.email)
            $('#editStatus option[value="' + user.status + '"]').prop("selected", true)


            $('#userEditModal').modal('show')

        }
        function deleteUser(id,e) {
            e.preventDefault()
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.value == true) {
                    $('#delete_user_' + id).submit();
                }
            })
        }
    </script>
@endpush

