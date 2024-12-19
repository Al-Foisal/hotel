@extends('layouts.master')


@section('content')


<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">System user list view</h4>

                    <a class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createNewSystemUserModal">
                        Create New System User
                    </a>
                </div>
            </div><!--end card-header-->

            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Image</th>
                            <th>System User Details</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    @foreach($users as $up)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            <div>
                                <img src="{{asset($up->image??'user.jpg')}}" style="height: 80px;;" alt="#">
                            </div>
                        </td>
                        <td>
                            <b>ID:</b> {{$up->id}}, <br>
                            <b>Name:</b> {{$up->name}}, <br>
                            <b>Email:</b> {{$up->email}}, <br>
                            <b>Phone:</b> {{$up->phone}}, <br>
                            <b>Address:</b> {{$up->address}}, <br>
                            <b>Responsibility:</b> {{$up->responsibility}}, <br>
                            <b>Status:</b> <span class="text-{{$up->status==1?'success':'danger'}} fw-normal"> {{$up->status==1?'Active':'Inactive'}}</span>, <br>
                            <b>Created:</b> {{$up->created_at->format('d F, Y h:i A')}}, <br>
                        </td>
                        <td>
                            <div>
                                @if(isset($up->userPermission->permission))
                                @foreach($up->userPermission->permission as $key=>$p)
                                @if(!is_array($p))
                                @if($key!=='branch')
                                <b>{{$p}}</b>, <br>
                                @endif
                                @else
                                <div style="margin-left:.5rem">
                                    <b>{{$key}}</b>, <br>
                                    <div style="margin-left:.5rem">
                                        @foreach($p as $sp_key=>$sp)
                                        <b>{{str_replace('_',' ',$sp)}}</b>, <br>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($up->owner_id==$up->id)
                            Owner Account
                            @else
                            <div class="d-flex justify-content-start">
                                <button href="" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#editSystemUserModal{{$up->id}}">Edit</button>
                                <form action="{{route('systemUser.rootStatus',$up->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-{{$up->status==1?'danger':'success'}} me-1" onclick="return confirm('Are you sure want {{$up->status==1?'Inactive':'Active'}} this user?')">{{$up->status==1?'Inactive':'Active'}}</button>
                                </form>
                                <form action="{{route('systemUser.deleteRootUser',$up->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want delete this user?')">Delete</button>
                                </form>
                                <!--  Edit existing user modal -->
                                <div class="modal fade bd-example-modal-xl" id="editSystemUserModal{{$up->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title m-0" id="myLargeModalLabel">Edit existing user</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div><!--end modal-header-->
                                            <div class="modal-body">
                                                <form action="{{route('systemUser.update',$up->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Full Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter name" name="name" required value="{{$up->name??''}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Phone</label>
                                                            <input type="text" class="form-control" placeholder="Enter phone" name="phone" required value="{{$up->phone??''}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Email</label>
                                                            <input type="text" class="form-control" placeholder="Enter email" name="email" required value="{{$up->email??''}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Password (<small>The password must be 8 character long.</small>)</label>
                                                            <input type="text" class="form-control" placeholder="Password" name="password">

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Address</label>
                                                            <input type="text" class="form-control" placeholder="Enter address" name="address" required value="{{$up->address??''}}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Image</label>
                                                            <input type="file" class="form-control" placeholder="Enter address" name="image">
                                                            @if($up->image)
                                                            <img src="{{asset($up->image)}}" style="height: 40px;">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="exampleInputEmail1">Responsibility</label>
                                                            <select name="responsibility" class="form-control">
                                                                <option value="Branch Manager" {{$up->reponsibility=='Branch Manager' ?'selected':''}}>Branch Manager</option>
                                                                <option value="Operator" {{$up->reponsibility=='Operator' ?'selected':''}}>Operator</option>
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            @php
                                                            $branch_permission=\App\Models\UserPermission::where('owner_id', session('owner_id'))->where('user_id', $up->id??'')->first();
                                                            @endphp
                                                            <div class="col-md-6">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="mb-3">
                                                                            
                                                                            @foreach(menuList() as $m=>$menu)
                                                                            @if($menu['title']!=='System User')
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="InlineCheckbox" value="{{$menu['permission']}}" name="permission[{{ $menu['permission'] }}]"

                                                                                    @if (
                                                                                    $branch_permission &&
                                                                                    isset($branch_permission->permission) &&
                                                                                array_key_exists($menu['permission'], $branch_permission->permission)
                                                                                )
                                                                                @php
                                                                                $permission = $branch_permission->permission[$menu['permission']];
                                                                                @endphp

                                                                                @if (
                                                                                $permission == $menu['permission'] || is_array($permission)
                                                                                )
                                                                                checked
                                                                                @endif
                                                                                @endif
                                                                                <label class="form-check-label" for="InlineCheckbox">{{$menu['title']}}

                                                                                </label>
                                                                                <div class="ms-3">
                                                                                    @if($menu['hasSub'])
                                                                                    @foreach($menu['subMenu'] as $sm=> $submenu)
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" class="form-check-input" id="InlineCheckbox" value="{{$submenu['permission']}}" name="permission[{{ $menu['permission'] }}][{{$submenu['permission']}}]"
                                                                                            @if (
                                                                                            $branch_permission &&
                                                                                            isset($branch_permission->permission) &&
                                                                                        array_key_exists($menu['permission'], $branch_permission->permission)
                                                                                        )
                                                                                        @php
                                                                                        $permission = $branch_permission->permission[$menu['permission']];
                                                                                        @endphp

                                                                                        @if (
                                                                                        is_array($permission) &&
                                                                                        array_key_exists( $submenu['permission'],$permission)
                                                                                        )
                                                                                        checked
                                                                                        @endif
                                                                                        @endif

                                                                                        >
                                                                                        <label class="form-check-label" for="InlineCheckbox">{{$submenu['title']}}</label>
                                                                                    </div>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @endif                
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div><!--end row-->
                                                </form>

                                            </div><!--end modal-body-->
                                        </div><!--end modal-content-->
                                    </div><!--end modal-dialog-->
                                </div><!--end modal-->
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach


                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<!-- create new role modal -->
<div class="modal fade bd-example-modal-xl" id="createNewSystemUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myLargeModalLabel">Create new role</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
                <form action="{{route('systemUser.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control" placeholder="Enter phone" name="phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Password (<small>The password must be 8 character long.</small>)</label>
                            <input type="text" class="form-control" placeholder="Password" name="password" required>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Address</label>
                            <input type="text" class="form-control" placeholder="Enter address" name="address" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="exampleInputEmail1">Responsibility</label>
                            <select name="responsibility" class="form-control">
                                <option value="Branch Manager">Branch Manager</option>
                                <option value="Operator" selected>Operator</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">


                                        @foreach(menuList() as $m=>$menu)
                                        @if($menu['title']!=='System User')
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="InlineCheckbox" value="{{$menu['permission']}}" name="permission[{{ $menu['permission'] }}]">
                                            <label class="form-check-label" for="InlineCheckbox">{{$menu['title']}}</label>
                                            <div class="ms-3">
                                                @if($menu['hasSub'])
                                                @foreach($menu['subMenu'] as $sm=> $submenu)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="InlineCheckbox" value="{{$submenu['permission']}}" name="permission[{{ $menu['permission'] }}][{{$submenu['permission']}}]">
                                                    <label class="form-check-label" for="InlineCheckbox">{{$submenu['title']}}</label>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div><!--end row-->
                </form>

            </div><!--end modal-body-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
@endsection