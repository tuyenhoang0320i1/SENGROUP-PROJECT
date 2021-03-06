@extends('layout.master')
@section('content')
    <div class="container pb-5" style="margin-top: 50px">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    @if($user->image)
                                        <img src="{{asset("storage/images/".$user->image)}}" id="imgProfile"
                                             style="width: 150px; height: 150px" class="img-thumbnail"/>
                                    @else
                                        <img src="http://placehold.it/150x150" id="imgProfile"
                                             style="width: 150px; height: 150px" class="img-thumbnail"/>

                                    @endif
                                    @if(Session::get('user'))
                                    <form action="{{route('user.edit.avatar',Session::get('user')->id)}}" method="post"
                                          enctype="multipart/form-data">
                                        @else
                                            <form action="{{route('user.edit.avatar',\Illuminate\Support\Facades\Auth::id())}}" method="post"
                                                  enctype="multipart/form-data">
                                        @endif
                                        @csrf
                                        <div class="middle mt-3">
                                            <input class="form-control" type="file" onchange="this.form.submit()"
                                                   id="profilePicture"
                                                   name="cover"/>
                                        </div>
                                    </form>
                                    <div class="userData mt-3">
                                        <p style="color: #0a0a0a;font-size: 20px; font-family: inherit">Thông tin
                                            cá nhân</p>
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard"
                                           value="Discard Changes"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab"
                                           href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Chi
                                            tiết</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab"
                                           href="#connectedServices" role="tab" aria-controls="connectedServices"
                                           aria-selected="false">Chỉnh sửa</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                         aria-labelledby="basicInfo-tab">


                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style=" font-family: inherit">Tên</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$user->name}}
                                            </div>
                                        </div>
                                        <hr/>

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-family: inherit">Email</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$user->email}}
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-family: inherit">Số điện thoại</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$user->phone}}
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-family: inherit">Địa chỉ</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$user->address}}
                                            </div>
                                        </div>
                                        <hr/>

                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel"
                                         aria-labelledby="ConnectedServices-tab">
                                        <form method="post" action="{{route('user.edit',$user->id)}}">
                                            @csrf
                                            @if($errors->all())
                                                <div id="msg_div" class="alert alert-danger d-none" role="alert">
                                                    <span id="res_message"></span>
                                                </div>
                                            @endif
                                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                                 aria-labelledby="basicInfo-tab">
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                        <label style=" font-family: inherit" class="{{$errors->first('name') ? 'text-danger': ''}}">Tên (*)</label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        <input class="form-control {{$errors->first('name') ? 'is-invalid': ''}}" type="text" name="name"
                                                               value="{{$user->name}}"/>
                                                        @if($errors->first('name'))
                                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                        <label style="font-family: inherit" class="{{$errors->first('phone') ? 'text-danger': ''}}">Số điện thoại (*)</label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        <input class="form-control {{$errors->first('phone') ? 'is-invalid': ''}}" type="text" name="phone"
                                                               value="{{$user->phone}}"/>
                                                        @if($errors->first('phone'))
                                                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                        <label style="font-family: inherit">Địa chỉ</label>
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        <input class="form-control" type="text" name="address"
                                                               value="{{$user->address}}"/>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class="row mt-2">
                                                    <div class="col-sm-3 col-md-2 col-5">
                                                    </div>
                                                    <div class="col-md-8 col-6">
                                                        <div>
                                                            <p>Ghi chú: Mục tích dấu (*) là bắt buộc!!!</p>
                                                        </div>
                                                        <input class="btn btn-primary" type="submit" value="Cập nhập"/>
                                                        @if(Session::get('user'))
                                                        <a class="btn btn-secondary"
                                                           href="{{route('user.show',['id'=>Session::get('user')->id])}}">Trở
                                                            lại</a>
                                                        @else
                                                            <a class="btn btn-secondary"
                                                               href="{{route('user.show',['id'=>\Illuminate\Support\Facades\Auth::id()])}}">Trở
                                                                lại</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
